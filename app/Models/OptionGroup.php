<?php
/**
 * @package OptionGroup Model
 * @author techvillage <support@techvill.org>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @created 05-09-2021
 */
namespace App\Models;

use App\Rules\{
    CheckChildCategory,
    CheckLabel,
    CheckPrice,
    CheckPriceType
};
use App\Traits\ModelTrait;
use App\Models\Model;
Use Validator;

class OptionGroup extends Model
{
    use ModelTrait;
    /**
     * Relation with Option model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function option()
    {
        return $this->hasMany('App\Models\Option', 'option_group_id', 'id')->orderBy('order_by', 'ASC');
    }

    /**
     * Foreign key with Vendor model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vendor()
    {
        return $this->belongsTo('App\Models\Vendor', 'vendor_id');
    }

    /**
     * Store Validation
     * @param array $data
     * @return mixed
     */
    protected static function storeValidation($data = [])
    {
        $labelChk = labelRequiredElement();
        $valCount = is_array($data['price']) ? count($data['price']) : null;
        $rules = [
            'name' => 'required|min:3|max:50|not_in:Color,Size,color,size',
            'type' => 'required|in:field,textarea,dropdown,checkbox,checkbox_custom,radio,radio_custom,multiple_select,date,date_time,time',
            'category_ids' => ['required', new CheckChildCategory()],
            'is_required' => 'required|in:1,0',
            'price_type' => ['required', new CheckPriceType($valCount)],
            'price' => ['required', new CheckPrice],
        ];
        if (isset($data['type']) && in_array($data['type'], $labelChk)) {
            $rules['label'] = ['required', new CheckLabel($valCount)];
        }

        return Validator::make($data, $rules);
    }

    /**
     * Update Validation
     * @param array $data
     * @return mixed
     */
    protected static function updateValidation($data = [], $id)
    {
        $labelChk = labelRequiredElement();
        $valCount = is_array($data['price']) ? count($data['price']) : null;
        $rules = [
            'is_required' => 'required|in:1,0',
            'price_type' => ['required', new CheckPriceType($valCount)],
            'price' => ['required', new CheckPrice],
        ];
        if ($id != 1 && $id != 2) {
            $rules['category_ids'] = ['required', new CheckChildCategory()];
            $rules['name'] = ['required','min:3','max:50','not_in:Color,Size,color,size'];
            $rules['type'] = ['required','in:field,textarea,dropdown,checkbox,checkbox_custom,radio,radio_custom,multiple_select,date,date_time,time'];
        }
        if (isset($data['type']) && in_array($data['type'], $labelChk)) {
            $rules['label'] = ['required', new CheckLabel($valCount)];
        } elseif ($id == 1 || $id == 2) {
            $rules['label'] = ['required', new CheckLabel($valCount)];
        }

        return Validator::make($data, $rules);
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
            self::forgetCache(['options', 'option_groups']);
            return $id;
        }
        return false;
    }

    /**
     * Update Option Group
     * @param array $data
     * @param null $id
     * @return bool
     */
    public function updateOptionGroup($data = [], $id = null)
    {
        $result = parent::where('id', $id);
        if ($result->exists()) {
            $result->update($data);
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
                $data['status'] = 'success';
                $data['message'] = __('The :x has been successfully deleted.', ['x' => __('Option')]);
            } catch (Exception $e) {
                $data['message'] = $e->getMessage();
            }
        }

        return $data;
    }
}
