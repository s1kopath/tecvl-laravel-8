<?php
/**
 * @package ReviewListDataTable
 * @author techvillage <support@techvill.org>
 * @contributor Sakawat Hossain Rony <[sakawat.techvill@gmail.com]>
 * @created 15-11-2021
 */

namespace App\DataTables;

use App\DataTables\DataTable;
use App\Models\Review;

class ReviewListDataTable extends DataTable
{
    public function ajax()
    {
        $reviews = $this->query();
        return datatables()
            ->of($reviews)

            ->editColumn('item.name', function ($reviews) {
                return '<a href="' . route('item.view', ['id' => ($reviews->item)->id]) . '">' . wrapIt(optional($reviews->item)->name, 10, ['columns' => 3, 'trim' => true]) . '</a>';
            })

            ->addColumn('comments', function ($reviews) {
                return wrapIt($reviews->comments, 10, ['columns' => 3, 'trim' => true]);
            })

            ->addColumn('user.name', function ($reviews) {
            return '<a href="' . route('users.edit', ['id' => ($reviews->user)->id]) . '">' . wrapIt(($reviews->user)->name,10, ['columns' => 3]) . '</a>';
            })
            ->addColumn('status', function ($reviews) {
                return statusBadges($reviews->status);
            })
            ->addColumn('created_at', function ($reviews) {
                return $reviews->format_created_at;
            })

            ->addColumn('action', function ($reviews) {
                $edit = '<a title="' . __('Edit') . '" href="' . route('review.edit', ['id' => $reviews->id]) .'" class="btn btn-xs btn-primary edit_review" data-toggle="modal" data-target="#edit-review" data-id=' . $reviews->id . '><i class="feather icon-edit"></i></a>&nbsp;';

                $view = '<a title="' . __('Show') . '" href="' . route('review.view', ['id' => $reviews->id]) . '" class="btn btn-xs btn-outline-dark"><i class="feather icon-eye"></i></a>&nbsp;';

                $delete = '<form method="post" action="' . route('review.destroy', ['id' => $reviews->id]) .'" id="delete-review-'. $reviews->id . '" accept-charset="UTF-8" class="display_inline">
                        ' . csrf_field() . '
                        <button title="' . __('Delete') . '" class="btn btn-xs btn-danger" type="button" data-id=' . $reviews->id . ' data-delete="review" data-label="Delete" data-toggle="modal" data-target="#confirmDelete" data-title="' . __('Delete :x', ['x' => __('Review')]) . '" data-message="' . __('Are you sure to delete this?') . '">
                        <i class="feather icon-trash-2"></i>
                        </button>
                        </form>';

                $str = '';
                if ($this->hasPermission(['App\Http\Controllers\ReviewController@view'])) {
                    $str .= $view;
                }
                if ($this->hasPermission(['App\Http\Controllers\ReviewController@edit'])) {
                    $str .= $edit;
                }
                if ($this->hasPermission(['App\Http\Controllers\ReviewController@destroy'])) {
                    $str .= $delete;
                }
                return $str;
            })

            ->rawColumns(['comments', 'item.name', 'user.name', 'status', 'action'])
            ->filter(function ($instance){
                if (in_array(request('status'), ['Active', 'Inactive', 'Pending'])) {
                    $instance->where('status', request('status'));
                }

                if (request('rating')) {
                    $instance->where('rating', request('rating'));
                }

                $keyword = '';
                if (isset(request('search')['value'])) {
                    $keyword = xss_clean(request('search')['value']);
                }
                if (!empty($keyword)) {
                    $instance->where(function ($query) use ($keyword) {
                        $query->WhereLike('comments', $keyword)
                            ->OrWhere('rating', $keyword)
                            ->OrWhereLike('status', $keyword)
                            ->OrWhereHas('item', function($query) use($keyword) {
                                $query->WhereLike('name', $keyword);
                            });

                        $keyword = ucfirst(strtolower($keyword));
                        $public = [__('No') => '0', __('Yes') => '1'];
                        if (array_key_exists($keyword, $public)) {
                            $query->OrWhere('is_public', $public[$keyword]);
                        }
                    });
                }
            })
            ->make(true);
    }

    public function query()
    {
        $reviews = Review::select('reviews.id', 'comments', 'item_id', 'user_id', 'rating', 'reviews.status', 'created_at')->with(['item:id,name', 'user:id,name']);

        return $this->applyScopes($reviews);
    }

    public function html()
    {
        return $this->builder()

            ->addColumn(['data' => 'comments', 'name' => 'comments', 'title' => __('Comments')])

            ->addColumn(['data' => 'item.name', 'name' => 'item.name', 'title' => __('Item')])

            ->addColumn(['data' => 'user.name', 'name' => 'user.name', 'title' => __('Customer')])

            ->addColumn(['data' => 'rating', 'name' => 'rating', 'title' => __('Rating')])

            ->addColumn(['data' => 'status', 'name' => 'status', 'title' => __('Status')])

            ->addColumn(['data' => 'created_at', 'name' => 'created_at', 'title' => __('Created at')])

            ->addColumn(['data'=> 'action', 'name' => 'action', 'title' => __('Action'), 'width' => '5%',
                'visible' => $this->hasPermission(['App\Http\Controllers\ReviewController@edit', 'App\Http\Controllers\ReviewController@destroy']),
                'orderable' => false, 'searchable' => false])

            ->parameters(dataTableOptions());
    }

}
