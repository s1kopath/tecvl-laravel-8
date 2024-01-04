<?php
/**
 * @package PackageSubscriptionDataTable
 * @author techvillage <support@techvill.org>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @created 02-09-2021
 * @modified 04-10-2021
 */

namespace App\DataTables;

use App\DataTables\DataTable;
use App\Models\PackageSubscription;

class PackageSubscriptionDataTable extends DataTable
{
    public function ajax()
    {
        $packageSubscription = $this->query();
        return datatables()
            ->of($packageSubscription)


            ->addColumn('name', function ($packageSubscription) {
                return wrapIt($packageSubscription->name, 10, ['columns' => 3]);
            })->addColumn('next_billing_date', function ($packageSubscription) {
                return timeZoneformatDate($packageSubscription->next_billing_date);
            })->addColumn('billing_cycle', function ($packageSubscription) {
                return ucfirst($packageSubscription->billing_cycle);
            })->addColumn('status', function ($packageSubscription) {
                return statusBadges(lcfirst($packageSubscription->status));
            })->addColumn('package_name', function ($packageSubscription) {
                return ucfirst(isset($packageSubscription->package->name) ? wrapIt($packageSubscription->package->name, 10, ['columns' => 3]) : '');
            })
            ->addColumn('vendor_name', function ($packageSubscription) {
                return ucfirst(isset($packageSubscription->vendor->name) ? wrapIt($packageSubscription->vendor->name, 10, ['columns' => 3]) : '');
            })->addColumn('action', function ($packageSubscription) {
                $show = '<a title="' . __('Show') . '" href="' . route('packageSubscription.show', ['id' => $packageSubscription->id]) . '" class="btn btn-xs btn-outline-dark"><i class="feather icon-eye"></i></a>&nbsp';
                $edit = '<a title="' . __('Edit') . '" href="' . route('packageSubscription.edit', ['id' => $packageSubscription->id]) . '" class="btn btn-xs btn-primary"><i class="feather icon-edit"></i></a>&nbsp';

                $delete = '<form method="post" action="' . route('packageSubscription.destroy', ['id' => $packageSubscription->id]) . '" id="delete-packageSubscription-'. $packageSubscription->id . '" accept-charset="UTF-8" class="display_inline">
                        ' . csrf_field() . '
                        <button title="' . __('Delete') . '" class="btn btn-xs btn-danger" type="button" data-id=' . $packageSubscription->id . ' data-label="Delete" data-delete="packageSubscription" data-toggle="modal" data-target="#confirmDelete" data-title="' . __('Delete :x', ['x' => __('Package Subscription')]) . '" data-message="' . __('Are you sure to delete this?') . '">
                        <i class="feather icon-trash-2"></i>
                        </button>
                        </form>';

                $str = '';
                if ($this->hasPermission(['App\Http\Controllers\PackageSubscriptionController@show'])) {
                    $str .= $show;
                }
                if ($this->hasPermission(['App\Http\Controllers\PackageSubscriptionController@edit'])) {
                    $str .= $edit;
                }
                if ($this->hasPermission(['App\Http\Controllers\PackageSubscriptionController@destroy'])) {
                    $str .= $delete;
                }
                return $str;
            })

            ->rawColumns(['name', 'vendor_name', 'package_name', 'next_billing_date', 'billing_cycle', 'status', 'action'])
            ->make(true);
    }

    public function query()
    {
        $packageSubscription = PackageSubscription::select('id', 'name', 'next_billing_date', 'billing_cycle', 'status', 'vendor_id', 'package_id')->with(['package:id,name', 'vendor:id,name']);
        return $this->applyScopes($packageSubscription);
    }

    public function html()
    {
        return $this->builder()

        ->addColumn(['data' => 'name', 'name' => 'name', 'title' => __('Name')])
        ->addColumn(['data' => 'vendor_name', 'name' => 'vendor', 'title' => __('Vendor')])
        ->addColumn(['data' => 'package_name', 'name' => 'package', 'title' => __('Package')])
        ->addColumn(['data' => 'next_billing_date', 'name' => 'next_billing_date', 'title' => __('Next :x', ['x' => __('Billing Date')])])
        ->addColumn(['data' => 'billing_cycle', 'name' => 'billing_cycle', 'title' => __('Billing Cycle')])
        ->addColumn(['data'=> 'status', 'name' => 'status', 'title' => __('Status')])

        ->addColumn(['data'=> 'action', 'name' => 'action', 'title' => __('Action'), 'width' => '5%',
            'visible' => $this->hasPermission(['App\Http\Controllers\PackageSubscriptionController@edit', 'App\Http\Controllers\PackageSubscriptionController@destroy', 'App\Http\Controllers\PackageSubscriptionController@show']),
            'orderable' => false, 'searchable' => false])

        ->parameters(dataTableOptions());
    }
}
