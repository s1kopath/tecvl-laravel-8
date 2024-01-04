<?php
/**
 * @package Tax
 * @author techvillage <support@techvill.org>
 * @contributor Sakawat Hossain Rony <[sakawat.techvill@gmail.com]>
 * @created 23-09-2021
 */
namespace App\Models;

use App\Models\Model;
use Validator;

class Tax extends Model
{
    public $timestamps = false;

    /**
     * Store Validation Rules
     * @param  array $data
     * @return object
     */
    protected function storeValidation($data = [])
    {
        $validator = Validator::make($data, [
            'name'          => 'required|min:2|max:50|unique:taxes,name',
            'tax_rate' => ['required', 'required', 'regex:/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/'],
            'is_default' => 'required | in:1,0',
        ]);

        return $validator;
    }

    /**
     * Tax update validation rules
     * @param  array $data
     * @return object
     */
    protected function updateValidation($data = [], $id)
    {
        $validator = Validator::make($data, [
            'name'          => ['required','min:2', 'max:50', 'unique:taxes,name,' . $id],
            'tax_rate' => ['required', 'regex:/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/'],
            'is_default' => 'required | in:1,0',
        ]);

        return $validator;
    }


    /**
     * Store Tax
     * @param  array $data
     * @return object
     */
    public function store($data = [])
    {
        if($data['is_default'] == 1) {
            parent::where('is_default', 1)->update(['is_default' => 0]);
        }
        if(parent::insert($data)) {
            self::forgetCache();
            return true;
        } else {
            return false;
        }
    }

    /**
     * Tax Update
     * @param  array $data
     * @return object
     */
    public function taxUpdate($data = [], $id)
    {
        if($data['is_default'] == 1) {
            parent::where('is_default', 1)->update(['is_default' => 0]);
        }
        if(parent::where('id', $id)->update($data)) {
            self::forgetCache();
            return true;
        };
        return false;
    }

    /**
     * Delete
     * @param string $id
     * @return array
     */
    public function remove($id = null)
    {
        $data = ['status' => 'fail', 'message' => __('Tax does not found.')];
        $record = parent::find($id);
        if (!empty($record)) {
            if ($record->is_default != 1) {
                $record->delete();
                self::forgetCache();
                $data['status'] = 'success';
                $data['message'] = __('The :x has been successfully deleted.', ['x' => __('Tax')]);
            } else {
                $data = [ 'status' => 'fail', 'message' => __('Can not be deleted. This is default :x.', ['x' => __('Tax')])];
            }
        }

        return $data;
    }
}
