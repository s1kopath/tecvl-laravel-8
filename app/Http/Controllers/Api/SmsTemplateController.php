<?php
/**
 * @package SmsTemplateController
 * @author techvillage <support@techvill.org>
 * @contributor Sakawat Hossain Rony <[sakawat.techvill@gmail.com]>
 * @created 16-08-2021
 */
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\{
    SmsTemplateDetailResource,
    SmsTemplateResource
};
use App\Models\{
    SmsTemplate,
};
use Illuminate\Http\Request;

class SmsTemplateController extends Controller
{
    /**
     * SMS Template List
     * @param Request $request
     * @return json $data
     */
    public function index(Request $request)
    {
        $data           = [];
        $configs        = $this->initialize([], $request->all());
        $smsTemInfo           = SmsTemplate::select('sms_templates.*')->whereNull('parent_id');
        $name           = isset($request->name) ? $request->name : null;
        if (!empty($name)) {
            $smsTemInfo->where('name', strtolower($name));
        }
        $status = isset($request->status) ? $request->status : null;
        if (!empty($status)) {
            $smsTemInfo->where('status', strtolower($status));
        }
        $keyword = isset($request->keyword) ? $request->keyword : null;
        if (!empty($keyword)) {
            if (is_int($keyword)) {
                $smsTemInfo->where('id', $keyword);
            } else if (strlen($keyword) >= 2) {
                $smsTemInfo->where(function ($query) use ($keyword) {
                    $query->where('name', 'LIKE', '%' . $keyword . '%')
                        ->orwhere('status', $keyword);
                });
            }
        }
        return $this->response ([
            'data' => SmsTemplateResource::collection($smsTemInfo->paginate($configs['rows_per_page'])),
            'pagination' => $this->toArray($smsTemInfo->paginate($configs['rows_per_page'])->appends($request->all()))
        ]);
    }

    /**
     * Store SMS Template
     * @param Request $request
     * @return json $data
     */
    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            if (isset($request->status) && in_array($request->status, ['Pending', 'Active', 'Inactive'])) {
                $request['status'] = $request->status;
            }
            $request['data'] = json_decode($request->data, true);
            $validator = SmsTemplate::storeValidation($request->all());
            if ($validator->fails()) {
                return $this->unprocessableResponse( $validator->messages());
            }
            $request['language_id'] = 1;
            if ((new SmsTemplate)->store($request->all())) {
                return $this->okResponse([], __('The :x has been successfully saved.', ['x' => __('SMS Template')]));
            }
            return $this->errorResponse();
        }

    }

    /**
     * Detail SMS Template
     * @param Request $request
     * @return json $data
     */
    public function detail($id)
    {
        $response       = $this->checkExistance($id, 'sms_templates');
        $templateData   = SmsTemplate::getAll()->where('id', $id)->whereNull('parent_id')->first();
        if ($response['status'] === true && !empty($templateData)) {
            return $this->response(['data' => new SmsTemplateDetailResource($templateData)]);
        }
        return $this->response([], 204, $response['message']);
    }

    /**
     * Update SMS Template Information
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $response = $this->checkExistance($id, 'sms_templates', ['getData' => true]);
            if ($response['status'] === true) {
                if (isset($request->status) && in_array($request->status, ['Pending', 'Active', 'Inactive'])) {
                    $request['status'] = $request->status;
                }
                $request['data'] = json_decode($request->data, true);
                $validator = SmsTemplate::updateValidation($request->all(), $id);
                if ($validator->fails()) {
                    return $this->unprocessableResponse($validator->messages());
                }
                $templateUpdate = (new SmsTemplate)->updateTemplate($request->all(), $id, $response['data']);
                return $this->okResponse([], $templateUpdate['message']);
            }
            return $this->response([], 204, $response['message']);
        }
    }

    /**
     * Remove the specified Template from db.
     * @param Request $request
     * @return json $data
     */
    public function destroy(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $response = $this->checkExistance($id, 'sms_templates');
            if ($response['status'] === true) {
                $result  = (new SmsTemplate)->remove($id);
                return $this->okResponse([], $result['message']);
            }
            return $this->response([], 204, $response['message']);
        }
    }
}
