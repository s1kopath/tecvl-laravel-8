<?php

namespace App\Services\Reports;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderStatus;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Wallet;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\DB;
use Modules\Refund\Entities\Refund;

class VendorDashboardReportService
{
    use ApiResponse, ReportHelperTrait;

    /**
     * Stores vendor id
     */
    private $vendorId = null;

    /**
     * Calculates total orders in last 7 days
     * @param string|null $key
     * @return DashboardReportService | array
     */
    public function thisWeekOrdersCount($key = 'thisWeekOrdersCount', $returnSelf = true)
    {
        if ($key == '') {
            $key = 'thisWeekOrdersCount';
        }
        $total = OrderDetail::select('vendor_id', 'order_id', DB::raw('concat("v-", vendor_id, "o-", order_id) as vendor_order'))
            ->where('created_at', '>=', $this->offsetDate("-6"))
            ->whereVendorId($this->getVendorId())
            ->groupBy('vendor_order')
            ->get()->count();

        return $this->complete($total, $key, $returnSelf);
    }


    /**
     * Compare this week orders count against last week orders count
     * @param string|null $key
     * @return DashboardReportService
     */
    public function thisWeekOrdersCompare($key = 'thisWeekOrdersCompare')
    {
        $dates = $this->lastWeek();
        $totalLastWeek = OrderDetail::where('created_at', '>=', $dates['start'])
            ->where('created_at', '<', $dates['end'])
            ->whereVendorId($this->getVendorId())
            ->groupBy('order_id', 'vendor_id')
            ->count();
        $totalThisWeek = $this->getValue('thisWeekOrdersCount') ?? $this->thisWeekOrdersCount('', false);
        return $this->complete($this->growthRate($totalThisWeek, $totalLastWeek), $key);
    }


    /**
     * Calculates total sales in last 7 days
     * @param string|null $key
     * @return DashboardReportService
     */
    public function thisWeekSalesCount($key = 'thisWeekSales', $returnSelf = true)
    {
        if ($key == '') {
            $key = 'thisWeekSales';
        }
        $total = OrderDetail::whereVendorId($this->getVendorId())
            ->where('created_at', '>=', $this->offsetDate("-6"))
            ->sum(DB::raw('price * quantity'));

        return $this->complete($total, $key, $returnSelf);
    }


    /**
     * Compare this week sales count against last week sales count
     * @param string|null $key
     * @return DashboardReportService
     */
    public function thisWeekSalesCompare($key = 'thisWeekSalesCompare')
    {
        $dates = $this->lastWeek();
        $totalLastWeek = OrderDetail::where('created_at', '>=', $dates['start'])
            ->where('created_at', '<', $dates['end'])
            ->whereVendorId($this->getVendorId())
            ->sum(DB::raw('price * quantity'));
        $totalThisWeek = $this->getValue('thisWeekSales') ?? $this->thisWeekSalesCount('', false);
        return $this->complete($this->growthRate($totalThisWeek, $totalLastWeek), $key);
    }


    /**
     * Finds the most sold products in last 7 days
     * @param string|null $key
     * @return DashboardReportService
     */
    public function mostSoldProducts($key = 'mostSoldProducts')
    {
        $items = OrderDetail::select('id', 'item_id', 'quantity', DB::raw('count(order_id) as total'))
            ->with('item:id,name')->whereHas('order', function ($q) {
                $q->where('order_date', '>=', $this->offsetDate("-30"));
            })
            ->whereVendorId($this->getVendorId())
            ->groupBy('item_id')
            ->orderBy('total', 'desc')
            ->get()
            ->map(function ($item) {
                return [
                    'name' => $item->item->name,
                    'total' => round($item->total, 5),
                    'url' => route('items.item-data', ['uid' => $item->item_id])
                ];
            });
        return $this->complete($items, $key);
    }


    /**
     * Users with most orders by last 30 days
     * @param string|null $key
     * @return DashboardReportService
     */
    public function mostActiveUsers($key = 'mostActiveUsers')
    {
        $users = Order::select('id', 'user_id', DB::raw('count(user_id) as total'))
            ->with('user:id,name')
            ->where('order_date', '>=', $this->offsetDate('-30'))
            ->groupBy('user_id')
            ->get()
            ->map(function ($order) {
                return [
                    'name' => $order->user->name,
                    'total' => $order->total,
                    'profile' => route('users.user-data', ['uid' => $order->user_id])
                ];
            });
        return $this->complete($users, $key);
    }


