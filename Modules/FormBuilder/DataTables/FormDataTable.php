<?php

/**
 * @package FormDataTable
 * @author techvillage <support@techvill.org>
 * @contributor Muhammad AR Zihad <[zihad.techvill@gmail.com]>
 * @created 21-03-2022
 */

namespace Modules\FormBuilder\DataTables;

use App\DataTables\DataTable;
use Modules\FormBuilder\Entities\Form;

class FormDataTable extends DataTable
{
    public function ajax()
    {
        $form = $this->query();
        return datatables()
            ->of($form)

            ->addColumn('name', function ($form) {
                return '<a href="' .  route('formbuilder::forms.edit', $form->id) . '">' . $form->name . '</a>';
            })->addColumn('visibility', function ($form) {
                return statusBadges($form->visibility);
            })->addColumn('edit_allow', function ($form) {
                return statusBadges($form->allowsEdit() ? __('Yes') : __('No'));
            })->addColumn('submissions', function ($form) {
                return $form->submissions_count;
            })->addColumn('action', function ($form) {

                $edit = '<a title="' . __('Edit :x', ['x' => __('Form')]) . '" href="' . route('formbuilder::forms.edit', ['form' => $form->id]) . '" class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></a>&nbsp';

                $delete = '<form method="post"
                            action="' . route('formbuilder::forms.destroy', ['form' => $form->id]) . '"
                            id="delete-form-' . $form->id . '" accept-charset="UTF-8"
                            class="display_inline">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button title="' . __('Delete :x', ['x' => __('Form')]) . '" class="btn btn-xs btn-danger"
                                type="button"
                                data-form="delete-form-' . $form->id . '"
                                data-id=' . $form->id . '
                                data-title="' . __('Delete :x', ['x' => __('Form')]) . '"
                                data-delete="form" data-label="'. __('Delete') . '"
                                data-toggle="modal" data-target="#confirmDelete"
                                data-message="' . __('Are you sure to delete this?') . '">
                                <i class="fa fa-trash-o"></i>
                            </button>
                        </form>';

                $data = '<a href="' . route("formbuilder::submissions.index", ['fid' => $form->id]) . '"
                            class="btn btn-xs btn-primary mr-2"
                            title="' . __("View submissions for :x", ['x' => $form->name]) . '">
                                <i class="fa fa-th-list"></i></a>';

                $copy = '<button class="btn btn-info btn-xs mr-2 clipboard"
                                                        data-clipboard-text="' . route("formbuilder::form.render", $form->identifier) . '"
                                                        data-message="" data-original="" title="' . __("Copy form URL to clipboard") . '">
                                                        <i class="fa fa-clipboard"></i>
                                                    </button>';

                $show = '<a href="' . route("formbuilder::forms.show", $form) . '"
                                                        class="btn btn-info btn-xs mr-2"
                                                        title="' . __("Preview form :x", ["x" =>$form->name]) . '">
                                                        <i class="fa fa-eye"></i></a>';

                return $data . $show . $copy . $edit . $delete;
            })

            ->rawColumns(['name', 'visibility', 'action', 'edit_allow'])
            ->make(true);
    }

    public function query()
    {
        $forms = Form::notKyc()->withCount('submissions')->get();
        return $this->applyScopes($forms);
    }

    public function html()
    {
        return $this->builder()

            ->addColumn(['data' => 'name', 'name' => 'name', 'title' => __('Name')])
            ->addColumn(['data' => 'visibility', 'name' => 'visibility', 'title' => __('Visibility')])
            ->addColumn(['data' => 'edit_allow', 'name' => 'edit_allow', 'title' => __('Allow Edit')])
            ->addColumn(['data' => 'submissions', 'name' => 'submissions', 'title' => __('Submissions')])
            ->addColumn([
                'data' => 'action', 'name' => 'action', 'title' => __('Action'), 'width' => '10%',
                'orderable' => false, 'searchable' => false
            ])
            ->dom('Bfrtip')
            ->parameters(dataTableOptions());
    }
}
