<?php

/**
 * @package CouponRedeem Model
 * @author techvillage <support@techvill.org>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @created 28-11-2021
 */

namespace Modules\Coupon\Http\Models;

use App\Models\Model;
use App\Traits\ModelTrait;
use Cache, Validator;

class CouponRedeem extends Model
{
    use ModelTrait;
    /**
     * timestamps
     * @var boolean
     */
    public $timestamps = false;

    /**
     * Foreign key with User model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    /**
     * Foreign key with Coupon model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function coupon()
    {
        return $this->belongsTo('Modules\Coupon\Http\Models\Coupon', 'coupon_id');
    }

    /**
     * Store Validation
     * @param  array  $data
     * @return mixed
     */
    protected static function storeValidation($data = [])
    {
        $validator = Validator::make($data, [
            'coupon_id' => 'required|numeric',
            'user_id' => 'required|numeric',
            'order_id' => 'required|numeric',
            'discount_amount' => ['required', 'regex:/^[0-9]{1,8}(\.[0-9]{1,8})?$/'],
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
        $validator = Validator::make($data, [
            'coupon_id' => 'required|numeric',
            'user_id' => 'required|numeric',
            'order_id' => 'required|numeric',
            'discount_amount' => ['required', 'regex:/^[0-9]{1,8}(\.[0-9]{1,8})?$/'],
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
        if (parent::insert($data)) {
            self::forgetCache();
            return true;
        }

        return false;
    }

    /**
     * Update
     * @param  array  $request
     * @param  string $id
     * @return array
     */
    public function updateData($request = [], $id = null)
    {
        $data = ['status' => 'fail', 'message' => __('No change found.')];
        $result = parent::where('id', $id);
        if ($result->exists()) {
            $result->update(array_intersect_key($request, array_flip((array) ['coupon_id', 'user_id', 'order_id', 'discount_amount'])));
            self::forgetCache();
            $data = ['status' => 'success', 'message' => __('The :x has been successfully saved.', ['x' => __('Coupon Redeem')])];
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
        $data = ['status' => 'fail', 'message' => __('Coupon Redeem not found.')];
        $record = parent::find($id);
        if (!empty($record)) {
            $record->delete();
            $data = ['status' => 'success', 'message' =>  __('The :x has been successfully deleted.', ['x' => __('Coupon Redeem')])];
        }
        return $data;
    }

}
