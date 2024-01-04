<?php
/**
 * @package SmsConfigurationController
 * @author techvillage <support@techvill.org>
 * @contributor Sakawat Hossain Rony <[sakawat.techvill@gmail.com]>
 * @created 31-07-2021
 */
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SmsConfiguration;
use Illuminate\Http\Request;

class SmsConfigurationController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod('get')) {
            $smsConfig       = SmsConfiguration::getAll()->first();
            return $this->response(['data' => $smsConfig]);
        } else if ($request->isMethod('post')) {
            if (isset($request->status) && array_key_exists($request->status, ['Active', 'Inactive'])) {
                $request['status'] = $request->status;
            }
            $validator = SmsConfiguration::storeValidation($request->all());
            if ($validator->fails()) {
                return $this->unprocessableResponse($validator->messages());
            }
            if ((new SmsConfiguration)->store($request->only('type', 'status', 'key', 'secret_key', 'is_default', 'default_number'))) {
                return $this->okResponse([], __('The :x has been successfully saved.', ['x' => __('SMS Configuration')]));
            } else {
                return $this->okResponse([], __('No changes found.'));
            }
        }
    }
}