    /**
     * New products added into the system in last 30 days
     * @param string|null $key
     * @return DashboardReportService
     */
    public function newProductsCount($key = 'newProducts', $returnSelf = true)
    {
        if ($key == '') {
            $key = 'newProducts';
        }
        $count = Item::where('created_at', '>=', $this->offsetDate('-6'))->whereVendorId($this->getVendorId())->count();
        return $this->complete($count, $key, $returnSelf);
    }


    /**
     * Compare last week products count with this week products count
     * @param string|null $key
     * @return DashboardReportService
     */
    public function newProductsCountCompare($key = 'newProductsCompare')
    {
        $dates = $this->lastWeek();
        $totalLastWeek = Item::where('created_at', '>=', $dates['start'])->where('created_at', '<', $dates['end'])->whereVendorId($this->getVendorId())->count();
        $totalThisWeek = $this->getValue('newProducts') ?? $this->newProductsCount('', false);
        return $this->complete($this->growthRate($totalThisWeek, $totalLastWeek), $key);
    }


    /**
     * New refund requests in last 30 days
     * @param string|null $key
     * @return DashboardReportService
     */
    public function newRefundsCount($key = 'newRefunds', $returnSelf = true)
    {
        if ($key == '') {
            $key = 'newRefunds';
        }
        $count = Refund::whereHas('orderDetail', function ($query) {
            $query->whereVendorId($this->getVendorId());
        })->where('created_at', '>=', $this->offsetDate('-30'))->count();
        return $this->complete($count, $key, $returnSelf);
    }


    /**
     * Compare last month refund requests count with this week refund requests count
     * @param string|null $key
     * @return DashboardReportService
     */
    public function newRefundsCountCompare($key = 'newRefundsCompare')
    {
        $dates = $this->lastMonth();
        $totalLastMonth = Refund::WhereHas('orderDetail', function ($query) {
            $query->whereVendorId($this->getVendorId());
        })->where('created_at', '>=', $dates['start'])
            ->where('created_at', '<', $dates['end'])->count();
        $totalThisMonth = $this->getValue('newRefunds') ?? $this->newRefundsCount('', false);
        return $this->complete($this->growthRate($totalThisMonth, $totalLastMonth), $key);
    }


    /**
     * Orders of different statuses
     * @param string|null $key
     * @return DashboardReportService
     */
    public function orderStatusWithCount($key = 'orderStatus')
    {
        $data = [];
        OrderStatus::whereHas('orderDetails', function ($q) {
            $q->where('vendor_id', $this->getVendorId());
        })->withCount('orderDetails')
            ->get()
            ->map(function ($order) use (&$data) {
                $data['status'][] = $order->name;
                $data['count'][] = $order->order_details_count;
            });
        return $this->complete($data, $key);
    }



    /**
     * Get single item details
     * @param int $itemId
     * @param string|null $key
     * @return DashboardReportService
     */
    public function itemDetails($itemId, $key = 'itemDetails')
    {
        $item = Item::firstWhere('id', $itemId);
        return $this->complete(view('admin.dashboxes.partials.item-details', compact('item'))->render(), $key);
    }


    /**
     * Get single user details
     * @param int $userId
     * @param string|null $key
     * @return DashboardReportService
     */
    public function userDetails($userId, $key = 'userDetails')
    {
        $user = User::findOrFail($userId);
        return $this->complete(view('admin.dashboxes.partials.user-pop', compact('user'))->render(), $key);
    }


    /**
     * Get sales comparison
     * @param string|null $key
     * @return DashboardReportService
     */
    public function salesOfTheMonth($key = 'salesComparison')
    {
        $range = $this->getDay($this->offsetDate());
        $dates = range(1, $range);
        $values = array_fill(0, $range - 1, 0);
        Order::select('id', 'order_date', DB::raw('count(id) as total'))
            ->where('order_date', '>=', $this->firstDayOfTheMonth())
            ->where('order_date', '<', $this->tomorrow())
            ->WhereHas('orderDetails', function ($query) {
                $query->whereVendorId($this->getVendorId());
            })
            ->groupBy('order_date')
            ->get()
            ->map(function ($sale) use (&$values) {
                $values[$this->getDay($sale->order_date) - 1] = $sale->total;
            });
        return $this->complete([
            'dates' => $dates,
            'values' => $values,
            'thisMonth' => date('M Y')
        ], $key);
    }


    /**
     * Get vendor wallet balance
     * @param string|null $key
     * @return DashboardReportService
     */
    public function walletBalances($key = 'walletBalances')
    {
        $blnc = Wallet::select('balance', 'currency_id')->where('user_id', auth()->id())->with('currency:id,name,symbol')->get();
        return $this->complete($blnc, $key);
    }
}
