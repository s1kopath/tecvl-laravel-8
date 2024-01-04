<?php
/**
 * @package VendorListDataTable
 * @author techvillage <support@techvill.org>
 * @contributor Sakawat Hossain Rony <[sakawat.techvill@gmail.com]>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @created 17-08-2021
 * @modified 04-10-2021
 */

namespace App\DataTables;

use App\Models\{
    Vendor
};
use App\DataTables\DataTable;

class VendorListDataTable extends DataTable
{
    public function ajax()
    {
        $vendors = $this->query();
        return datatables()
            ->of($vendors)
            ->addColumn('logo', function ($vendors) {
                return '<img src="' . $vendors->fileUrl() . '" alt="" width="50" height="50">';
            })->editColumn('name', function ($vendors) {
                return '<a href="' . route('vendors.edit', ['id' => $vendors->id]) . '">' . wrapIt($vendors->name, 10) . '</a>';
            })->editColumn('email', function ($vendors) {
                return wrapIt($vendors->email, 20, ['columns' => 2]);
            })->editColumn('phone', function ($vendors) {
                return wrapIt($vendors->phone, 15, ['columns' => 2]);
            })->editColumn('created_at', function ($vendors) {
                return $vendors->format_created_at;
            })->editColumn('status', function ($vendors) {
                return statusBadges(lcfirst($vendors->status));
            })->addColumn('action', function ($vendors) {
                $edit = '<a title="' . __('Show') . '" href="' . route('vendors.edit', ['id' => $vendors->id]) . '" class="btn btn-xs btn-outline-dark"><i class="feather icon-eye"></i></a>&nbsp;';

                $delete = '<form method="post" action="' . route('vendors.destroy', ['id' => $vendors->id]) . '" id="delete-user-' . $vendors->id . '" accept-charset="UTF-8" class="display_inline">
                        ' . csrf_field() . '
                        <button title="' . __('Delete') . '" class="btn btn-xs btn-danger" type="button" data-id=' . $vendors->id . ' data-delete="user" data-label="Delete" data-toggle="modal" data-target="#confirmDelete" data-title="' . __('Delete :x', ['x' => __('Vendor')]) . '" data-message="' . __('Are you sure to delete this?') . '">
                        <i class="feather icon-trash-2"></i>
                        </button>
                        </form>';

                $str = '';
                if ($this->hasPermission(['App\Http\Controllers\VendorController@edit'])) {
                    $str .= $edit;
                }
                if ($this->hasPermission(['App\Http\Controllers\VendorController@destroy'])) {
                    $str .= $delete;
                }
                return $str;
            })
            ->rawColumns(['logo', 'name', 'email', 'phone', 'status', 'action'])
            ->make(true);
    }

    public function query()
    {
        $vendors = Vendor::select('id', 'name', 'email', 'phone', 'created_at', 'status')->filter();
        return $this->applyScopes($vendors);
    }

    public function html()
    {
        return $this->builder()
            ->addColumn(['data' => 'logo', 'name' => 'logo', 'title' => __('Logo'), 'orderable' => false, 'searchable' => false])
            ->addColumn(['data' => 'name', 'name' => 'name', 'title' => __('Name')])
            ->addColumn(['data' => 'email', 'name' => 'email', 'title' => __('Email')])
            ->addColumn(['data' => 'phone', 'name' => 'phone', 'title' => __('Phone')])
            ->addColumn(['data' => 'status', 'name' => 'status', 'title' => __('Status')])
            ->addColumn(['data' => 'created_at', 'name' => 'created_at', 'title' => __('Created at')])

            ->addColumn(['data'=> 'action', 'name' => 'action', 'title' => __('Action'), 'width' => '5%',
            'visible' => $this->hasPermission(['App\Http\Controllers\VendorController@edit', 'App\Http\Controllers\VendorController@destroy']),
            'orderable' => false, 'searchable' => false])

            ->parameters(dataTableOptions());
    }
}
