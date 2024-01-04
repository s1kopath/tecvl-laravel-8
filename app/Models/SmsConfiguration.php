<?php

namespace App\Models;

use App\Models\Model;
use Validator;

class SmsConfiguration extends Model
{
    public $timestamps = false;

    /**
     * Store Validation
     * @param  array  $data
     * @return mixed
     */
    protected static function storeValidation($data = [])
    {
        $validator = Validator::make($data, [
            'is_default' => 'required|in:1,0',
            'status' => 'required|in:Active,Inactive',
            'key' => 'required|max:191',
            'secret_key' => 'required|max:191',
            'type' => 'required',
            'default_number' => 'required|numeric|digits_between:1,50',
        ]);

        return $validator;
    }

    /**
     * Store
     * @param  array  $request
     * @return boolean
     */
    public function store($request = [])
    {
        if (parent::updateOrInsert(['id' => 1], $request)) {
            self::forgetCache();
            return true;
        }

        return false;
    }
}
