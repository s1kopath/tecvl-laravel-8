<?php
/**
 * @package OrderDataTable
 * @author techvillage <support@techvill.org>
 * @contributor Sakawat Hossain Rony <[sakawat.techvill@gmail.com]>
 * @created 19-01-2022
 */
namespace App\DataTables;

use App\Models\Order;
use Auth;

class OrderDataTable extends DataTable
{
    public function ajax()
    {
        $orders = $this->query();
        return datatables()
            ->of($orders)

            ->addColumn('customer', function ($orders) {
                return wrapIt(optional($orders->user)->name, 10, ['columns' => 2]);
            })->addColumn('total', function ($orders) {
                return formatCurrencyAmount($orders->total);
            })->addColumn('total_quantity', function ($orders) {
                return formatCurrencyAmount($orders->total_quantity);
            })->addColumn('reference', function ($orders) {
                return '<a href="' . route('order.view', ['id' => $orders->id]) . '">' . "#".($orders->reference) . '</a>';
            })->addColumn('status', function ($orders) {
                return optional($orders->orderStatus)->name;
            })->addColumn('created_at', function ($orders) {
                return $orders->format_created_at;
            })->addColumn('payment_status', function ($orders) {
                return statusBadges($orders->payment_status);
            })->addColumn('vendor', function ($orders) {
                return $orders->vendorName($orders->id);
            })

            ->addColumn('action', function ($orders) {
                $view = '<a title="' . __('Show') . '" href="' . route('order.view', ['id' => $orders->id]) . '" class="btn btn-xs btn-outline-dark"><i class="feather icon-eye"></i></a>&nbsp;';
                $delete = '<form method="post" action="' . route('order.destroy', ['id' => $orders->id]) .'" id="delete-order-'. $orders->id . '" accept-charset="UTF-8" class="display_inline">
                        ' . method_field('DELETE') . '
                        ' . csrf_field() . '
                        <button title="' . __('Delete') . '" class="btn btn-xs btn-danger" type="button" data-id=' . $orders->id . ' data-delete="order" data-label="Delete" data-toggle="modal" data-target="#confirmDelete" data-title="' . __('Delete :x', ['x' => __('Order')]) . '" data-message="' . __('Are you sure to delete this?') . '">
                        <i class="feather icon-trash-2"></i>
                        </button>
                        </form>';

                $str = '';
                if ($this->hasPermission(['App\Http\Controllers\AdminOrderController@view'])) {
                    $str .= $view;
                }
                if ($this->hasPermission(['App\Http\Controllers\AdminOrderController@destroy'])) {
                    $str .= $delete;
                }
                return $str;
            })

            ->rawColumns(['customer', 'total', 'status', 'created_at', 'total_quantity', 'reference', 'action', 'payment_status', 'vendor'])
            ->make(true);
    }

    public function query()
    {
        $orders = Order::select('orders.id', 'user_id', 'reference', 'order_date', 'currency_id', 'other_discount_amount', 'other_discount_type', 'shipping_charge', 'tax_charge', 'total', 'paid', 'total_quantity', 'order_status_id', 'payment_status', 'created_at')->with('orderDetails:id,item_id,order_id,vendor_id,shop_id,price,quantity,discount_amount,discount_type,order_status_id')->filter();
        return $this->applyScopes($orders);
    }

    public function html()
    {
        return $this->builder()

            ->addColumn(['data' => 'reference', 'name' => 'reference', 'title' => __('Invoice')])

            ->addColumn(['data' => 'customer', 'name' => 'customer', 'title' => __('Customer')])

            ->addColumn(['data' => 'vendor', 'name' => 'vendor', 'title' => __('Vendors')])

            ->addColumn(['data' => 'total_quantity', 'name' => 'total_quantity', 'title' => __('Number of Items')])

            ->addColumn(['data' => 'total', 'name' => 'total', 'title' => __('Total Amount')])

            ->addColumn(['data' => 'status', 'name' => 'status', 'title' => __('Status')])

            ->addColumn(['data' => 'payment_status', 'name' => 'payment_status', 'title' => __('Payment Status')])

            ->addColumn(['data' => 'created_at', 'name' => 'created_at', 'title' => __('Created at')])

            ->addColumn(['data'=> 'action', 'name' => 'action', 'title' => __('Action'), 'width' => '5%',
                'visible' => $this->hasPermission(['App\Http\Controllers\AdminOrderController@view', 'App\Http\Controllers\AdminOrderController@destroy']),
                'orderable' => false, 'searchable' => false])

            ->parameters(dataTableOptions());
    }
}
