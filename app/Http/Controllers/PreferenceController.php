<?php
/**
 * @package PreferenceController
 * @author techvillage <support@techvill.org>
 * @contributor Sabbir Al-Razi <[sabbir.techvill@gmail.com]>
 * @contributor Md. Al Mamun Sarkar <[almamun.techvill@gmail.com]>
 * @created 20-05-2021
 * @modified 23-03-2022
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Preference,
    Currency
};
use Session;
use App\Lib\Env;

class PreferenceController extends Controller
{
	/**
	 * Store or update general preference
	 * @param  Request $request
	 * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Routing\Redirector
	 */
    public function index(Request $request)
    {
        $response = ['status' => 'fail', 'message' => __('Invalid Request')];
        $data['list_menu'] = 'general_preference';

        $data['currencyData'] = Currency::getAll();
        $pref = Preference::getAll()->where('category', 'preference')->pluck('value', 'field')->toArray();
        $data['prefData']['preference'] = $pref;

        if ($request->isMethod('get')) {
        	return view('admin.preference.index', $data);
        } else if ($request->isMethod('post')) {
            $request['date_format'] = getDateformatId($request->date_format);
        	$validator =  Preference::validation($request->all());
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
            $request['date_format'] = getDateformatId($request->date_format, 'value', 'key');
	        unset($request['_token']);
            switch ($request['date_format']) {
                case 0:
                    $request['date_format_type'] = 'yyyy' . $request['date_sepa'] . 'mm' . $request['date_sepa'] . 'dd';
                    break;
                case 1:
                    $request['date_format_type'] = 'dd' . $request['date_sepa'] . 'mm' . $request['date_sepa'] . 'yyyy';
                    break;
                case 2:
                    $request['date_format_type'] = 'mm' . $request['date_sepa'] . 'dd' . $request['date_sepa'] . 'yyyy';
                    break;
                case 3:
                    $request['date_format_type'] = 'dd' . $request['date_sepa'] . 'M' . $request['date_sepa'] . 'yyyy';
                    break;
                case 4:
                    $request['date_format_type'] = 'yyyy' . $request['date_sepa'] . 'M' . $request['date_sepa'] . 'dd';
                    break;
            }

	        $i = 0;
	        $preferenceData = [];
	        foreach ($request->all() as $key => $value) {
	            $preferenceData[$i]['category'] = "preference";
	            $preferenceData[$i]['field'] = $key;
                $key == 'sso_service' ? $preferenceData[$i++]['value'] = json_encode($value) : $preferenceData[$i++]['value'] = $value;
	        }
            if (!in_array("sso_service", array_keys($request->all()))) {
                $preferenceData[$i]['category'] = "preference";
                $preferenceData[$i]['field'] = "sso_service";
                $preferenceData[$i++]['value'] = '';
            }
	        foreach ($preferenceData as $key => $value) {
	            if ((new Preference)->storeOrUpdate($value)) {
	            	$response['status'] = 'success';
                	$response['message'] = __('The :x has been successfully saved.', ['x' => __('Preference')]);
	            }
	        }
	        $prefer = Preference::getAll()->pluck('value', 'field')->toArray();
	        if (!empty($prefer)) {
	            Session::put($prefer);
	        }
        }
        Session::flash($response['status'], $response['message']);
    	return redirect()->route('preferences.index');
    }

    
    /**
	 * Store or update password preference in env file
	 * @param  Request $request
	 * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Routing\Redirector
	 */
    public function password(Request $request)
    {
        $data['list_menu'] = 'password_preference';

        if ($request->isMethod('get')) {
        	return view('admin.preference.password', $data);
        }

        $inpArr = ['uppercase' => 'UPPERCASE', 'lowercase' => 'LOWERCASE', 'number' => 'NUMBERS', 'symbol' => 'SYMBOLS'];
        $array = [];
        foreach ($request->input() as $key => $condition) {
            if (array_key_exists($key, $inpArr)) {
                $array[] = $inpArr[$key];
            }
        }

        $array[] = "LENGTH:" . $request->filled('length') ? $request->length : '4';

        Env::set('PASSWORD_STRENGTH', !empty($array) ? implode('|', $array) : '');

    	return redirect()->route('preferences.password')->with('success',  __('Password preference updated successfully'));
    }
}
