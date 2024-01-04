<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Model;
use Validator;
use Illuminate\Validation\Rule;

class CurrencyConverterConfiguration extends Model
{
    public $timestamps = false;

    /**
     * Store Validation
     * @param  array  $data
     * @return mixed
     */
    protected static function storeValidation($data = [])
    {
        $rules['currency_converter_api_status'] = 'required|in:Active,Inactive';
        $rules['exchange_rate_api_status'] = 'required|in:Active,Inactive';
        if (isset($data['currency_converter_api_status']) && $data['currency_converter_api_status'] == 'Active') {
            $rules['currency_converter_api_api_key'] = 'required|max:191';
        } else {
            $rules['currency_converter_api_api_key'] = 'nullable|max:191';
        }

        if (isset($data['exchange_rate_api_status']) && $data['exchange_rate_api_status'] == 'Active') {
            $rules['exchange_rate_api_api_key'] = 'required|max:191';
        } else {
            $rules['exchange_rate_api_api_key'] = 'nullable|max:191';
        }
        return Validator::make($data, $rules);
    }

    /**
     * Store
     * @param  array  $request
     * @return boolean
     */
    public function store($request = [])
    {
        if (parent::updateOrInsert(["slug" => $request['slug']], $request)) {
            self::forgetCache();
            return true;
        }

        return false;
    }
}
