<?php
/**
 * @package SmsTemplateListDataTable
 * @author techvillage <support@techvill.org>
 * @contributor Sakawat Hossain Rony <[sakawat.techvill@gmail.com]>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @created 15-08-2021
 * @modified 04-10-2021
 */

namespace App\DataTables;

use App\Models\{
    SmsTemplate
};
use App\DataTables\DataTable;
use DB;
use Session;

class SmsTemplateListDataTable extends DataTable
{
    public function ajax()
    {
        $templates = $this->query();
        return datatables()
            ->of($templates)

            ->addColumn('name', function ($templates) {
                return isset($templates->name) ? "<a href='". route('smsTemplates.edit', ['id' => $templates->id]) ."'>" . $templates->name . "</a>": '';
            })

            ->addColumn('created_at', function ($templates) {
                return $templates->format_created_at;
            })

            ->addColumn('status', function ($templates) {
                return statusBadges(lcfirst($templates->status));
            })

            ->addColumn('action', function ($templates) {
                $edit = '<a title="' . __('Edit') . '" href="'. route('smsTemplates.edit', ['id' => $templates->id]) .'" class="btn btn-xs btn-primary"><i class="feather icon-edit"></i></a>&nbsp;';

                $delete = '<form method="post" action="' . route('smsTemplates.destroy', ['id' => $templates->id]) . '" id="delete-sms-template-' . $templates->id . '" accept-charset="UTF-8" class="display_inline">
                        ' . csrf_field() . '
                        <button title="' . __('Delete') . '" class="btn btn-xs btn-danger" type="button" data-id=' . $templates->id . ' data-label="Delete" data-delete="sms-template" data-toggle="modal" data-target="#confirmDelete" data-title="' . __('Delete :x', ['x' => __('Template')]) . '" data-message="' . __('Are you sure to delete this?') . '">
                        <i class="feather icon-trash-2"></i>
                        </button>
                        </form>';

                $str = '';
                if ($this->hasPermission(['App\Http\Controllers\SmsTemplateController@edit'])) {
                    $str .= $edit;
                }
                if ($this->hasPermission(['App\Http\Controllers\SmsTemplateController@destroy'])) {
                    $str .= $delete;
                }
                return $str;
            })

            ->rawColumns(['name', 'status', 'slug', 'action'])
            ->make(true);
    }

    public function query()
    {
        $templates = SmsTemplate::getAll()->whereNull('parent_id');
        return $this->applyScopes($templates);
    }

    public function html()
    {
        return $this->builder()

            ->addColumn(['data' => 'name', 'name' => 'name', 'title' => __('Name')])

            ->addColumn(['data' => 'slug', 'name' => 'slug', 'title' => __('Slug')])

            ->addColumn(['data' => 'status', 'name' => 'status', 'title' => __('Status')])

            ->addColumn(['data' => 'created_at', 'name' => 'created_at', 'title' => __('Created at')])

            ->addColumn(['data'=> 'action', 'name' => 'action', 'title' => __('Action'), 'width' => '5%',
            'visible' => $this->hasPermission(['App\Http\Controllers\SmsTemplateController@edit', 'App\Http\Controllers\SmsTemplateController@destroy']),
            'orderable' => false, 'searchable' => false])

            ->parameters(dataTableOptions());
    }
}
