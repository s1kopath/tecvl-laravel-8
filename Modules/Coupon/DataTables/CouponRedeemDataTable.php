<?php
/**
 * @package CouponRedeemDataTable
 * @author techvillage <support@techvill.org>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @created 28-11-2021
 */

namespace Modules\Coupon\DataTables;

use App\DataTables\DataTable;
use Modules\Coupon\Http\Models\CouponRedeem;

class CouponRedeemDataTable extends DataTable
{
    public function ajax()
    {
        $redeem = $this->query();
        return datatables()
            ->of($redeem)

            ->addColumn('coupon', function ($redeem) {
                return  wrapIt($redeem->coupon->name, 10, ['columns' => 2]);
            })->addColumn('user', function ($redeem) {
                return  wrapIt($redeem->user->name, 10, ['columns' => 2]);
            })->addColumn('order', function ($redeem) {
                return '112445';
            })->addColumn('discount_amount', function ($redeem) {
                return formatNumber($redeem->discount_amount);
            })->addColumn('created_at', function ($redeem) {
                return $redeem->format_created_at;
            })

            ->rawColumns(['coupon', 'user', 'order', 'discount_amount'])
            ->make(true);
    }

    public function query()
    {
        $couponRedeems = CouponRedeem::getAll();
        return $this->applyScopes($couponRedeems);
    }

    public function html()
    {
        return $this->builder()

        ->addColumn(['data' => 'coupon', 'name' => 'coupon', 'title' => __('Coupon')])
        ->addColumn(['data' => 'user', 'name' => 'user', 'title' => __('Customer')])
        ->addColumn(['data' => 'order', 'name' => 'order', 'title' => __('Order')])
        ->addColumn(['data' => 'discount_amount', 'name' => 'discount_amount', 'title' => __('Discount Amount')])
        ->addColumn(['data' => 'created_at', 'name' => 'created_at', 'title' => __('Created at')])

        ->parameters(dataTableOptions());
    }
}
