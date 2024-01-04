<?php

/**
 * @package Coupon Model
 * @author techvillage <support@techvill.org>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @created 18-11-2021
 */

namespace Modules\Coupon\Http\Models;

use App\Models\Model;
use App\Models\Item;
use App\Rules\{
    CheckValidDate,
    DateCompare
};
use Cache, Validator;

class Coupon extends Model
{
    /**
     * timestamps
     * @var boolean
     */
    public $timestamps = false;

    /**
     * Foreign key with Vendor model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vendor()
    {
        return $this->belongsTo('App\Models\Vendor', 'vendor_id');
    }

    /**
     * Foreign key with Shop model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shop()
    {
        return $this->belongsTo('Modules\Shop\Http\Models\Shop', 'shop_id');
    }

    /**
     * Relation with CouponRedeem model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function couponRedeems()
    {
        return $this->hasMany('Modules\Coupon\Http\Models\CouponRedeem', 'coupon_id');
    }

    /**
     * Foreign key with item model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function items()
    {
        return $this->belongsToMany(Item::class, 'item_coupons');
    }

    /**
     * Store Validation
     * @param  array  $data
     * @return mixed
     */
    protected static function storeValidation($data = [])
    {
        $data['start_date'] = isset($data['start_date']) ? $data['start_date'] : null;
        $data['condition'] = empty($data['minimum_spend']) ? '' : 'lt:minimum_spend';
        $validator = Validator::make($data, [
            'name' => 'required|min:3|max:30|unique:coupons,name',
            'vendor_id' => 'nullable',
            'shop_id' => 'nullable',
            'usage_limit' => 'nullable|max:11',
            'minimum_spend' => ['nullable', 'regex:/^[0-9]{1,8}(\.[0-9]{1,8})?$/'],
            'code' => 'required|min:3|max:30|unique:coupons,code',
            'discount_type' => 'required|in:Flat,Percentage',
            'discount_amount' => ['required', 'regex:/^[0-9]{1,8}(\.[0-9]{1,8})?$/', $data['condition']],
            'maximum_discount_amount' => ['nullable', 'regex:/^[0-9]{1,8}(\.[0-9]{1,8})?$/', 'gt:discount_amount'],
            'start_date' => ['required', new CheckValidDate()],
            'end_date' => ['required', new CheckValidDate(), new DateCompare($data['start_date'])],
            'status' => 'required|in:Active,Inactive',
        ], [
            'discount_amount.lt' => __('Minimum spend must be greater than Discount amount.'),
            'maximum_discount_amount.gt' => __('Maximum discount amount must be greater than discount amount.')
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
        $data['condition'] = empty($data['minimum_spend']) ? '' : 'lt:minimum_spend';
        $validator = Validator::make($data, [
            'name' => 'required|min:3|max:30|unique:coupons,name,' . $id,
            'vendor_id' => 'nullable',
            'shop_id' => 'nullable',
            'usage_limit' => 'nullable|max:11',
            'code' => 'required|min:3|max:30|unique:coupons,code,' . $id,
            'discount_type' => 'required|in:Flat,Percentage',
            'discount_amount' => ['required', 'regex:/^[0-9]{1,8}(\.[0-9]{1,8})?$/', $data['condition']],
            'maximum_discount_amount' => ['nullable', 'regex:/^[0-9]{1,8}(\.[0-9]{1,8})?$/', 'gt:discount_amount'],
            'start_date' => ['required', new CheckValidDate()],
            'end_date' => ['required', new CheckValidDate(), new DateCompare($data['start_date'])],
            'status' => 'required|in:Active,Inactive',
        ], [
            'discount_amount.lt' => __('Minimum spend must be greater than Discount amount.'),
            'maximum_discount_amount.gt' => __('Maximum discount amount must be greater than discount amount.')
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
        $id = parent::insertGetId($data);
        if ($id) {
            self::forgetCache();
            return $id;
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
        $data = ['status' => 'fail', 'message' => __('Coupon not found.')];
        $result = parent::where('id', $id);
        if ($result->exists()) {
            $result->update(array_intersect_key($request, array_flip((array) ['name', 'vendor_id', 'shop_id', 'usage_limit', 'minimum_spend', 'code', 'discount_type', 'discount_amount', 'maximum_discount_amount', 'start_date', 'end_date', 'status'])));
            self::forgetCache();
            $data = ['status' => 'success', 'message' => __('The :x has been successfully saved.', ['x' => __('Coupon')])];
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
        $data = ['status' => 'fail', 'message' => __('Coupon not found.')];
        $record = parent::find($id);
        if (!empty($record)) {
            $record->delete();
            $data = ['status' => 'success', 'message' =>  __('The :x has been successfully deleted.', ['x' => __('Coupon')])];
        }
        return $data;
    }

    /**
     * return coupon_id, discount_type, discount_amount(will be calculated depend on itemIds or $vendorIds or $shopIds)
     *
     * Check Validity
     * @param  string $code
     * @return boolean
     */
    public static function isValid($code = null, $itemIds = [], $vendorIds = [], $shopIds = [])
    {
        $data = ['status' => false, 'message' => __('Coupon not found.'), 'data' => []];

        $coupon = Coupon::where('code', $code)->first();
        if (empty($code) || empty($coupon)) {
            return $data;
        }
        if ($coupon->status <> 'Active') {
            $data['message'] = __('This coupon is not valid.');
        } else if (parent::isExpired($code)) {
            $data['message'] = __('This coupon has been expired.');
        } else if (now() < $coupon['start_date']) {
            $data['message'] = __('This coupon is not activated yet.');
        } else {
            $data = ['status' => true, 'message' => '', 'data' => $coupon];
        }

        return $data;
    }

    /**
     * Check Expire
     * @param  string $code
     * @return boolean
     */
    public function isExpired($code = null) {
        $coupon = Coupon::getAll()->where('code', $code)->first();
        if ($coupon && now() > $coupon['end_date']) {
            if ($coupon['status'] == 'Active') {
                parent::where('code', $code)->update(['status' => 'Inactive']);
                self::forgetCache();
            }
            return 1;
        }
        return 0;
    }

    /**
     * Check Started
     * @param  string $code
     * @return boolean
     */
    public function isStarted($code = null) {
        $coupon = Coupon::getAll()->where('code', $code)->first();
        if ($coupon && now() < $coupon['start_date']) {
            return 0;
        }
        return 1;
    }

    /**
     * Check Discount
     * @param  string $code
     * @return array
     */
    public function checkDiscount($code = null) {
        $response = $this->isValid($code);
        if (empty($response['status'])) {
            return ['status' => 'fail', 'message' => $response['message']];
        }
        $coupon = $response['data'];
        if ($coupon['discount_type'] == 'Percentage') {
            if ($coupon['maximum_discount_amount'] <= 0) {
                return ['status' => 'success', 'message' =>  __('You will get :x discount to use the coupon.', ['x' => formatNumber($coupon->discount_amount) . '%'])];
            }
            return ['status' => 'success', 'message' =>  __('You will get :x discount to use the coupon. Up to :y.', ['x' => formatCurrencyAmount($coupon->discount_amount) . '%', 'y' => formatNumber($coupon->maximum_discount_amount)])];
        } else {
            return ['status' => 'success', 'message' =>  __('You will get :x discount.', ['x' => formatNumber($coupon->discount_amount)])];
        }
    }

    /**
     * Check Expired
     * @param  string $code
     * @return array
     */
    public function checkExpired($code = null) {
        $data = ['status' => 'fail', 'message' => ''];

        $coupon = Coupon::getAll()->where('code', $code)->first();
        if (empty($code) || empty($coupon)) {
            $data['message'] =  __('Coupon not found');
        } elseif ($coupon->status == 'Inactive') {
            $data['message'] = __('This coupon is not valid.');
        } elseif ($this->isExpired($code)) {
            $data['message'] = __('This coupon has been expired.');
        } else {
            $data = ['status' => 'success', 'message' => timeToGo($coupon->end_date, true)];
        }
        return $data;
    }

    /**
     * Check Started
     * @param  string $code
     * @return array
     */
    public function checkStarted($code = null) {
        $data = ['status' => 'fail', 'message' => ''];

        $coupon = Coupon::getAll()->where('code', $code)->first();
        if (empty($code) || empty($coupon)) {
            $data['message'] =  __('Coupon not found');
        } elseif ($coupon->status == 'Inactive') {
            $data['message'] = __('This coupon is not valid.');
        } else if (now() >= $coupon['start_date']) {
            $data['message'] = __('This coupon is already started.');
        } else {
            $data = ['status' => 'success', 'message' => timeToGo($coupon->start_date, true)];
        }
        return $data;
    }

}
