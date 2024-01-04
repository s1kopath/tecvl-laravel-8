<?php

/**
 * @package ItemCoupon Model
 * @author techvillage <support@techvill.org>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @created 29-11-2021
 */

namespace Modules\Coupon\Http\Models;

use App\Models\Model;
use Validator;

class ItemCoupon extends Model
{
    /**
     * timestamps
     * @var boolean
     */
    public $timestamps = false;

    /**
     * Foreign key with Coupon model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function coupon()
    {
        return $this->belongsTo('Modules\Coupon\Http\Models\Coupon', 'coupon_id');
    }

    /**
     * Foreign key with Item model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function item()
    {
        return $this->belongsTo('App\Models\Item', 'item_id');
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
            'item_id' => 'required|numeric',
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
            return true;
        }

        return false;
    }
    /**
     * update
     * @param array $data
     * @return boolean
     */
    public function updateData($data = [], $id = null)
    {
        $result = parent::where('coupon_id', $id);
        if ($result->exists()) {
            $result->delete();
        }
        if (!empty($data)) {
            parent::insert($data);
            return true;
        }

        return false;
    }

}
