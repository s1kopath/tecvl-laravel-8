<?php

/**
 * @package Shipping model
 * @author techvillage <support@techvill.org>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @created 15-12-2021
 */

namespace Modules\Shipping\Entities;

use App\Models\Model;
use Cache, Validator;

class Shipping extends Model
{
    /**
     * timestamps
     * @var boolean
     */
    public $timestamps = false;
    public function orderDetails()
    {
        return $this->hasMany('App\Models\OrderDetail', 'shipping_id');
    }
    /**
     * Store Validation
     * @param  array  $data
     * @return mixed
     */
    protected static function storeValidation($data = [])
    {
        $validator = Validator::make($data, [
            'name' => 'required|min:3|max:120|unique:shippings,name',
            'cost' => ['required', 'regex:/^[0-9]{1,8}(\.[0-9]{1,8})?$/'],
            'minimum_amount' => ['nullable', 'regex:/^[0-9]{1,8}(\.[0-9]{1,8})?$/'],
            'status' => 'required|in:Active,Inactive',
        ]);
        return $validator;
    }

    /**
     * Update Validation
     * @param  array  $data
     * @return mixed
     */
    protected static function updateValidation($data = [], $id)
    {
        $data['start_date'] = isset($data['start_date']) ? $data['start_date'] : null;
        $validator = Validator::make($data, [
            'name' => 'required|min:3|max:120|unique:shippings,name,' . $id,
            'cost' => ['required', 'regex:/^[0-9]{1,8}(\.[0-9]{1,8})?$/'],
            'minimum_amount' => ['nullable', 'regex:/^[0-9]{1,8}(\.[0-9]{1,8})?$/'],
            'status' => 'required|in:Active,Inactive',
        ]);
        return $validator;
    }

    /**
     * store
     * @param array $data
     * @return boolean
     */
    public function store($data = [])
    {
        $response = ['status' => 'fail', 'message' => __('Something went wrong, please try again.')];
        if (parent::insert(array_intersect_key($data, array_flip((array) ['name', 'cost', 'minimum_amount', 'status'])))) {
            self::forgetCache();
            $response = ['status' => 'success', 'message' => __('The :x has been successfully saved.', ['x' => __('Shipping')])];
        }

        return $response;
    }

    /**
     * Update
     * @param  array  $request
     * @param  string $id
     * @return array
     */
    public function updateData($request = [], $id = null)
    {
        $data = ['status' => 'fail', 'message' => __('Shipping does not found.')];
        $result = parent::where('id', $id);
        if ($result->exists()) {
            $result->update(array_intersect_key($request, array_flip((array) ['name', 'cost', 'minimum_amount', 'status'])));
            self::forgetCache();
            $data = ['status' => 'success', 'message' => __('The :x has been successfully saved.', ['x' => __('Shipping')])];
        }
        return $data;
    }

    /**
     * delete
     * @param  string $id
     * @return array
     */
    public function remove($id = null)
    {
        if (Shipping::getAll()->where('id', $id)->count() == 0) {
            return ['status' => 'fail', 'message' => __('Shipping does not found.')];
        }
        if (Shipping::where('id', $id)->delete()) {
            self::forgetCache();
            return ['status' => 'success', 'message' => __('The :x has been successfully deleted.', ['x' => __('Shipping')])];
        }

        return ['status' => 'fail', 'message' => __('Something went wrong, please try again.')];
    }
}
