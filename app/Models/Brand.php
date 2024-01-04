<?php

/**
 * @package Brand
 * @author techvillage <support@techvill.org>
 * @contributor Sakawat Hossain Rony <[sakawat.techvill@gmail.com]>
 * @created 25-07-2021
 */

namespace App\Models;

use App\Rules\CheckValidFile;
use App\Models\Model;
use Validator;
use App\Traits\ModelTrait;
use App\Traits\ModelTraits\hasFiles;

class Brand extends Model
{
    use ModelTrait, hasFiles;
    /**
     * Foreign key with Vendor model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vendor()
    {
        return $this->belongsTo('App\Models\Vendor', 'vendor_id');
    }

    /**
     * Relation with Item model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function item()
    {
        return $this->hasMany('App\Models\Item', 'brand_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function image()
    {
        return $this->hasOne('App\Models\File', 'object_id')->where('object_type', 'BRAND');
    }

    /**
     * Store Validation
     * @param array $data
     * @return mixed
     */
    protected static function storeValidation($data = [])
    {
        $validator = Validator::make($data, [
            'name' => 'required|min:3|max:50|unique:brands,name',
            'vendor' => 'nullable|exists:vendors,id',
            'status' => 'required|in:Active,Inactive',
            'image'  => [new CheckValidFile(getFileExtensions(3))],
        ]);

        return $validator;
    }

    /**
     * Update Validation
     * @param array $data
     * @return mixed
     */
    protected static function updateValidation($data = [], $id)
    {
        $validator = Validator::make($data, [
            'name' => ['required', 'min:3', 'max:50', 'unique:brands,name,' . $id],
            'vendor' => 'nullable|exists:vendors,id',
            'status' => 'required|in:Active,Inactive',
            'image'  => [new CheckValidFile(getFileExtensions(3))],
        ]);

        return $validator;
    }

    /**
     * Store
     * @param  array  $data
     * @return int|null
     */
    public function store($data = [])
    {
        $id = parent::insertGetId($data);

        $this->uploadFiles(['isUploaded' => false, 'isOriginalNameRequired' => true]);

        if (!empty($id)) {
            self::forgetCache();
            return $id;
        }
        return false;
    }

    /**
     * Update Brand
     * @param array $data
     * @param null $id
     * @return bool
     */
    public function updateBrand($data = [], $id = null)
    {
        $result = $this->where('id', $id);
        if ($result->exists()) {

            $result->update($data);

            $result->first()->updateFiles(['isUploaded' => false, 'isOriginalNameRequired' => true]);


            self::forgetCache();
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
        $data = ['status' => 'fail', 'message' => __('Something went wrong, please try again.')];
        $record = parent::find($id);
        if (!empty($record)) {
            try {
                $record->delete();

                #delete file region
                $record->deleteFiles();

                $data['status'] = 'success';
                $data['message'] = __('The :x has been successfully deleted.', ['x' => __('Brand')]);
            } catch (Exception $e) {
                $data['message'] = $e->getMessage();
            }
        }

        return $data;
    }

    /**
     * Top brands
     * @param null
     * @return collection
     */
    public static function topBrands()
    {
        $brands = parent::whereHas('item', function ($query) {
            $query->whereNotNull('purchase_count');
        })->withSum('item', 'purchase_count')->orderByDesc('item_sum_purchase_count')->get()->take(9);

        if ($brands->count() < 2) {
            $brands = parent::has('item')->get()->take(9);
        }

        return $brands;
    }


    public function bestSeller()
    {
        $brands = parent::whereHas('item', function ($query) {
            $query->whereNotNull('purchase_count');
        })->withSum('item', 'purchase_count')->orderByDesc('item_sum_purchase_count')->get()->take(9);

        if ($brands->count() < 2) {
            $brands = parent::has('item')->get()->take(9);
        }

        return $brands;
    }

    public function popularBrand()
    {
        $brands = parent::whereHas('item', function ($query) {
            $query->whereNotNull('purchase_count');
        })->withSum('item', 'purchase_count')->orderByDesc('item_sum_purchase_count')->get()->take(9);

        if ($brands->count() < 2) {
            $brands = parent::has('item')->get()->take(9);
        }

        return $brands;
    }
}
