<?php
/**
 * @package Shop Model
 * @author techvillage <support@techvill.org>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @created 28-09-2021
 */

namespace Modules\Shop\Http\Models;

use App\Rules\CheckValidEmail;
use App\Models\Model;
use App\Rules\CheckValidPhone;
use Cache;
use Validator;

class Shop extends Model
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
     * Relation with coupon model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function coupons()
    {
        return $this->hasMany('Modules\Coupon\Http\Models\Coupon', 'shop_id', 'id');
    }

    /**
     * Foreign key with Item model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function items()
    {
        return $this->hasMany('App\Models\Item', 'shop_id');
    }

    /**
     * Relation with Transaction model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Store Validation
     * @param  array  $data
     * @return mixed
     */
    protected static function storeValidation($data = [])
    {
        $validator = Validator::make($data, [
            'name' => 'required|min:3|max:99|unique:shops,name',
            'vendor_id' => 'required|numeric',
            'email' => ['required', 'max:99', 'unique:shops,email', new CheckValidEmail],
            'website' => ['nullable', 'max:255', 'regex:/^(http[s]?:\/\/)?(www\.)?([\.]?[a-z]+[a-zA-Z0-9\-]{1,})?[\.]?[a-z]+[a-zA-Z0-9\-]+\.[a-zA-Z]{2,5}([\.]?[a-zA-Z]{2,5})?/i'],
            'alias' => 'required|min:2|max:40|unique:shops,alias',
            'address' => 'nullable|max:255',
            'phone' => ['required', 'min:10', 'max:45', new CheckValidPhone],
            'fax' => 'nullable|max:45',
            'description' => 'nullable|max:5000',
            'status' => 'in:Active,Inactive',
        ]);
        return $validator;
    }

    /**
     * Update validation
     * @param  array  $data
     * @param  string $id
     * @return mixed
     */
    protected static function updateValidation($data = [], $id = null)
    {
        $validator = Validator::make($data, [
            'name' => ['required', 'min:3', 'max:99', 'unique:shops,name,' . $id],
            'vendor_id' => 'required|numeric',
            'email' => ['required', 'max:99', 'unique:shops,email,' . $id, new CheckValidEmail],
            'website' => ['nullable', 'max:255', 'regex:/^(http[s]?:\/\/)?(www\.)?([\.]?[a-z]+[a-zA-Z0-9\-]{1,})?[\.]?[a-z]+[a-zA-Z0-9\-]+\.[a-zA-Z]{2,5}([\.]?[a-zA-Z]{2,5})?/i'],
            'alias' => 'required|min:2|max:40|unique:shops,alias,' . $id,
            'address' => 'nullable|max:255',
            'phone' => ['required', 'min:10', 'max:45', new CheckValidPhone],
            'fax' => 'nullable|max:45',
            'description' => 'nullable|max:5000',
            'status' => 'in:Active,Inactive',
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
    public function updateShop($request = [], $id = null)
    {
        $data = ['status' => 'fail', 'message' => __('Something went wrong, please try again.')];
        $result = parent::where('id', $id);
        if ($result->exists()) {
            $result->update(array_intersect_key($request, array_flip((array) ['vendor_id', 'name', 'email', 'website', 'alias', 'address', 'phone', 'fax', 'description', 'status'])));
            self::forgetCache();

            $data['status'] = 'success';
            $data['message'] = __('The :x has been successfully saved.', ['x' => __('Shop')]);
        }
        return $data;
    }

    /**
     * delete
     * @param  string $id
     * @return object
     */
    public function remove($id = null)
    {
        $data = ['status' => 'fail', 'message' => __('Something went wrong, please try again.')];
        $record = parent::find($id);
        if (!empty($record)) {
            $record->delete();
            $data['status'] = 'success';
            $data['message'] = __('The :x has been successfully deleted.', ['x' => __('Shop')]);
        }
        return $data;
    }

    /**
     * Shop count
     * @param  string $id
     * @return object
     */
    public function shopCount($id = null) {
        $vendorId = parent::find($id)->vendor_id;
        if (isset($vendorId)) {
            return parent::where('vendor_id', $vendorId)->count();
        }
        return null;
    }
}
