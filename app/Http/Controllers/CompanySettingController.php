<?php

/**
 * @package CompanySettingController
 * @author techvillage <support@techvill.org>
 * @contributor Sakawat Hossain Rony <[sakawat.techvill@gmail.com]>
 * @created 26-05-2021
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\{
    Country,
    Currency,
    Language,
    Preference,
    File
};
use Illuminate\Http\Request;

class CompanySettingController extends Controller
{
    public function index(Request $request)
    {
        $response             = $this->messageArray(__('Invalid Request'), 'fail');
        $data['list_menu']    = 'company_settings';
        $data['currencyData'] = Currency::getAll();
        $data['countryData']  = Country::getAll();
        $data['languageData'] = Language::getAll();
        $pref                 = Preference::getAll()->where('category', 'company')->pluck('value', 'field')->toArray();
        if ($request->isMethod('get')) {
            $data['companyData']["company"] = $pref;
            $data['companyData']['logo']  = Preference::getAll()->where('field', 'company_logo')->first()->fileUrl();
            $data['companyData']['icon']  = Preference::getAll()->where('field', 'company_icon')->first()->fileUrl();
            return view('admin.company_settings.index', $data);
        } else if ($request->isMethod('post')) {

            $validator = Preference::companySettingValidation($request->all());
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
            $post = $request->only('company_name', 'site_short_name', 'company_email', 'company_phone', 'company_street', 'company_city', 'company_state', 'company_zip_code', 'company_country', 'dflt_lang', 'dflt_currency_id');
            $post['company_gstin'] = $request->company_tax_id;
            unset($data);
            $i = 0;
            foreach ($post as $key => $value) {
                $data[$i]['category'] = 'company';
                $data[$i]['field']    = $key;
                $data[$i]['value'] = $value;
                $i++;
            }
            foreach ($data as $key => $value) {
                if ((new Preference)->storeOrUpdate($value)) {
                    $response = $this->messageArray(__('The :x has been successfully saved.', ['x' => __('Company Settings')]), 'success');
                }
            }
            $prefer = Preference::getAll()->pluck('value', 'field')->toArray();
            if (!empty($prefer)) {
                $curr = Currency::getDefault();
            }
            $language     = Language::getAll()->where('is_default', 1)->first();
            $languageData = [];
            if ($request->dflt_lang != $language->short_name) {
                $updatelanguage             = Language::getAll()->where('short_name', $request->dflt_lang)->first();
                $languageData['is_default'] = 1;
                (new Language)->updateLanguage($languageData, $updatelanguage->id);
            }
            $this->setSessionValue($response);
            return redirect()->route('companyDetails.setting');
        }
    }

    /**
     * @param Request $request
     */
    public function deleteImage(Request $request)
    {
        $data = $this->messageArray(__('No record found'), 0);
        $logo = $request->company_logo;
        if (isset($logo)) {
            if ((new Preference)->deleteFile('company_logo', 'company', 'companyPic', $logo)) {
                $data = $this->messageArray(__('The :x has been successfully deleted.', ['x' => __('Logo')]), 1);
            }
        }
        echo json_encode($data);
        exit();
    }


    /**
     * @param Request $request
     */
    public function deleteIcon(Request $request)
    {
        $data = $this->messageArray(__('No record found'), 0);
        $icon = $request->company_icon;
        if (isset($icon)) {
            if ((new Preference)->deleteFile('company_icon', 'company', 'companyIcon', $icon)) {
                $data = $this->messageArray(__('The :x has been successfully deleted.', ['x' => __('Icon')]), 1);
            }
        }
        echo json_encode($data);
        exit();
    }
}
