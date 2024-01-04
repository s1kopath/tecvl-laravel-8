<?php
/**
 * @package CurrencyController
 * @author techvillage <support@techvill.org>
 * @contributor Sakawat Hossain Rony <[sakawat.techvill@gmail.com]>
 * @created 08-08-2021
 */
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\CurrencyConverterConfiguration;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    /**
     * Currency List
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $data['list_menu']         = 'currency';
        $data['currencyData']      = Currency::getAll();
        $data['currencyConverter'] = CurrencyConverterConfiguration::getAll()->where('status', 'Active')->count();

        return view('admin.currency.index', $data);
    }

    /**
     * Currency Store
     * @param Request $request
     */
    public function store(Request $request)
    {
        $response             = [];
        $response = $this->messageArray(__('Something went wrong, please try again.'),'fail');
        $validator = Currency::storeValidation($request->all());
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        if ((new Currency)->store($request->only('name','symbol','exchange_rate','exchange_from'))) {
            $response = $this->messageArray(__('The :x has been successfully saved.', ['x' => __('Currency')]),'success');
        }
        $this->setSessionValue($response);
        return redirect()->back();
    }

    /**
     * Currency edit
     * @param Request $request
     */
    public function edit(Request $request)
    {
        $result = [];
        if (isset($request->id) && !empty($request->id)) {
            $currData = Currency::getAll()->where('id', $request->id)->first();
            $result['name']          = $currData->name;
            $result['symbol']        = $currData->symbol;
            $result['exchange_rate'] = $currData->exchange_rate;
            $result['id']            = $currData->id;
            $result['exchange_from'] = $currData->exchange_from;
        }
        echo json_encode($result);
    }

    /**
     * Currency Update
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $response             = [];
        $response = $this->messageArray(__('Something went wrong, please try again.'),'fail');
        $validator = Currency::updateValidation($request->all(), $request->curr_id);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        if ((new Currency)->currencyUpdate($request->only('name','symbol','exchange_rate','exchange_from'), $request->curr_id)) {
            $response = $this->messageArray(__('The :x has been successfully saved.', ['x' => __('Currency')]),'success');
        }
        $this->setSessionValue($response);
        return redirect()->back();
    }

    /**
     * Currency destroy
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $requsest)
    {
        $id = $requsest->id;
        $language = (new Currency())->remove($id);
        $response = $this->messageArray($language['message'], $language['type']);
        $this->setSessionValue($response);
        return redirect()->back();
    }

    /**
     * Currency Validate
     * @param Request $request
     */
    public function validCurrencyName(Request $request)
    {
        $query = Currency::where('name', $request->name);
        if (isset($request->currency_id) && !empty($request->currency_id)) {
            $query->where('id', "!=", $request->currency_id);
        }
        $result = $query->first();

        if (!empty($result)) {
            echo json_encode(__('Currency name is already taken.'));
        } else {
            echo "true";
        }
    }

    /**
     * Currency Converter
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function currencyConverterSetup(Request $request)
    {
        $response           = $this->messageArray(__('Invalid Request'), 'fail');
        $data['list_menu']  = 'currency_converter';
        if ($request->isMethod('get')) {
            $config                         = CurrencyConverterConfiguration::getAll();
            $data['currency_converter_api'] = $config->where('slug', 'currency_converter_api')->first();
            $data['exchange_rate_api']      = $config->where('slug', 'exchange_rate_api')->first();
            return view('admin.currency.currency_converter', $data);
        } else if ($request->isMethod('post')) {
            if (isset($request->customRadio) && $request->customRadio == "on") {
                $validator = CurrencyConverterConfiguration::storeValidation($request->all());
                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput();
                }
            } else {
                $response = $this->messageArray(__('Please setup currency converter API settings first.'), 'fail');
                $this->setSessionValue($response);
                return redirect()->route('currency.convert');
            }
            try {
                $currency_converter_api = $exchange_rate_api = false;
                if (isset($request->currency_converter_api_api_key)) {
                    $value['slug']          = "currency_converter_api";
                    $value['api_key']       = $request->currency_converter_api_api_key;
                    $value['status']        = $request->currency_converter_api_status;
                    $currency_converter_api = (new CurrencyConverterConfiguration)->store($value);
                }
                if (isset($request->exchange_rate_api_api_key)) {
                    $value['slug']     = "exchange_rate_api";
                    $value['status']   = $request->exchange_rate_api_status;
                    $value['api_key']  = $request->exchange_rate_api_api_key;
                    $exchange_rate_api = (new CurrencyConverterConfiguration)->store($value);
                }

                if ($currency_converter_api === true || $exchange_rate_api === true) {
                    $response = $this->messageArray(__('The :x has been successfully saved.', ['x' => __('Currency Converter Configuration')]), 'success');
                }
            } catch (\Exception $e) {
                $response['message'] = $e->getMessage();
            }
            $this->setSessionValue($response);
            return redirect()->route('currency.convert');
        }
    }

}
