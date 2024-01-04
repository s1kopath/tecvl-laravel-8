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
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\DB;
use Modules\Commission\Http\Models\OrderCommission;
use Modules\Refund\Entities\Refund;

class AdminDashboardReportService
{
    use ApiResponse, ReportHelperTrait;

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
        $total = Order::where('order_date', '>=', $this->offsetDate("-6"))->count();
        if ($returnSelf) {
            return $this->complete($total, $key);
        } else {
            $this->setReturn($total, $key);
            return $total;
        }
    }


    /**
     * Compare this week orders count against last week orders count
     * @param string|null $key
     * @return DashboardReportService
     */
    public function thisWeekOrdersCompare($key = 'thisWeekOrdersCompare')
    {
        $dates = $this->lastWeek();
        $totalLastWeek = Order::where('order_date', '>=', $dates['start'])->where('order_date', '<', $dates['end'])->count();
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
        $total = Order::where('order_date', '>=', $this->offsetDate("-6"))->sum('total');
        if ($returnSelf) {
            return $this->complete($total, $key);
        } else {
            $this->setReturn($total, $key);
            return $total;
        }
    }


    /**
     * Compare this week sales count against last week sales count
     * @param string|null $key
     * @return DashboardReportService
     */
    public function thisWeekSalesCompare($key = 'thisWeekSalesCompare')
    {
        $dates = $this->lastWeek();
        $totalLastWeek = Order::where('order_date', '>=', $dates['start'])->where('order_date', '<', $dates['end'])->sum('total');
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
        $count = Item::where('created_at', '>=', $this->offsetDate('-6'))->count();
        if ($returnSelf) {
            return $this->complete($count, $key);
        } else {
            return $count;
        }
    }


    /**
     * Compare last week products count with this week products count
     * @param string|null $key
     * @return DashboardReportService
     */
    public function newProductsCountCompare($key = 'newProductsCompare')
    {
        $dates = $this->lastWeek();
        $totalLastWeek = Item::where('created_at', '>=', $dates['start'])->where('created_at', '<', $dates['end'])->count();
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
        $count = Refund::where('created_at', '>=', $this->offsetDate('-30'))->count();
        if ($returnSelf) {
            return $this->complete($count, $key);
        } else {
            $this->setReturn($count, $key);
            return $count;
        }
    }


    /**
     * Compare last month refund requests count with this week refund requests count
     * @param string|null $key
     * @return DashboardReportService
     */
    public function newRefundsCountCompare($key = 'newRefundsCompare')
    {
        $dates = $this->lastMonth();
        $totalLastMonth = Refund::where('created_at', '>=', $dates['start'])->where('created_at', '<', $dates['end'])->count();
        $totalThisMonth = $this->getValue('newRefunds') ?? $this->newRefundsCount('', false);
        return $this->complete($this->growthRate($totalThisMonth, $totalLastMonth), $key);
    }


    /**
     * New users registered in last 30 days
     * @param string|null $key
     * @return DashboardReportService
     */
    public function newUsersCount($key = 'newUsersCount', $returnSelf = true)
    {
        if ($key == '') {
            $key = 'newUsers';
        }
        $count = User::where('created_at', '>=', $this->offsetDate('-30'))
            ->where('activation_code', null)
            ->count();
        if ($returnSelf) {
            return $this->complete($count, $key);
        } else {
            $this->setReturn($count, $key);
            return $count;
        }
    }


    /**
     * Compare new users count against last 30 days
     * @param string|null $key
     * @return DashboardReportService
     */
    public function newUsersCompare($key = 'newUsersCompare')
    {
        $dates = $this->lastMonth();
        $totalLastWeek = User::where('created_at', '>=', $dates['start'])->where('created_at', '<', $dates['end'])
            ->where('activation_code', null)
            ->count();
        $totalThisWeek = $this->getValue('newUsers') ??  $this->newUsersCount('', false);

        return $this->complete($this->growthRate($totalThisWeek, $totalLastWeek), $key);
    }


    /**
     * New users registered in last 30 days
     * @param string|null $key
     * @return DashboardReportService
     */
    public function newVendors($key = 'newVendors', $returnSelf = true)
    {
        if ($key == '') {
            $key = 'newVendors';
        }
        $count = Vendor::where('created_at', '>=', $this->offsetDate('-30'))
            ->count();
        if ($returnSelf) {
            return $this->complete($count, $key);
        } else {
            $this->setReturn($count, $key);
            return $count;
        }
    }


    /**
     * Compare new vendors count against last 30 days
     * @param string|null $key
     * @return DashboardReportService
     */
    public function newVendorsCompare($key = 'newVendorsCompare')
    {
        $dates = $this->lastMonth();
        $totalLastMonth = Vendor::where('created_at', '>=', $dates['start'])->where('created_at', '<', $dates['end'])
            ->count();
        $totalThisMonth = $this->getValue('newVendors') ?? $this->newVendors('', false);

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
        OrderStatus::withCount('orders')
            ->get()
            ->map(function ($order) use (&$data) {
                $data['status'][] = $order->name;
                $data['count'][] = $order->orders_count;
            });
        return $this->complete($data, $key);
    }


    /**
     * Vendor stats
     * @param string|null $key
     * @return DashboardReportService
     */
    public function vendorStats($key = 'vendorStats', $type = null)
    {
        $data = Vendor::take($this->getLimit())
            ->join('order_details', 'vendors.id', 'order_details.vendor_id')
            ->join('orders', 'order_details.order_id', 'orders.id')
            ->join('items', 'order_details.item_id', 'items.id')
            ->select(
                'vendors.id as id',
                'vendors.name as name',
                'orders.order_date',
                DB::raw('count(order_details.id) as totalOrder'),
                DB::raw('sum(orders.total) as sales'),
                DB::raw('sum(items.review_average) / count(items.id) as ratings')
            );
            if ($type == "daily") {
                $data->where('orders.order_date', $this->offsetDate());
            } elseif ($type ==  "weekly") {
                $dates = $this->currentWeek();
                $data->where('orders.order_date', '>=', $dates['start']);
                $data->where('orders.order_date', '<=', $dates['end']);
            } elseif ($type ==  "monthly") {
                $dates = $this->currentMonth();
                $data->where('orders.order_date', '>=', $dates['start']);
                $data->where('orders.order_date', '<=', $dates['end']);
            } elseif ($type ==  "yearly") {
                $dates = $this->currentYear();
                $data->where('orders.order_date', '>=', $dates['start']);
                $data->where('orders.order_date', '<=', $dates['end']);
            }
            $data = $data->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'ratings' => round($item->ratings),
                    'orders' => $item->totalOrder,
                    'sales' => formatNumber($item->sales),
                    'url' => route('users.user-data', ['uid' => $item->id ?? 1])
                ];
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
     * Get top selling brands
     * @param string|null $key
     * @return DashboardReportService
     */
    public function topSoldBrands($key = 'topSoldBrands')
    {
        $brands = Brand::join('items', 'items.brand_id', 'brands.id')
            ->select('brands.name', 'items.purchase_count as total')
            ->orderBy('total', 'desc')->take($this->getLimit())->get()
            ->map(function ($q) {
                return [
                    'name' => $q->name,
                    'total' => $q->total ?? 0
                ];
            });
        return $this->complete($brands, $key);
    }

    /**
     * Get commissions of the week
     * @param string|null $key
     * @return mixed
     */
    public function commissionsThisWeek($key = 'commissionsThisWeek')
    {
        $commissions = OrderCommission::join('order_details', 'order_commissions.order_details_id', 'order_details.id')
            ->where('order_commissions.status', 'Approve')
            ->where('order_commissions.created_at', '>=', $this->offsetDate('-6'))
            ->sum(DB::raw('order_commissions.amount * (order_details.price * order_details.quantity) / 100'));
        return $this->complete($commissions, $key);
    }


    public function commissionThisWeekCompare($key = 'commissionThisWeekCompare')
    {
        $dates = $this->lastWeek();
        $totalLastWeek = OrderCommission::join('order_details', 'order_commissions.order_details_id', 'order_details.id')
            ->where('order_commissions.status', 'Approve')
            ->where('order_commissions.created_at', '>=', $dates['start'])
            ->where('order_commissions.created_at', '<', $dates['end'])
            ->sum(DB::raw('order_commissions.amount * (order_details.price * order_details.quantity) / 100'));
        $totalThisWeek = $this->getValue('commissionsThisWeek') ?? $this->commissionsThisWeek('', false);

        return $this->complete($this->growthRate($totalThisWeek, $totalLastWeek), $key);
    }


    public function vendorRequestList($key = "vendorReq")
    {
        $data = User::take($this->getLimit())
            ->join('role_users', 'users.id', 'role_users.user_id')
            ->where('users.status', 'Pending')
            ->where('role_users.role_id', 2)
            ->orderBy('id', 'DESC')
            ->get()
            ->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'file_url' => $user->fileUrl(),
                    'created_at' => $user->format_created_at,
                    'view' => route('users.edit', $user->id),
                    'accept' => route('dashboard.changeStatus', ['status' => 'accept', 'id' => $user->id]),
                    'reject' => route('dashboard.changeStatus', ['status' => 'reject', 'id' => $user->id]),
                ];
            });
        return $this->complete($data, $key);
    }
}
