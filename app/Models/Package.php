<?php
/**
 * @package Package Model
 * @author techvillage <support@techvill.org>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @created 31-08-2021
 * @modified 06-09-2021
 */

namespace App\Models;

use Validator;

class Package extends Model
{
    /**
     * timestamps
     * @var boolean
     */
    public $timestamps = false;

    /**
     * Relation with PackageSubscription model
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function packageSubscription()
    {
        return $this->hasOne('App\Models\PackageSubscription', 'package_id', 'id');
    }

    /**
     * Store Validation
     * @param  array  $data
     * @return mixed
     */
    protected static function storeValidation($data = [])
    {
        $validator = Validator::make($data, [
            'name' => 'required|min:3|max:99|unique:packages,name',
            'code' => 'required|min:3|max:44',
            'description' => 'required|min:5|max:5000',
            'params' => 'nullable|max:999',
            'price' => ['required', 'regex:/^[0-9]{1,8}(\.[0-9]{1,8})?$/'],
            'billing_cycle' => 'required|in:monthly,yearly',
            'is_private' => 'required|in:0,1',
            'status' => 'required|in:pending,active,inactive',
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
            'name' => 'required|min:3|max:99|unique:packages,name,' . $id,
            'code' => 'required|min:3|max:44',
            'description' => 'required|min:5|max:5000',
            'params' => 'nullable|max:999',
            'price' => ['required', 'regex:/^[0-9]{1,8}(\.[0-9]{1,8})?$/'],
            'billing_cycle' => 'required|in:monthly,yearly',
            'sort_order' => 'required|numeric|min:0|max:99999999|unique:packages,sort_order,' . $id,
            'is_private' => 'required|in:0,1',
            'status' => 'required|in:pending,active,inactive',
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
        $data['sort_order'] = parent::max('sort_order') + 1;

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
    public function updatePackage($request = [], $id = null)
    {
        $data = ['status' => 'fail', 'message' => __('Something went wrong, please try again.')];
        $result = parent::where('id', $id);
        if ($result->exists()) {
            $result->update(array_intersect_key($request, array_flip((array) ['name', 'code', 'description', 'params', 'price', 'billing_cycle', 'sort_order', 'is_private', 'status'])));
            self::forgetCache();

            $data['status'] = 'success';
            $data['message'] = __('The :x has been successfully saved.', ['x' => __('Package')]);
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
            $data['message'] = __('The :x has been successfully deleted.', ['x' => __('Package')]);
        }
        return $data;
    }

    /**
     * Check package used or not
     * @param  string $id
     * @return boolean
     */
    public function isPackageUsed($id = null)
    {
        if (PackageSubscription::getAll()->where('package_id', $id)->count() > 0) {
            return true;
        }

        return false;
    }
}
