<?php
/**
 * @package SmsConfigurationController
 * @author techvillage <support@techvill.org>
 * @contributor Sakawat Hossain Rony <[sakawat.techvill@gmail.com]>
 * @created 28-07-2021
 */
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SmsConfiguration;
use Illuminate\Http\Request;

class SmsConfigurationController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index(Request $request)
    {
        $response = $this->messageArray(__('Invalid Request'), 'fail');
        $data['list_menu'] = 'sms_setup';
        if ($request->isMethod('get')) {
            $data['smsConfig'] = SmsConfiguration::getAll()->first();
            return view('admin.sms_configuration.index', $data);
        } else if ($request->isMethod('post')) {
            $validator =  SmsConfiguration::storeValidation($request->all());
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
            if ((new SmsConfiguration)->store($request->only('type', 'status', 'key', 'secret_key', 'is_default', 'default_number'))) {
                $response = $this->messageArray(__('The :x has been successfully saved.', ['x' => __('SMS Configuration')]), 'success');
            }
            $this->setSessionValue($response);
            return redirect()->route('smsConfiguration.index');
        }
    }
}
