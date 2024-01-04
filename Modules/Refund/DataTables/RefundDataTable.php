<?php
/**
 * @package RefundDataTable
 * @author techvillage <support@techvill.org>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @created 18-11-2021
 */

namespace Modules\Refund\DataTables;

use App\DataTables\DataTable;
use Modules\Refund\Entities\Refund;

class RefundDataTable extends DataTable
{
    public function ajax()
    {
        $refunds = $this->query();
        return datatables()
            ->of($refunds)

            ->addColumn('order.reference', function ($refunds) {
                return optional(optional($refunds->orderDetail)->order)->reference;
            })
            ->addColumn('orderDetail.price', function ($refunds) {
                return formatNumber(optional($refunds->orderDetail)->price);
            })
            ->addColumn('shipping_method', function ($refunds) {
                return $refunds->shipping_method;
            })
            ->addColumn('refundReason.name', function ($refunds) {
                return optional($refunds->refundReason)->name;
            })
            ->addColumn('status', function ($refunds) {
                return statusBadges(lcfirst($refunds->status));
            })->addColumn('action', function ($refunds) {
                $edit = '<a title="' . __('Edit :x', ['x' => __('Refund')]) . '" href="' . route('refund.edit', ['id' => $refunds->id]) . '" class="btn btn-xs btn-primary"><i class="feather icon-eye"></i></a>&nbsp';

                $str = '';
                if ($this->hasPermission(['Modules\Refund\Http\Controllers\RefundController@edit'])) {
                    $str .= $edit;
                }
                return $str;
            })

            ->rawColumns(['reference', 'shipping_method', 'name', 'refund_method', 'quantity_sent', 'price', 'status', 'action'])
            ->make(true);
    }

    public function query()
    {
        $refunds = Refund::with(['orderDetail', 'refundReason'])->filter();
        return $this->applyScopes($refunds);
    }

    public function html()
    {
        return $this->builder()

        ->addColumn(['data' => 'order.reference', 'name' => 'order.reference', 'title' => __('Order Id')])
        ->addColumn(['data' => 'shipping_method', 'name' => 'shipping_method', 'title' => __('Shipping')])
        ->addColumn(['data' => 'refundReason.name', 'name' => 'refundReason.name', 'title' => __('Refund Reason')])
        ->addColumn(['data' => 'refund_method', 'name' => 'refund_method', 'title' => __('Refund Method')])
        ->addColumn(['data' => 'quantity_sent', 'name' => 'quantity_sent', 'title' => __('Quantity')])
        ->addColumn(['data' => 'orderDetail.price', 'name' => 'orderDetail', 'title' => __('Amount')])
        ->addColumn(['data' => 'status', 'name' => 'status', 'title' => __('Status')])

        ->addColumn(['data'=> 'action', 'name' => 'action', 'title' => __('Action'), 'width' => '5%',
        'visible' => $this->hasPermission(['Modules\Refund\Http\Controllers\RefundController@edit']),
        'orderable' => false, 'searchable' => false])

        ->parameters(dataTableOptions());
    }
}
