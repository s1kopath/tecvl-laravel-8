<?php
/**
 * @package PackageSubscription Model
 * @author techvillage <support@techvill.org>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @created 02-09-2021
 * @modified 14-09-2021
 */

namespace App\Models;

use App\Rules\CheckValidEmail;
use App\Models\Model;
use Validator;

class PackageSubscription extends Model
{
    /**
     * timestamps
     * @var boolean
     */
    public $timestamps = false;

    /**
     * Foreign key with Package model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function package()
    {
        return $this->belongsTo('App\Models\Package', 'package_id', 'id');
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
     * @param  array  $data
     * @return mixed
     */
    protected static function storeValidation($data = [])
    {
        $validator = Validator::make($data, [
            'name' => 'nullable|min:3|max:100',
            'vendor_id' => 'required',
            'package_id' => 'required',
            'payment_processor' => 'required',
            'activation_date' => 'required|date',
            'billing_date' => 'required|date',
            'next_billing_date' => 'required|date',
            'billing_first_name' => 'nullable|max:30',
            'billing_last_name' => 'nullable|max:30',
            'billing_name' => 'nullable|min:3|max:100',
            'billing_email' => ['required', new CheckValidEmail],
            'billing_street_address' => 'nullable|min:3|max:60',
            'billing_street_address2' => 'nullable|min:3|max:60',
            'billing_city' => 'nullable|min:2|max:30',
            'billing_state' => 'nullable|min:2|max:30',
            'billing_zip' => 'nullable|min:3|max:10',
            'billing_country' => 'nullable|min:2|max:30',
            'billing_phone' => 'nullable|numeric|digits_between:10,13',
            'billing_price' => ['required', 'regex:/^[0-9]{1,8}(\.[0-9]{1,8})?$/'],
            'billing_cycle' => 'required|in:monthly,yearly',
            'amount_billed' => ['required', 'regex:/^[0-9]{1,8}(\.[0-9]{1,8})?$/'],
            'amount_received' => ['required', 'regex:/^[0-9]{1,8}(\.[0-9]{1,8})?$/'],
            'amount_due' => ['nullable', 'regex:/^[0-9]{1,8}(\.[0-9]{1,8})?$/'],
            'transaction_order_number' => 'required|min:3|max:44',
            'transaction_invoice_id' => 'required|min:3|max:44',
            'transaction_reference' => 'required|min:3|max:44',
            'is_customized' => 'in:0,1',
            'is_renewed' => 'in:0,1',
            'customized_records' => 'nullable|numeric|digits_between:0,10',
            'status' => 'required|in:pending,active,expired,paused',
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
            'name' => 'nullable|min:3|max:100',
            'vendor_id' => 'required',
            'package_id' => 'required',
            'payment_processor' => 'required',
            'activation_date' => 'required|date',
            'billing_date' => 'required|date',
            'next_billing_date' => 'required|date',
            'billing_first_name' => 'nullable|max:30',
            'billing_last_name' => 'nullable|max:30',
            'billing_name' => 'nullable|min:3|max:100',
            'billing_email' => ['required', new CheckValidEmail],
            'billing_street_address' => 'nullable|min:3|max:60',
            'billing_street_address2' => 'nullable|min:3|max:60',
            'billing_city' => 'nullable|min:2|max:30',
            'billing_state' => 'nullable|min:2|max:30',
            'billing_zip' => 'nullable|min:3|max:10',
            'billing_country' => 'nullable|min:2|max:30',
            'billing_phone' => 'nullable|numeric|digits_between:10,13',
            'billing_price' => ['required', 'regex:/^[0-9]{1,8}(\.[0-9]{1,8})?$/'],
            'billing_cycle' => 'required|in:monthly,yearly',
            'amount_billed' => ['required', 'regex:/^[0-9]{1,8}(\.[0-9]{1,8})?$/'],
            'amount_received' => ['required', 'regex:/^[0-9]{1,8}(\.[0-9]{1,8})?$/'],
            'amount_due' => ['nullable', 'regex:/^[0-9]{1,8}(\.[0-9]{1,8})?$/'],
            'transaction_order_number' => 'required|min:3|max:44',
            'transaction_invoice_id' => 'required|min:3|max:44',
            'transaction_reference' => 'required|min:3|max:44',
            'is_customized' => 'in:0,1',
            'is_renewed' => 'in:0,1',
            'customized_records' => 'nullable|numeric|digits_between:0,10',
            'status' => 'required|in:pending,active,expired,paused',
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
    public function updatePackage($request = [], $id = null)
    {
        $data = ['status' => 'fail', 'message' => __('Something went wrong, please try again.')];
        $result = parent::where('id', $id);
        if ($result->exists()) {

            $result->update(array_intersect_key($request, array_flip((array) [
                'name',
                'vendor_id',
                'package_id',
                'payment_processor',
                'billing_cycle',
                'billing_first_name',
                'billing_last_name',
                'billing_name',
                'billing_email',
                'billing_street_address',
                'billing_street_address2',
                'billing_state',
                'billing_zip',
                'billing_country',
                'billing_city',
                'billing_phone',
                'transaction_order_number',
                'transaction_invoice_id',
                'transaction_reference',
                'is_customized',
                'is_renewed',
                'customized_records',
                'activation_date',
                'billing_date',
                'next_billing_date',
                'billing_price',
                'amount_billed',
                'amount_received',
                'amount_due',
                'status'
            ])));
            self::forgetCache();

            $data['status'] = 'success';
            $data['message'] = __('The :x has been successfully saved.', ['x' => __('Package Subscription')]);
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
            $data['message'] = __('The :x has been successfully deleted.', ['x' => __('Package Subscription')]);
        }
        return $data;
    }

    public function cancel($id = null)
    {
        parent::where('id', $id)->update(['is_renewed' => 0]);
        self::forgetCache(['packages', 'package_subscriptions']);
        return 1;
    }
    public function renew($subscription, $id = null)
    {
        $data = parent::where('id', $id);
        if ($data->exists()) {
            $subInfo['next_billing_date'] = date("Y-m-d H:i:s", $subscription->current_period_end);
            $subInfo['is_renewed'] = 1;
            $subInfo['transaction_reference'] = $subscription->id;
            $subInfo['status'] = 'active';

            $data->update($subInfo);
            self::forgetCache(['packages', 'package_subscriptions']);
            return 1;
        }
        return 0;

    }
}
