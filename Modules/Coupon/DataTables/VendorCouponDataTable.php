<?php
/**
 * @package VendorCouponDataTable
 * @author techvillage <support@techvill.org>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @created 19-12-2021
 */

namespace Modules\Coupon\DataTables;

use App\DataTables\DataTable;
use App\Models\VendorUser;
use Modules\Coupon\Http\Models\Coupon;

class VendorCouponDataTable extends DataTable
{
    public function ajax()
    {
        $coupons = $this->query();
        return datatables()
            ->of($coupons)

            ->addColumn('name', function ($coupons) {
                return  wrapIt($coupons->name, 10, ['columns' => 2]);
            })->addColumn('code', function ($coupons) {
                return  wrapIt($coupons->code, 10, ['columns' => 2]);
            })->addColumn('discount_type', function ($coupons) {
                return $coupons->discount_type;
            })->addColumn('discount_amount', function ($coupons) {
                return formatNumber($coupons->discount_amount);
            })->addColumn('start_date', function ($coupons) {
                return timeZoneformatDate($coupons->start_date);
            })->addColumn('end_date', function ($coupons) {
                return timeZoneformatDate($coupons->end_date);
            })->addColumn('status', function ($coupons) {
                return statusBadges(lcfirst($coupons->status));
            })->addColumn('action', function ($coupons) {
                $edit = '<a title="' . __('Edit :x', ['x' => __('Coupon')]) . '" href="' . route('vendor.couponEdit', ['id' => $coupons->id]) . '" class="btn btn-xs btn-primary"><i class="feather icon-edit"></i></a>&nbsp';

                $delete = '<form method="post" action="' . route('vendor.couponDelete', ['id' => $coupons->id]) . '" id="delete-coupons-'. $coupons->id . '" accept-charset="UTF-8" class="display_inline">
                        ' . csrf_field() . '
                        <button title="' . __('Delete :x', ['x' => __('Coupon')]) . '" class="btn btn-xs btn-danger" type="button" data-id=' . $coupons->id . ' data-label="Delete" data-delete="coupons" data-toggle="modal" data-target="#confirmDelete" data-title="' . __('Delete :x', ['x' => __('Coupon')]) . '" data-message="' . __('Are you sure to delete this?') . '">
                        <i class="feather icon-trash-2"></i>
                        </button>
                        </form>';
                $str = '';
                if ($this->hasPermission(['Modules\Coupon\Http\Controllers\Vendor\CouponController@edit'])) {
                    $str .= $edit;
                }
                if ($this->hasPermission(['Modules\Coupon\Http\Controllers\Vendor\CouponController@destroy'])) {
                    $str .= $delete;
                }
                return $str;
            })

            ->rawColumns(['name', 'code', 'discount_type', 'discount_amount', 'start_date', 'end_date', 'status', 'action'])
            ->filter(function ($instance){
                if(in_array(request('status'), ['Active', 'Inactive', 'Pending'])) {
                    $instance->where('status', request('status'));
                }

                if (isset(request('search')['value'])) {
                    $keyword = xss_clean(request('search')['value']);
                    if (!empty($keyword)) {
                        $instance->where(function ($query) use ($keyword) {
                            $query->WhereLike('name', $keyword)
                                ->OrWhereLike('code', $keyword)
                                ->OrWhereLike('discount_type', $keyword)
                                ->OrWhereLike('discount_amount', $keyword)
                                ->OrWhereLike('status', $keyword);
                        });
                    }
                }
            })
            ->make(true);
    }

    public function query()
    {
        $coupons = Coupon::select('id', 'name', 'code', 'discount_type', 'discount_amount', 'start_date', 'end_date', 'status')->where('vendor_id', session()->get('vendorId'));
        return $this->applyScopes($coupons);
    }

    public function html()
    {
        return $this->builder()

        ->addColumn(['data' => 'name', 'name' => 'name', 'title' => __('Name')])
        ->addColumn(['data' => 'code', 'name' => 'code', 'title' => __('Code')])
        ->addColumn(['data' => 'discount_type', 'name' => 'discount_type', 'title' => __('Discount Type')])
        ->addColumn(['data' => 'discount_amount', 'name' => 'discount_amount', 'title' => __('Discount Amount')])
        ->addColumn(['data' => 'start_date', 'name' => 'start_date', 'title' => __('Start Date')])
        ->addColumn(['data' => 'end_date', 'name' => 'end_date', 'title' => __('End Date')])
        ->addColumn(['data' => 'status', 'name' => 'status', 'title' => __('Status')])

        ->addColumn(['data'=> 'action', 'name' => 'action', 'title' => __('Action'), 'width' => '5%',
        'visible' => $this->hasPermission(['Modules\Coupon\Http\Controllers\Vendor\CouponController@edit', 'Modules\Coupon\Http\Controllers\Vendor\CouponController@destroy']),
        'orderable' => false, 'searchable' => false])

        ->parameters(dataTableOptions());
    }
}
