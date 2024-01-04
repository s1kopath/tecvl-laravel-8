<?php
/**
 * @package PreferenceController
 * @author techvillage <support@techvill.org>
 * @contributor Sakawat Hossain Rony <[sakawat.techvill@gmail.com]>
 * @created 26-05-2021
 */
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GeneralPreferenceResource;
use App\Models\Preference;
use Illuminate\Http\Request;

class PreferenceController extends Controller
{
    public function index(Request $request)
    {
        $data           = [];
        $preference     = Preference::getAll()->where('category', 'preference')->pluck('value', 'field')->toArray();
        if ($request->isMethod('get')) {
            return $this->response(['data' => $preference]);
        } else if ($request->isMethod('post')) {
            $validator  =  Preference::validation($request->all());
            if ($validator->fails()) {
                return $this->unprocessableResponse($validator->messages());
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

            $i              = 0;
            $preferenceData = [];
            foreach ($request->all() as $key => $value) {
                $preferenceData[$i]['category'] = "preference";
                $preferenceData[$i]['field']    = $key;
                $preferenceData[$i++]['value']  = $value;
            }

            foreach ($preferenceData as $key => $value) {
                if ((new Preference)->storeOrUpdate($value)) {
                    $data = $this->okResponse([], __('The :x has been successfully saved.', ['x' => __('Preference')]));
                }
            }
            return $data;
        }
    }
}
