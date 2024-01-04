<?php
/**
 * @package PackageSubscriptionController
 * @author techvillage <support@techvill.org>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @created 26-09-2021
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\{
    PackageSubscriptionResource
};
use App\Models\{
    PackageSubscription,
};
use Illuminate\Http\Request;

class PackageSubscriptionController extends Controller
{
    /**
     * Package Subscription List
     * @param Request $request
     * @return json $data
     */
    public function index(Request $request)
    {
        $configs = $this->initialize([], $request->all());
        $packageSubscription = PackageSubscription::select('package_subscriptions.*');

        $name = isset($request->name) ? $request->name : null;
        if (!empty($name)) {
            $packageSubscription->where('name', strtolower($name));
        }

        $activation_date = isset($request->activation_date) ? $request->activation_date : null;
        if (!empty($activation_date)) {
            $packageSubscription->where('activation_date', $activation_date);
        }

        $billing_date = isset($request->billing_date) ? $request->billing_date : null;
        if (!empty($billing_date)) {
            $packageSubscription->where('billing_date', $billing_date);
        }

        $next_billing_date = isset($request->next_billing_date) ? $request->next_billing_date : null;
        if (!empty($next_billing_date)) {
            $packageSubscription->where('next_billing_date', $next_billing_date);
        }

        $billing_name = isset($request->billing_name) ? $request->billing_name : null;
        if (!empty($billing_name)) {
            $packageSubscription->where('billing_name', strtolower($billing_name));
        }

        $billing_first_name = isset($request->billing_first_name) ? $request->billing_first_name : null;
        if (!empty($billing_first_name)) {
            $packageSubscription->where('billing_first_name', strtolower($billing_first_name));
        }

        $billing_last_name = isset($request->billing_last_name) ? $request->billing_last_name : null;
        if (!empty($billing_last_name)) {
            $packageSubscription->where('billing_last_name', strtolower($billing_last_name));
        }

        $billing_email = isset($request->billing_email) ? $request->billing_email : null;
        if (!empty($billing_email)) {
            $packageSubscription->where('billing_email', $billing_email);
        }

        $billing_phone = isset($request->billing_phone) ? $request->billing_phone : null;
        if (!empty($billing_phone)) {
            $packageSubscription->where('billing_phone', $billing_phone);
        }

        $billing_price = isset($request->billing_price) ? $request->billing_price : null;
        if (!empty($billing_price)) {
            $packageSubscription->where('billing_price', $billing_price);
        }

        $billing_cycle = isset($request->billing_cycle) ? $request->billing_cycle : null;
        if (!empty($billing_cycle)) {
            $packageSubscription->where('billing_cycle', $billing_cycle);
        }

        $amount_billed = isset($request->amount_billed) ? $request->amount_billed : null;
        if (!empty($amount_billed)) {
            $packageSubscription->where('amount_billed', $amount_billed);
        }

        $amount_received = isset($request->amount_received) ? $request->amount_received : null;
        if (!empty($amount_received)) {
            $packageSubscription->where('amount_received', $amount_received);
        }

        $amount_due = isset($request->amount_due) ? $request->amount_due : null;
        if (!empty($amount_due)) {
            $packageSubscription->where('amount_due', $amount_due);
        }

        $payment_processor = isset($request->payment_processor) ? $request->payment_processor : null;
        if (!empty($payment_processor)) {
            $packageSubscription->where('payment_processor', strtolower($payment_processor));
        }

        $transaction_order_number = isset($request->transaction_order_number) ? $request->transaction_order_number : null;
        if (!empty($transaction_order_number)) {
            $packageSubscription->where('transaction_order_number', strtolower($transaction_order_number));
        }

        $transaction_invoice_id = isset($request->transaction_invoice_id) ? $request->transaction_invoice_id : null;
        if (!empty($transaction_invoice_id)) {
            $packageSubscription->where('transaction_invoice_id', $transaction_invoice_id);
        }

        $transaction_reference = isset($request->transaction_reference) ? trim(xss_clean($request->transaction_reference)) : null;
        if (!empty($transaction_reference)) {
            $packageSubscription->where('transaction_reference', strtolower($transaction_reference));
        }

        if (isset($request->is_customized)) {
            $packageSubscription->where('is_customized', $request->is_customized);
        }

        $customized_records = isset($request->customized_records) ? $request->customized_records : null;
        if (!empty($customized_records)) {
            $packageSubscription->where('customized_records', $customized_records);
        }

        if (isset($request->is_renewed)) {
            $packageSubscription->where('is_renewed', $request->is_renewed);
        }

        $status = isset($request->status) ? $request->status : null;
        if (!empty($status)) {
            $packageSubscription->where('status', strtolower($status));
        }

        $keyword = isset($request->keyword) ? $request->keyword : null;
        if (!empty($keyword)) {
            if (is_int($keyword)) {
                $packageSubscription->where(function ($query) use ($keyword) {
                    $query->where('id', $keyword)
                        ->orwhere('billing_price', 'LIKE', '%' . $keyword . '%')
                        ->orwhere('transaction_order_number', 'LIKE', '%' . $keyword . '%')
                        ->orwhere('transaction_invoice_id', 'LIKE', '%' . $keyword . '%')
                        ->orwhere('transaction_reference', 'LIKE', '%' . $keyword . '%');
                });
            } else {
                if (strlen($keyword) >= 2) {
                    $packageSubscription->where(function ($query) use ($keyword) {
                        $query->where('name', 'LIKE', '%' . $keyword . '%')
                            ->orwhere('billing_name', 'LIKE', '%' . $keyword . '%')
                            ->orwhere('billing_email', 'LIKE', '%' . $keyword . '%')
                            ->orwhere('billing_phone', 'LIKE', '%' . $keyword . '%')
                            ->orwhere('billing_price', 'LIKE', '%' . $keyword . '%')
                            ->orwhere('transaction_order_number', 'LIKE', '%' . $keyword . '%')
                            ->orwhere('transaction_invoice_id', 'LIKE', '%' . $keyword . '%')
                            ->orwhere('transaction_reference', 'LIKE', '%' . $keyword . '%')
                            ->orwhere('status', $keyword);
                    });
                }
            }
        }
        return $this->response([
            'data' => PackageSubscriptionResource::collection($packageSubscription->paginate($configs['rows_per_page'])),
            'pagination' => $this->toArray($packageSubscription->paginate($configs['rows_per_page'])->appends($request->all()))
        ]);
    }

    /**
     * Store Package Subscription
     * @param Request $request
     * @return json $data
     */
    public function store(Request $request)
    {
        if (isset($request->billing_cycle) && array_key_exists(strtolower($request->billing_cycle), ['monthly' => 'monthly', 'yearly' => 'yearly'])) {
            $request['billing_cycle'] = strtolower($request->billing_cycle);
        }
        if (isset($request->status) && array_key_exists(strtolower($request->status), ['pending' => 'pending', 'expired' => 'expired', 'active' => 'active', 'paused' => 'paused'])) {
            $request['status'] = strtolower($request->status);
        }
        $validator =  PackageSubscription::storeValidation($request->all());
        if ($validator->fails()) {
            return $this->unprocessableResponse($validator->messages());
        }
        if ((new PackageSubscription)->store($request->all())) {
            return $this->okResponse([], __('The :x has been successfully saved.', ['x' => __('Package Subscription')]));
        }
        return $this->errorResponse();
    }

    /**
     * Detail Package Subscription
     * @param Request $request
     * @return json $data
     */
    public function detail($id)
    {
        $response = $this->checkExistance($id, 'package_subscriptions');
        $packageSubscriptionData = PackageSubscription::getAll()->where('id', $id)->first();
        if ($response['status'] === true && !empty($packageSubscriptionData)) {
            return $this->response(['data' => new PackageSubscriptionResource($packageSubscriptionData)]);
        }
        return $this->response([], 204, $response['message']);
    }

    /**
     * Update Package Subscription Information
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        $response = $this->checkExistance($id, 'package_subscriptions');
        if ($response['status'] === true) {
            if (isset($request->billing_cycle) && array_key_exists(strtolower($request->billing_cycle), ['monthly' => 'monthly', 'yearly' => 'yearly'])) {
                $request['billing_cycle'] = strtolower($request->billing_cycle);
            }
            if (isset($request->status) && array_key_exists(strtolower($request->status), ['pending' => 'pending', 'expired' => 'expired', 'active' => 'active', 'paused' => 'paused'])) {
                $request['status'] = strtolower($request->status);
            }
            $validator = PackageSubscription::updateValidation($request->all(), $id);
            if ($validator->fails()) {
                return $this->unprocessableResponse($validator->messages());
            }
            if ((new PackageSubscription())->updatePackage($request->all(), $id)) {
                return $this->okResponse([], __('The :x has been successfully saved.', ['x' => __('Package Subscription')]));
            } else {
                return $this->okResponse([], __('No changes found.'));
            }
        }
        return $this->response([], 204, $response['message']);
    }

    /**
     * Remove the specified Package Subscription from db.
     * @param Request $id
     * @return json $data
     */
    public function destroy($id)
    {
        $response = $this->checkExistance($id, 'package_subscriptions');
        if ($response['status'] === true) {
            $result  = (new PackageSubscription)->remove($id);
            return $this->okResponse([], $result['message']);
        }
        return $this->response([], 204, $response['message']);
    }
}
