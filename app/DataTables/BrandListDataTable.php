<?php
/**
 * @package BrandListDataTable
 * @author techvillage <support@techvill.org>
 * @contributor Sakawat Hossain Rony <[sakawat.techvill@gmail.com]>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @created 25-08-2021
 * @modified 04-10-2021
 */

namespace App\DataTables;

use App\DataTables\DataTable;
use App\Models\{
    Brand
};

class BrandListDataTable extends DataTable
{
    public function ajax()
    {
        $brands = $this->query();
        return datatables()
            ->of($brands)

            ->addColumn('image', function ($brands) {
                return '<img src="' . $brands->fileUrl() . '" alt="" width="50" height="50">';
            })

            ->addColumn('name', function ($brands) {
                return '<a href="' . route('brands.edit', ['id' => $brands->id]) . '">' . wrapIt($brands->name, 10, ['columns' => 2]) . '</a>';
            })

            ->addColumn('vendor', function ($brands) {
                return wrapIt(optional($brands->vendor)->name, 10, ['columns' => 2]) ;
            })->addColumn('status', function ($brands) {
                return statusBadges(lcfirst($brands->status));
            })->addColumn('created_at', function ($brands) {
                return $brands->format_created_at;
            })

            ->addColumn('action', function ($brands) {
                $edit = '<a title="' . __('Edit') . '" href="' . route('brands.edit', ['id' => $brands->id]) .'" class="btn btn-xs btn-primary"><i class="feather icon-edit"></i></a>&nbsp;';

                $delete = '<form method="post" action="' . route('brands.destroy', ['id' => $brands->id]) .'" id="delete-user-'. $brands->id . '" accept-charset="UTF-8" class="display_inline">
                        ' . csrf_field() . '
                        <button title="' . __('Delete') . '" class="btn btn-xs btn-danger" type="button" data-id=' . $brands->id . ' data-delete="user" data-label="Delete" data-toggle="modal" data-target="#confirmDelete" data-title="' . __('Delete :x', ['x' => __('Brand')]) . '" data-message="' . __('Are you sure to delete this?') . '">
                        <i class="feather icon-trash-2"></i>
                        </button>
                        </form>';

                $str = '';
                if ($this->hasPermission(['App\Http\Controllers\BrandController@edit'])) {
                    $str .= $edit;
                }
                if ($this->hasPermission(['App\Http\Controllers\BrandController@destroy'])) {
                    $str .= $delete;
                }
                return $str;
            })

            ->rawColumns(['image', 'vendor', 'name', 'status', 'action'])
            ->filter(function ($instance){
                if(in_array(request('status'), getStatus())) {
                    $instance->where('status', request('status'));
                }
                if (request('vendor')) {
                    $instance->whereHas('vendor', function ($query) {
                        $query->where('id', request('vendor'));
                    });
                }

                if (isset(request('search')['value'])) {
                    $keyword = xss_clean(request('search')['value']);
                    if (!empty($keyword)) {
                        $instance->where(function ($query) use ($keyword) {
                            $query->WhereLike('name', $keyword)
                                ->OrWhereLike('status', $keyword)
                                ->orWhereHas('vendor', function ($query)use($keyword) {
                                    $query->WhereLike('name', $keyword);
                                });
                        });
                    }
                }
            })
            ->make(true);
    }

    public function query()
    {
        $brands = Brand::query()->with(['vendor']);

        return $this->applyScopes($brands);
    }

    public function html()
    {
        return $this->builder()

            ->addColumn(['data' => 'image', 'name' => 'image', 'title' => __('Image'), 'orderable' => false, 'searchable' => false])

            ->addColumn(['data' => 'name', 'name' => 'name', 'title' => __('Name')])

            ->addColumn(['data' => 'vendor', 'name' => 'vendor', 'title' => __('Vendor')])

            ->addColumn(['data' => 'status', 'name' => 'status', 'title' => __('Status')])

            ->addColumn(['data' => 'created_at', 'name' => 'created_at', 'title' => __('Created at')])

            ->addColumn(['data'=> 'action', 'name' => 'action', 'title' => __('Action'), 'width' => '5%',
            'visible' => $this->hasPermission(['App\Http\Controllers\BrandController@edit', 'App\Http\Controllers\BrandController@destroy']),
            'orderable' => false, 'searchable' => false])

            ->parameters(dataTableOptions());
    }

}
