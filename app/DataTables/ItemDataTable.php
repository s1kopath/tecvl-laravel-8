<?php
/**
 * @package ItemDataTable
 * @author techvillage <support@techvill.org>
 * @contributor Sakawat Hossain Rony <[sakawat.techvill@gmail.com]>
 * @created 26-09-2021
 */
namespace App\DataTables;

use App\Models\Item;
use App\DataTables\DataTable;

class ItemDataTable extends DataTable
{
    public function ajax()
    {
        $items = $this->query();
        return datatables()
            ->of($items)
            ->addColumn('image', function ($items) {
                return '<img src="' . $items->fileUrl() . '" alt="" width="50" height="50">';
            })
            ->editColumn('name', function ($items) {
                if (!empty($items->sku)) {
                    return '<a href="' . route('item.view', ['id' => $items->id]) . '" title="' . $items->name . '">' . wrapIt($items->name, 8, ['columns' => 5, 'trim' => true, 'trimLength' => 15]) . '</a>'.
                        '<br><span title="' . $items->sku . '"> (' . wrapIt($items->sku, 10, ['columns' => 5, 'trim' => true, 'trimLength' => 15]) . ') </span>';
                } else {
                    return '<a href="' . route('item.view', ['id' => $items->id]) . '" title="' . $items->name . '">' . wrapIt($items->name, 8, ['columns' => 5, 'trim' => true, 'trimLength' => 15]) . '</a>';
                }
            })
            ->addColumn('brand', function ($items) {
                return wrapIt(optional($items->brand)->name, 10, ['columns' => 5]);
            })
            ->addColumn('sku', function ($items) {
                return wrapIt($items->sku, 10, ['columns' => 5]);
            })
            ->addColumn('category', function ($items) {
                return wrapIt(optional(optional($items->itemCategory)->category)->name, 10, ['columns' => 5, 'trim' => true, 'trimLength' => 25]);
            })
            ->addColumn('vendor', function ($items) {
                return wrapIt(optional($items->vendor)->name, 10, ['columns' => 5, 'trim' => true, 'trimLength' => 25]);
            })
            ->addColumn('price', function ($items) {
                return formatCurrencyAmount($items->price);
            })->addColumn('status', function ($items) {
                return statusBadges($items->status);
            })
            ->addColumn('action', function ($items) {
                $edit = '<a title="' . __('Edit') . '" href="' . route('item.edit', ['id' => $items->id]) .'" class="btn btn-xs btn-primary"><i class="feather icon-edit"></i></a>&nbsp;';

                $delete = '<form method="post" action="' . route('item.destroy', ['id' => $items->id]) .'" id="delete-user-'. $items->id . '" accept-charset="UTF-8" class="display_inline">
                        ' . method_field('DELETE') . '
                        ' . csrf_field() . '
                        <button title="' . __('Delete') . '" class="btn btn-xs btn-danger" type="button" data-id=' . $items->id . ' data-delete="user" data-label="Delete" data-toggle="modal" data-target="#confirmDelete" data-title="' . __('Delete :x', ['x' => __('Item')]) . '" data-message="' . __('Are you sure to delete this?') . '">
                        <i class="feather icon-trash-2"></i>
                        </button>
                        </form>';

                $str = '';
                if ($this->hasPermission(['App\Http\Controllers\ItemController@edit'])) {
                    $str .= $edit;
                }
                if ($this->hasPermission(['App\Http\Controllers\ItemController@destroy'])) {
                    $str .= $delete;
                }
                return $str;
            })
            ->rawColumns(['image', 'vendor', 'brand', 'name', 'vendor', 'price', 'status', 'action', 'sku', 'category'])
            ->make(true);
    }

    public function query()
    {
        return $this->applyScopes(Item::filter());
    }

    public function html()
    {
        return $this->builder()
            ->addColumn(['data' => 'image', 'name' => 'image', 'title' => __('Image'), 'orderable' => false, 'searchable' => false])
            ->addColumn(['data' => 'name', 'name' => 'name', 'title' => __('Name')])
            ->addColumn(['data' => 'item_code', 'name' => 'item_code', 'title' => __('Item Code')])
            ->addColumn(['data' => 'vendor', 'name' => 'vendor', 'title' => __('Vendor')])
            ->addColumn(['data' => 'category', 'name' => 'category', 'title' => __('Category')])
            ->addColumn(['data' => 'brand', 'name' => 'brand', 'title' => __('Brand')])
            ->addColumn(['data' => 'price', 'name' => 'price', 'title' => __('Price')])
            ->addColumn(['data' => 'status', 'name' => 'status', 'title' => __('Status')])
            ->addColumn(['data'=> 'action', 'name' => 'action', 'title' => __('Action'), 'width' => '5%',
                'visible' => $this->hasPermission(['App\Http\Controllers\ItemController@edit', 'App\Http\Controllers\ItemController@destroy']),
                'orderable' => false, 'searchable' => false])
            ->parameters(dataTableOptions());
    }
}
