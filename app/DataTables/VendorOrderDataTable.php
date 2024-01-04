<?php
/**
 * @package VendorOrderDataTable
 * @author techvillage <support@techvill.org>
 * @contributor Sakawat Hossain Rony <[sakawat.techvill@gmail.com]>
 * @created 20-01-2022
 */
namespace App\DataTables;
use App\Models\Order;
use App\Models\OrderDetail;
use Auth;
use DB;
class VendorOrderDataTable extends DataTable
{
    public function ajax()
    {
        $orders = $this->query();
        return datatables()
            ->of($orders)

            ->addColumn('customer', function ($orders) {
                return wrapIt(optional($orders->user)->name, 10, ['columns' => 2]);
            })->addColumn('total', function ($orders) {
                return formatCurrencyAmount($orders->vendorItemPrice(session()->get('vendorId'), $orders->id) + $orders->vendorItemShippingTax(session()->get('vendorId'), $orders->id));
            })->addColumn('total_quantity', function ($orders) {
                return formatCurrencyAmount($orders->getTotalVendorItem(session()->get('vendorId'), $orders->id));
            })->addColumn('reference', function ($orders) {
                return '<a href="' . route('vendorOrder.view', ['id' => $orders->id]) . '">' . "#".($orders->reference) . '</a>';
            })->addColumn('status', function ($orders) {
                return optional($orders->orderStatus)->name;
            })->addColumn('created_at', function ($orders) {
                return $orders->format_created_at;
            })->addColumn('payment_status', function ($orders) {
                return statusBadges($orders->payment_status);
            })

            ->addColumn('action', function ($orders) {
                $view = '<a title="' . __('Show') . '" href="' . route('vendorOrder.view', ['id' => $orders->id]) . '" class="btn btn-xs btn-outline-dark"><i class="feather icon-eye"></i></a>&nbsp;';

                $str = '';
                 if ($this->hasPermission(['App\Http\Controllers\Vendor\VendorOrderController@view'])) {
                  $str .= $view;
                 }
                return $str;
            })

            ->rawColumns(['customer', 'total', 'total_quantity', 'reference', 'status', 'created_at', 'payment_status', 'action'])
            ->make(true);
    }

    public function query()
    {
        $vendorId = session()->get('vendorId');
        $orders = Order::select('orders.id', 'user_id', 'reference', 'order_date', 'currency_id', 'other_discount_amount', 'other_discount_type', 'orders.shipping_charge', 'orders.tax_charge', 'total', 'paid', 'total_quantity', 'order_status_id', 'payment_status', 'created_at')
                        ->whereHas("orderDetails", function ($q) use ($vendorId) {
                               $q->where('vendor_id', $vendorId);
                             })
                        ->with('orderDetails:id,item_id,order_id,vendor_id,shop_id,price,quantity,discount_amount,discount_type,order_status_id')
                        ->filter();
        return $this->applyScopes($orders);
    }

    public function html()
    {
        return $this->builder()

            ->addColumn(['data' => 'reference', 'name' => 'reference', 'title' => __('Invoice')])

            ->addColumn(['data' => 'customer', 'name' => 'customer', 'title' => __('Customer')])

            ->addColumn(['data' => 'total_quantity', 'name' => 'total_quantity', 'title' => __('Number of Items')])

            ->addColumn(['data' => 'total', 'name' => 'total', 'title' => __('Total Amount')])

            ->addColumn(['data' => 'status', 'name' => 'status', 'title' => __('Status')])

            ->addColumn(['data' => 'payment_status', 'name' => 'payment_status', 'title' => __('Payment Status')])

            ->addColumn(['data' => 'created_at', 'name' => 'created_at', 'title' => __('Created at')])

            ->addColumn(['data'=> 'action', 'name' => 'action', 'title' => __('Action'), 'width' => '5%',
                'visible' => $this->hasPermission(['App\Http\Controllers\Vendor\VendorOrderController@view']),
                'orderable' => false, 'searchable' => false])

            ->parameters(dataTableOptions());
    }
}
