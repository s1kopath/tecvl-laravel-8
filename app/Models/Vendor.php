<?php
/**
 * @package Vendor Model
 * @author techvillage <support@techvill.org>
 * @contributor Sakawat Hossain Rony <[sakawat.techvill@gmail.com]>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @created 17-08-2021
 * @modified 29-09-2021
 */

namespace App\Models;

use App\Models\Model;
use App\Traits\ModelTrait;
use App\Traits\ModelTraits\hasFiles;
use Modules\Shop\Http\Models\Shop;
use Modules\MediaManager\Http\Models\ObjectFile;

class Vendor extends Model
{
    use ModelTrait, hasFiles;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'vendors';

    /**
     * Relation with AttributeGroup model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attributeGroups()
    {
        return $this->hasMany('App\Models\AttributeGroup', 'vendor_id', 'id');
    }

    /**
     * Relation with Brand model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function brands()
    {
        return $this->hasMany('App\Models\Brand', 'vendor_id', 'id');
    }

    /**
     * Relation with FlashSale model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function flashSales()
    {
        return $this->hasMany('App\Models\FlashSale', 'vendor_id', 'id');
    }

    /**
     * Relation with Item model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany('App\Models\Item', 'vendor_id', 'id');
    }

    /**
     * Relation with OptionGroup model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function optionGroups()
    {
        return $this->hasMany('App\Models\OptionGroup', 'vendor_id', 'id');
    }

    /**
     * Relation with StockManagement model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stockManagements()
    {
        return $this->hasMany('App\Models\StockManagement', 'vendor_id', 'id');
    }

    /**
     * Relation with VendorUser model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany('App\Models\VendorUser', 'vendor_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function avatarFile()
    {
        return $this->hasOne('App\Models\File', 'object_id')->where('object_type', 'VENDOR');
    }

    /**
     * Relation with coupon model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function coupons()
    {
        return $this->hasMany('Modules\Coupon\Http\Models\Coupon', 'vendor_id', 'id');
    }

    /**
     * Relation with shop model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shops()
    {
        return $this->hasMany('Modules\Shop\Http\Models\Shop', 'vendor_id', 'id');
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
     * Store
     * @param  array  $data
     * @return int|null
     */
    public function store($data = [])
    {
        $id = parent::insertGetId($data);
        if (!empty($id)) {
            $fileIds = [];
            if(request()->has('file_id')) {
                foreach(request()->file_id as $data) {
                    $fileIds[] = $data;
                }
            }
            ObjectFile::storeInObjectFiles($this->objectType(), $this->objectId(), $fileIds);
            self::forgetCache();
            return $id;
        }
        return false;
    }

    /**
     * Update Vendor
     * @param array $data
     * @param null $id
     * @return bool
     */
    public function updateVendor($data = [], $id = null)
    {
        $result = parent::where('id', $id);
        if ($result->exists()) {
            $result->first()->updateFiles(['isUploaded' => false, 'isOriginalNameRequired' => true, 'thumbnail' => true]);
            $result->update($data);
            self::forgetCache(['vendors', 'categories', 'brands']);
            return true;
        }

        return false;
    }

    /**
     * Delete
     * @param string $id
     * @return array
     */
    public function remove($id = null)
    {
        $data   = ['status' => 'fail', 'message' => __('Something went wrong, please try again.')];
        $record = parent::find($id);
        if (!empty($record)) {
            $record->deleteFiles(['thumbnail' => true]);
            $record->delete();
            self::forgetCache(['vendors', 'brands', 'attribute_groups', 'attributes', 'attribute_values']);
            $data['status']  = 'success';
            $data['message'] = __('The :x has been successfully deleted.', ['x' => __('Vendor')]);
        }
        return $data;
    }

    /**
     * shop id to vendor id
     * @return int $id
     */
    public static function shopToVendor($id)
    {
        return Shop::where('id', $id)->first()->vendor_id ?? null;
    }

    /**
     * find shop rating and review count
     * @return object
     */
    public function shopReview() {
        $itemReview = $this->hasManyThrough(Review::class, Item::class);
        return (object) ['count' => $itemReview->count(), 'rating' => $itemReview->avg('rating')];
    }
}
