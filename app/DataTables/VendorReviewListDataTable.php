<?php
/**
 * @package VendorReviewListDataTable
 * @author techvillage <support@techvill.org>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @created 19-12-2021
 */

namespace App\DataTables;

use App\DataTables\DataTable;
use App\Models\Review;

class VendorReviewListDataTable extends DataTable
{
    public function ajax()
    {
        $reviews = $this->query();
        return datatables()
            ->of($reviews)
            ->editColumn('item.name', function ($reviews) {
                return wrapIt(optional($reviews->item)->name, 10, ['columns' => 3]);
            })
            ->editColumn('comments', function ($reviews) {
                return wrapIt($reviews->comments, 10, ['columns' => 3, 'trim' => true]);
            })
            ->addColumn('user', function ($reviews) {
                return wrapIt(optional($reviews->user)->name, 10, ['columns' => 3]) ;
            })
            ->addColumn('status', function ($reviews) {
                return statusBadges(lcfirst($reviews->status));
            })
            ->addColumn('created_at', function ($reviews) {
                return timeZoneformatDate($reviews->created_at);
            })
            ->addColumn('action', function ($reviews) {
                $edit = '<a title="' . __('Edit') . '" href="' . route('vendor.reviewEdit', ['id' => $reviews->id]) .'" class="btn btn-xs btn-primary edit_review" data-toggle="modal" data-target="#edit-review" data-id=' . $reviews->id . '><i class="feather icon-edit"></i></a>&nbsp;';

                $view = '<a title="' . __('Show') . '" href="' . route('vendor.reviewView', ['id' => $reviews->id]) . '" class="btn btn-xs btn-outline-dark"><i class="feather icon-eye"></i></a>&nbsp;';

                $delete = '<form method="post" action="' . route('vendor.reviewDestroy', ['id' => $reviews->id]) .'" id="delete-review-'. $reviews->id . '" accept-charset="UTF-8" class="display_inline">
                        ' . csrf_field() . '
                        <button title="' . __('Delete') . '" class="btn btn-xs btn-danger" type="button" data-id=' . $reviews->id . ' data-delete="review" data-label="Delete" data-toggle="modal" data-target="#confirmDelete" data-title="' . __('Delete :x', ['x' => __('Review')]) . '" data-message="' . __('Are you sure to delete this?') . '">
                        <i class="feather icon-trash-2"></i>
                        </button>
                        </form>';

                $str = '';
                if ($this->hasPermission(['App\Http\Controllers\Vendor\ReviewController@view'])) {
                    $str .= $view;
                }
                if ($this->hasPermission(['App\Http\Controllers\Vendor\ReviewController@edit'])) {
                    $str .= $edit;
                }
                if ($this->hasPermission(['App\Http\Controllers\Vendor\ReviewController@destroy'])) {
                    $str .= $delete;
                }
                return $str;
            })

            ->rawColumns(['comments', 'item.name', 'user', 'status', 'created_at', 'action'])
            ->make(true);
    }

    public function query()
    {
        $reviews = Review::select('reviews.id', 'comments', 'item_id', 'user_id', 'rating', 'reviews.status')->with(['item:id,name', 'user:id,name'])->filter();

        return $this->applyScopes($reviews);
    }

    public function html()
    {
        return $this->builder()
            ->addColumn(['data' => 'comments', 'name' => 'comments', 'title' => __('Comments')])
            ->addColumn(['data' => 'item.name', 'name' => 'item.name', 'title' => __('Item')])
            ->addColumn(['data' => 'user', 'name' => 'user', 'title' => __('Customer')])
            ->addColumn(['data' => 'rating', 'name' => 'rating', 'title' => __('Rating')])
            ->addColumn(['data' => 'status', 'name' => 'status', 'title' => __('Status')])
            ->addColumn(['data' => 'created_at', 'name' => 'created_at', 'title' => __('Created at')])
            ->addColumn(['data'=> 'action', 'name' => 'action', 'title' => __('Action'), 'width' => '5%',
                'visible' => $this->hasPermission(['App\Http\Controllers\Vendor\ReviewController@edit', 'App\Http\Controllers\Vendor\ReviewController@show', 'App\Http\Controllers\Vendor\ReviewController@destroy']),
                'orderable' => false, 'searchable' => false])
            ->parameters(dataTableOptions());
    }
}
