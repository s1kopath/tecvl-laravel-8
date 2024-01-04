<?php
/**
 * @package OptionDataTable
 * @author techvillage <support@techvill.org>
 * @contributor Sakawat Hossain Rony <[sakawat.techvill@gmail.com]>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @created 13-09-2021
 * @modified 04-10-2021
 */
namespace App\DataTables;

use App\Models\{
    OptionGroup
};
use App\DataTables\DataTable;

class OptionDataTable extends DataTable
{
    public function ajax()
    {
        $options = $this->query();
        return datatables()
            ->of($options)

            ->addColumn('name', function ($options) {
                return '<a href="' . route('option.edit', ['id' => $options->id]) . '">' . wrapIt($options->name, 10, ['columns' => 2,'trim' => true, 'trimLength' => 20]) . '</a>';
            })

            ->addColumn('created_at', function ($options) {
                return $options->format_created_at;
            })

            ->addColumn('type', function ($options) {
                return ucwords(str_replace("_"," ",$options->type));
            })

            ->addColumn('is_required', function ($options) {
                return $options->is_required == 1 ? __('Yes') : __('No');
            })

            ->addColumn('action', function ($options) {
                $edit = '<a title="' . __('Edit') . '" href="' . route('option.edit', ['id' => $options->id]) .'" class="btn btn-xs btn-primary"><i class="feather icon-edit"></i></a>&nbsp;';

                $delete = '<form method="post" action="' . route('option.destroy', ['id' => $options->id]) .'" id="delete-user-'. $options->id . '" accept-charset="UTF-8" class="display_inline">
                        ' . method_field('DELETE') . '
                        ' . csrf_field() . '
                        <button title="' . __('Delete') . '" class="btn btn-xs btn-danger" type="button" data-id=' . $options->id . ' data-delete="user" data-label="Delete" data-toggle="modal" data-target="#confirmDelete" data-title="' . __('Delete :x', ['x' => __('Option')]) . '" data-message="' . __('Are you sure to delete this?') . '">
                        <i class="feather icon-trash-2"></i>
                        </button>
                        </form>';

                $str = '';
                if ($this->hasPermission(['App\Http\Controllers\OptionController@edit'])) {
                    $str .= $edit;
                }
                if ($this->hasPermission(['App\Http\Controllers\OptionController@destroy']) && !in_array($options->id, [1, 2])) {
                    $str .= $delete;
                }
                return $str;
            })

            ->rawColumns(['name', 'type', 'is_required', 'action'])
            ->filter(function ($instance){
                if (isset(request('search')['value'])) {
                    $keyword = xss_clean(request('search')['value']);
                    if (!empty($keyword)) {
                        $instance->where(function ($query) use ($keyword) {
                            $query->WhereLike('name', $keyword)
                                ->OrWhereLike('type', $keyword);
                        });
                    }
                }
            })
            ->make(true);
    }

    public function query()
    {
        $options = OptionGroup::query();

        return $this->applyScopes($options);
    }

    public function html()
    {
        return $this->builder()

            ->addColumn(['data' => 'name', 'name' => 'name', 'title' => __('Name')])

            ->addColumn(['data' => 'type', 'name' => 'type', 'title' => __('Type')])

            ->addColumn(['data' => 'is_required', 'name' => 'is_required', 'title' => __('Required')])

            ->addColumn(['data' => 'created_at', 'name' => 'created_at', 'title' => __('Created at')])

            ->addColumn(['data'=> 'action', 'name' => 'action', 'title' => __('Action'), 'width' => '5%',
            'visible' => $this->hasPermission(['App\Http\Controllers\OptionController@edit', 'App\Http\Controllers\OptionController@destroy']),
            'orderable' => false, 'searchable' => false])

            ->parameters(dataTableOptions());
    }
}
