<?php

/**
 * @package FormDataTable
 * @author techvillage <support@techvill.org>
 * @contributor Muhammad AR Zihad <[zihad.techvill@gmail.com]>
 * @created 21-03-2022
 */

namespace Modules\FormBuilder\DataTables;

use App\DataTables\DataTable;
use Modules\FormBuilder\Entities\Submission;

class SubmissionDataTable extends DataTable
{
    public function ajax()
    {
        $sub = $this->query();
        return datatables()
            ->of($sub)

            ->addColumn('name', function ($sub) {
                if ($sub->user && $sub->user->name) {
                    return $sub->user->name;
                }
                return __('Public');
            })->addColumn('form', function ($sub) {
                return ucfirst($sub->form->name);
            })->addColumn('updated_on', function ($sub) {
                return $sub->updated_at->toDayDateTimeString();
            })->addColumn('created_on', function ($sub) {
                return $sub->created_at->toDayDateTimeString();
            })->addColumn('action', function ($sub) {
                $edit = '<a title="' . __('Edit :x', ['x' => __('Submission')]) . '" href="' . route('formbuilder::my-submissions.edit', [$sub->id]) . '" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&nbsp';

                $delete = '<form method="post"
                            action="' . route('formbuilder::my-submissions.destroy', ['my_submission' => $sub->id]) . '"
                            id="delete-submission-' . $sub->id . '" accept-charset="UTF-8"
                            class="display_inline">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button title="' . __('Delete :x', ['x' => __('Submission')]) . '" class="btn btn-xs btn-danger"
                                type="button"
                                data-form="delete-submission-' . $sub->id . '"
                                data-id=' . $sub->id . '
                                data-title="' . __('Delete :x', ['x' => __('Submission')]) . '"
                                data-delete="submission" data-label="'. __('Delete') . '"
                                data-toggle="modal" data-target="#confirmDelete"
                                data-message="' . __('Are you sure to delete this?') . '">
                                <i class="fa fa-trash-o"></i>
                            </button>
                        </form>';

                $view = '<a href="' . route("formbuilder::my-submissions.show", [$sub->id])  . '"
                            class="btn btn-primary btn-xs mr-2" title="View submission">
                            <i class="fa fa-eye"></i>
                         </a>';

                return $view . $edit . $delete;
            })

            ->rawColumns(['name', 'visibility', 'action', 'edit_allow'])
            ->make(true);
    }

    public function query()
    {
        $subs = Submission::whereHas('form', function($q) {
            $q->notKyc();
        })->with('form:id,type,name');
        return $this->applyScopes($subs);
    }

    public function html()
    {
        return $this->builder()

            ->addColumn(['data' => 'name', 'name' => 'name', 'title' => __('Name')])
            ->addColumn(['data' => 'form', 'name' => 'form', 'title' => __('Form')])
            ->addColumn(['data' => 'updated_on', 'name' => 'updated_on', 'title' => __('Updated On')])
            ->addColumn(['data' => 'created_on', 'name' => 'created_on', 'title' => __('Created On')])
            ->addColumn([
                'data' => 'action', 'name' => 'action', 'title' => __('Action'), 'width' => '5%',
                'orderable' => false, 'searchable' => false
            ])
            ->parameters(dataTableOptions());
    }
}
