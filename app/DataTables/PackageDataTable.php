<?php
/**
 * @package PackageDataTable
 * @author techvillage <support@techvill.org>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @created 31-08-2021
 * @modified 04-10-2021
 */

namespace App\DataTables;

use App\DataTables\DataTable;
use App\Models\{
    Package
};

class PackageDataTable extends DataTable
{
    public function ajax()
    {
        $packages = $this->query();
        return datatables()
            ->of($packages)
            ->addColumn('name', function ($packages) {
                return wrapIt($packages->name, 10, ['columns' => 2]);
            })->addColumn('code', function ($packages) {
                return wrapIt($packages->code, 10, ['columns' => 2]);
            })->addColumn('price', function ($packages) {
                return number_format((float)$packages->price, $this->preference['decimal_digits'], '.', '');
            })->addColumn('is_private', function ($packages) {
                return $packages->is_private == 1 ? __('Yes') : __('No');
            })->addColumn('status', function ($packages) {
                return statusBadges(lcfirst($packages->status));
            })->addColumn('action', function ($packages) {
                $edit = '<a title="' . __('Edit :x', ['x' => __('Package')]) . '" href="' . route('package.edit', ['id' => $packages->id]) . '" class="btn btn-xs btn-primary"><i class="feather icon-edit"></i></a>&nbsp';

                $delete = '<form method="post" action="' . route('package.destroy', ['id' => $packages->id]) . '" id="delete-packages-'. $packages->id . '" accept-charset="UTF-8" class="display_inline">
                        ' . csrf_field() . '
                        <button title="' . __('Delete :x', ['x' => __('Package')]) . '" class="btn btn-xs btn-danger" type="button" data-id=' . $packages->id . ' data-label="Delete" data-delete="packages" data-toggle="modal" data-target="#confirmDelete" data-title="' . __('Delete :x', ['x' => __('Package')]) . '" data-message="' . __('Are you sure to delete this?') . '">
                        <i class="feather icon-trash-2"></i>
                        </button>
                        </form>';

                $str = '';
                if ($this->hasPermission(['App\Http\Controllers\PackageController@edit'])) {
                    $str .= $edit;
                }
                if ($this->hasPermission(['App\Http\Controllers\PackageController@destroy']) && !isset($packages->packageSubscription)) {
                    $str .= $delete;
                }
                return $str;
            })

            ->rawColumns(['name', 'code', 'price', 'billing_cycle', 'is_private', 'status', 'action'])
            ->make(true);
    }

    public function query()
    {
        $packages = Package::select('id', 'name', 'code', 'price', 'billing_cycle', 'is_private', 'status')->with('packageSubscription:package_id');
        return $this->applyScopes($packages);
    }

    public function html()
    {
        return $this->builder()

        ->addColumn(['data' => 'name', 'name' => 'name', 'title' => __('Name')])
        ->addColumn(['data' => 'code', 'name' => 'code', 'title' => __('Code')])
        ->addColumn(['data' => 'price', 'name' => 'price', 'title' => __('Price')])
        ->addColumn(['data' => 'billing_cycle', 'name' => 'billing_cycle', 'title' => __('Billing Cycle')])
        ->addColumn(['data'=> 'is_private', 'name' => 'is_private', 'title' => __('Private')])
        ->addColumn(['data'=> 'status', 'name' => 'status', 'title' => __('Status')])
        ->addColumn(['data'=> 'action', 'name' => 'action', 'title' => __('Action'), 'width' => '5%',
            'visible' => $this->hasPermission(['App\Http\Controllers\PackageController@edit', 'App\Http\Controllers\PackageController@destroy']),
            'orderable' => false, 'searchable' => false])

        ->parameters(dataTableOptions());
    }
}
