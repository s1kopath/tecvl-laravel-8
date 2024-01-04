<?php
/**
 * @package SmsTemplateController
 * @author techvillage <support@techvill.org>
 * @contributor Sakawat Hossain Rony <[sakawat.techvill@gmail.com]>
 * @created 17-07-2021
 */
namespace App\Http\Controllers;

use App\DataTables\SmsTemplateListDataTable;
use App\Http\Controllers\Controller;
use App\Models\{
    SmsTemplate
};
use Illuminate\Http\Request;

class SmsTemplateController extends Controller
{
    /**
     * Index
     * @param SmsTemplateListDataTable $dataTable
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index(SmsTemplateListDataTable $dataTable)
    {
        return $dataTable->render('admin.sms_templates.index');
    }

    /**
     * Create
     * @return Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.sms_templates.create');
    }

    /**
     * Store
     * @param Request $request
     * @return \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $response = $this->messageArray(__('Invalid Request'), 'fail');
        if ($request->isMethod('post')) {
            if (isset($request->status) && in_array($request->status, ['Pending', 'Active', 'Inactive'])) {
                $request['status'] = $request->status;
            }

            $validator = SmsTemplate::storeValidation($request->all());
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            $request['language_id'] = 1;
            try {
                if ((new SmsTemplate)->store($request->all())) {
                    $response = $this->messageArray(__('The :x has been successfully saved.', ['x' => __('SMS Template')]), 'success');
                }
            } catch (Exception $e) {
                $response['message'] = $e->getMessage();
            }
        }
        $this->setSessionValue($response);
        return redirect()->route('smsTemplates.index');
    }

    /**
     * Edit
     * @param string $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id = null)
    {
        $template = SmsTemplate::getAll()->where('id', $id)->whereNull('parent_id')->first();
        if (empty($template)) {
            $response = $this->messageArray(__(':x does not exist.', ['x' => __('Template')]), 'fail');
            $this->setSessionValue($response);
            return redirect()->route('smsTemplates.index');
        }

        $childTemplates     = SmsTemplate::getAll()->where('parent_id', $id);
        $childs             = [];
        foreach ($childTemplates as $key => $value) {
            $childs[$value->language_id] = ['subject' => $value->subject, 'body' => $value->body];
        }

        $data['template'] = $template;
        $data['childs']   = $childs;

        return view('admin.sms_templates.edit', $data);
    }

    /**
     * Delete
     * @param Request $request
     * @param string $id
     * @return \Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, $id = null)
    {
        $response = $this->messageArray(__('Invalid Request'), 'fail');
        if ($request->isMethod('post')) {
            $result = $this->checkExistance($id, 'sms_templates');
            if ($result['status'] === true) {
                $response = (new SmsTemplate)->remove($id);
            } else {
                $response['message'] = $result['message'];
            }
        }

        $this->setSessionValue($response);
        return redirect()->route('smsTemplates.index');
    }

    /**
     * Update
     * @param Request $request
     * @param string $id
     * @return \Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id = null)
    {
        $response = $this->messageArray(__('Invalid Request'), 'fail');
        if ($request->isMethod('post')) {
            if (isset($request->status) && in_array($request->status, ['Pending', 'Active', 'Inactive'])) {
                $request['status'] = $request->status;
            }

            $result = $this->checkExistance($id, 'sms_templates', ['getData' => true]);
            if ($result['status'] === true) {
                $validator = SmsTemplate::updateValidation($request->all(), $id, $result['data']);
                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput();
                }

                $request['language_id'] = 1;
                $response               = (new SmsTemplate)->updateTemplate($request->all(), $id, $result['data']);
            } else {
                $response['message'] = $result['message'];
            }
        }

        $this->setSessionValue($response);
        return redirect()->route('smsTemplates.index');
    }
}
