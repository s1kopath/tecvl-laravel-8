<?php

namespace Modules\FormBuilder\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\FormBuilder\DataTables\KycFormTable;
use Modules\FormBuilder\Entities\Form;
use Modules\FormBuilder\Entities\Submission;
use Modules\FormBuilder\Events\Form\FormUpdated;
use Modules\FormBuilder\Http\Requests\SaveFormRequest;
use Modules\FormBuilder\Services\Helper;

class KycController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(KycFormTable $table)
    {
        $form = Form::kyc()->first();
        return $table->render('formbuilder::kyc.index', compact('form'));
    }



    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $form = Form::kyc()->firstOrFail();

        $saveURL = route('formbuilder::kyc.update', ['form' => $form->id]);

        // get the roles to use to populate the make the 'Access' section of the form builder work
        $form_roles = Helper::getConfiguredRoles();

        return view('formbuilder::kyc.edit', compact('form', 'saveURL', 'form_roles'));
    }


    /**
     * Update KYC form.
     *
     * @param  Modules\FormBuilder\Requests\SaveFormRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaveFormRequest $request, $id)
    {
        $user = auth()->user();
        $form = Form::where(['user_id' => $user->id, 'id' => $id])->firstOrFail();

        $input = $request->except('_token');

        if ($form->update($input)) {
            // dispatch the event
            event(new FormUpdated($form));

            return response()
                ->json([
                    'success' => true,
                    'details' => 'Form successfully updated!',
                    'dest' => route('formbuilder::kyc.index'),
                ]);
        } else {
            response()->json(['success' => false, 'details' => 'Failed to update the form.']);
        }
    }


    /**
     * Show KYC form in vendor dashboard
     *
     * @param Request $request
     * @return Renderable
     */
    public function userKycForm(Request $request)
    {
        $form = Form::kyc()->first();
        $submission = Submission::where('form_id', $form->id)->where('user_id', auth()->id())->first();
        if ($submission && !$request->edit) {
            $form_headers = $submission->form->getEntriesHeader();
            return view('formbuilder::kyc.submission', compact('submission', 'form_headers'));
        } elseif ($submission && $request->edit) {
            $submission->loadSubmissionIntoFormJson();
            return view('formbuilder::kyc.sub-edit', compact('submission'));
        }
        return view('formbuilder::kyc.show', compact('form'));
    }


    /**
     * Process the form submission
     *
     * @param Request $request
     * @param string $identifier
     * @return Response
     */
    public function userKycSubmit(Request $request, $identifier)
    {
        $form = Form::where('identifier', $identifier)->firstOrFail();

        DB::beginTransaction();

        try {
            $input = $request->except('_token');

            // check if files were uploaded and process them
            $uploadedFiles = $request->allFiles();
            foreach ($uploadedFiles as $key => $file) {
                // store the file and set it's path to the value of the key holding it
                if ($file->isValid()) {
                    $input[$key] = $file->store('fb_uploads', 'public');
                }
            }

            $user_id = auth()->user()->id ?? null;

            $form->submissions()->create([
                'user_id' => $user_id,
                'content' => $input,
            ]);

            DB::commit();

            return back()->with('success', __('Form successfully submitted.'));
        } catch (Throwable $e) {
            info($e);

            DB::rollback();

            return back()->withInput()->withErrors(Helper::wtf());
        }
    }


    public function viewSubmission($id)
    {
        $submission = Submission::findOrFail($id);
        if (!$submission) {
            return back()->withErrors(__('Submission not found.'));
        }
        $form_headers = $submission->form->getEntriesHeader();
        return view('formbuilder::kyc.submission-admin', compact('submission', 'form_headers'));
    }


    /**
     * Update vendor KYC information
     *
     * @param Request $request
     * @param int $id
     * @return redirect()
     */
    public function userKycUpdateSubmission(Request $request, $id)
    {
        $submission = Submission::where(['user_id' => auth()->id(), 'id' => $id])->firstOrFail();

        if (!$submission) {
            return back()->withErrors(__('Submission not found.'));
        }

        $update = $this->updateSubmission($request, $submission);

        if ($update) {
            return back()->with('success', __('Submission updated.'));
        }
        return back()->withInput()->withErrors(Helper::wtf());
    }


    /**
     * Delete KYC submission
     * @param int $id
     * @return redirect()
     */
    public function submissionDelete($id)
    {
        try {
            $submission = Submission::findOrFail($id);
            $submission->delete();
            return redirect(route('formbuilder::kyc.index'))->with('success', __('Submission deleted.'));
        } catch (\Exception $e) {
            return back()->withErrors(__('Failed to delete submission.'));
        }
    }


    /**
     * Admin Edit KYC submission
     *
     * @param Request $request
     * @param int $id
     * @return mixed
     */
    public function editSubmission(Request $request, $id)
    {
        $submission = Submission::where(['id' => $id])->firstOrFail();

        if (!$submission) {
            return back()->with('error', __('Submission not found.'));
        }
        if ($request->isMethod('get')) {
            $submission->loadSubmissionIntoFormJson();
            return view('formbuilder::kyc.sub-edit-admin', compact('submission'));
        }

        $update = $this->updateSubmission($request, $submission);

        if ($update) {
            return back()->with('success', __('Submission updated.'));
        }
        return back()->withInput()->with('error', Helper::wtf());
    }


    /**
     * Update KYC Submission Data
     *
     * @param Request $request
     * @param Submission $submission
     * @return boolean
     */
    public function updateSubmission($request, $submission)
    {
        DB::beginTransaction();

        try {

            $input = $request->except(['_token', '_method']);

            // check if files were uploaded and process them
            $uploadedFiles = $request->allFiles();
            foreach ($uploadedFiles as $key => $file) {
                // store the file and set it's path to the value of the key holding it
                if ($file->isValid()) {
                    $input[$key] = $file->store('fb_uploads', 'public');
                }
            }

            $submission->loadSubmissionIntoFormJson();

            $files = $submission->form->form_builder_json->where('type', 'file')->pluck('value', 'name');
            // Fill the empty fields with the existing previous data
            foreach ($files as $key => $value) {
                if (!isset($input[$key])) {
                    $input[$key] = $value;
                }
            }

            $submission->update(['content' => $input]);

            DB::commit();

            return true;
        } catch (Throwable $e) {
            info($e);

            DB::rollback();

            return false;
        }
    }
}
