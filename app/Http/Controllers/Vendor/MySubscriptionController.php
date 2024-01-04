<?php
/**
 * @package MySubscriptionController
 * @author techvillage <support@techvill.org>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @created 25-10-2021
 */

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\{
    Currency,
    Package,
    PackageSubscription,
    PaymentMethod,
    Preference
};
use Auth, Stripe, Hash;
use Illuminate\Http\Request;

class MySubscriptionController extends Controller
{
    /**
     * Display a listing of subscribe package
     *
     * @return Dashboard page view
     */
    public function index()
    {
        $data['subscriptions'] = PackageSubscription::where('vendor_id', session()->get('vendorId'))->select('id', 'billing_date', 'next_billing_date', 'billing_cycle', 'is_renewed', 'is_customized', 'status', 'package_id' )->with(['package:id,name,code,price'])->get();
        $data['digit'] = Preference::getAll()->where('category', 'preference')->pluck('value', 'field')->toArray();
        $data['packages'] = Package::getAll()->where('status', 'active')->where('is_private', 0);

        return view('vendor.my_subscription.index', $data);
    }

    /**
     * Display a listing of all active package
     *
     * @return Dashboard page view
     */
    public function packageList()
    {
        $data['packages'] = Package::getAll()->where('status', 'active')->where('is_private', 0);

        $data['digit'] = Preference::getAll()->where('category', 'preference')->pluck('value', 'field')->toArray();
        $data['increment'] = 1;
        return view('vendor.my_subscription.pricing', $data);
    }

    /**
     * Store package subscription
     * @param  string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function packageSubscription(Request $request, $id = null)
    {
        $response = $this->messageArray(__('Invalid Request'), 'fail');
        $currency = Currency::getAll()->where('id', preference('dflt_currency_id'))->first()->name;
        $secret = PaymentMethod::getAll()->where('id', 3)->first()->consumer_secret;
        $package = $this->checkExistance($id, 'packages', ['getData' => true]);
        $subId = PackageSubscription::getAll()->where('vendor_id', session()->get('vendorId'))->first()->id;

        $interval = $package['data']->billing_cycle == 'monthly' ? 'month' : 'year';
        try {
            Stripe\Stripe::setApiKey($secret);
            try {
                $customer = Stripe\Customer::create([
                    'email' => Auth::user()->email,
                    "source" => $request->stripeToken
                ]);
                $product = Stripe\Product::create([
                    'name' => $package['data']->name,
                ]);
                $price = Stripe\Price::create([
                    'unit_amount' => round($package['data']->price, 2) * 100,
                    'currency' => $currency,
                    'recurring' => ['interval' => $interval],
                    'product' => $product->id,
                ]);
                $subscription = Stripe\Subscription::create([
                    'customer' => $customer->id,
                    'items' => [
                        ['price' => $price->id],
                    ],
                ]);

            } catch (Stripe\Exception\InvalidRequestException $e) {
                $this->setSessionValue(['status' => 'fail', 'message' => $e->getMessage()]);
                return back();
            }
            if ($subscription->status == "active") {
                if (empty($vendorId) && $package['status'] === false) {
                    $this->setSessionValue($response);
                    return redirect()->back();
                }

                $vendor = $this->checkExistance(session()->get('vendorId'), 'vendors', ['getData' => true]);
                $data['name'] = $vendor['data']->name;
                $data['vendor_id'] = session()->get('vendorId');
                $data['package_id'] = $package['data']->id;
                $data['payment_processor'] = 'stripe';
                $data['billing_cycle'] = $package['data']->billing_cycle;
                $data['billing_email'] = $vendor['data']->email;
                $data['billing_phone'] = $vendor['data']->phone;
                $data['transaction_order_number'] = $subscription->customer;
                $data['transaction_invoice_id'] = $subscription->latest_invoice;
                $data['transaction_reference'] = $subscription->id;
                $data['is_customized'] = 0;
                $data['is_renewed'] = 1;
                $data['customized_records'] = 0;
                $data['activation_date'] = date("Y-m-d H:i:s", $subscription->current_period_start);
                $data['billing_date'] = date("Y-m-d H:i:s", $subscription->current_period_start);
                $data['next_billing_date'] = date("Y-m-d H:i:s", $subscription->current_period_end);

                $data['billing_price'] = round($subscription->plan->amount / 100, 2);
                $data['amount_billed'] = round($subscription->plan->amount / 100, 2);
                $data['amount_received'] = round($subscription->plan->amount / 100, 2);
                $data['status'] = $package['data']->status;

                $validator = PackageSubscription::storeValidation($data);
                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput();
                }
                if ((new PackageSubscription)->updatePackage($data, $subId)) {
                    $response['status'] = 'success';
                    $response['message'] = __('The :x has been successfully saved.', ['x' => __('Package Subscription')]);
                } else {
                    $response['message'] = __('Something went wrong, please try again.');
                }

                $this->setSessionValue($response);
                return redirect()->route('vendor.my_subscription.index');
            } else {
                $response['message'] = __('Something went wrong, please try again.');
                $this->setSessionValue($response);
                return back();
            }
        } catch (Stripe\Exception\AuthenticationException $e) {
            $this->setSessionValue(['status' => 'fail', 'message' => $e->getMessage()]);
            return back();
        }
    }

    /**
     * Display a listing of all active package
     * @param int $id
     * @return back
     */
    public function cancelSubscription(Request $request, $id = null) {
        $response = $this->messageArray(__('Invalid Request'), 'fail');
        if (!(Hash::check($request->password, Auth::user()->password))) {
            $this->setSessionValue(['status' => 'fail', 'message' => __('Incorrect password')]);
            return back();
        }
        $secret = PaymentMethod::getAll()->where('id', 3)->first()->consumer_secret;
        $packageSubscription = PackageSubscription::getAll()->where('id', $id)->first();
        if (empty($packageSubscription->transaction_reference)) {
            if ((new PackageSubscription)->cancel($id)) {
                $response['status'] = 'success';
                $response['message'] = __('The :x has been successfully canceled.', ['x' => __('Package Subscription')]);
            } else {
                $response['message'] = __('Something went wrong, please try again.');
            }
            $this->setSessionValue($response);
            return back();
        }
        if ((!isset($packageSubscription) && empty($packageSubscription->transaction_reference) || empty($secret))) {
            $this->setSessionValue($response);
            return back();
        }
        try {
            $stripe = new \Stripe\StripeClient($secret);
            try {
                $sub = $stripe->subscriptions->retrieve (
                    $packageSubscription->transaction_reference,
                    []
                );
                if ($sub->status != 'canceled') {
                    $sub = $stripe->subscriptions->cancel (
                        $packageSubscription->transaction_reference,
                        []
                    );
                }
            } catch (Stripe\Exception\InvalidRequestException $e) {
                $this->setSessionValue(['status' => 'fail', 'message' => $e->getMessage()]);
                return back();
            }
            if ($sub->status == "canceled") {
                if ((new PackageSubscription)->cancel($id)) {
                    $response['status'] = 'success';
                    $response['message'] = __('The :x has been successfully canceled.', ['x' => __('Package Subscription')]);
                } else {
                    $response['message'] = __('Something went wrong, please try again.');
                }
                $this->setSessionValue($response);
                return redirect()->route('vendor.my_subscription.index');
            } else {
                $response['message'] = __('Something went wrong, please try again.');
                $this->setSessionValue($response);
                return back();
            }
        } catch (Stripe\Exception\AuthenticationException $e) {
            $this->setSessionValue(['status' => 'fail', 'message' => $e->getMessage()]);
            return back();
        }
    }

    /**
     * Display payment page
     * @param int $id
     * @return Payment page view
     */
    public function paymentSubscription(Request $request, $id = null) {

        $data['digit'] = Preference::getAll()->where('category', 'preference')->pluck('value', 'field')->toArray();
        if (isset($request->package)) {
            $data['package'] = Package::getAll()->where('id', $id)->first();
        } elseif (isset($request->subscription)) {
            $data['package_subscription'] = PackageSubscription::getAll()->where('id', $id)->first();
        }
        $data['publishableKey'] = PaymentMethod::getAll()->where('id', 3)->first()->consumer_key;
        return view('vendor.my_subscription.payment', $data);
    }


    /**
     * store subscription
     * @param request
     * @return Payment page view
     */
    public function renewSubscription(Request $request)
    {
        $response = $this->messageArray(__('Invalid Request'), 'fail');
        $currency = Currency::getAll()->where('id', preference('dflt_currency_id'))->first()->name;
        $packageSubscription = $this->checkExistance($request->package_subscription_id, 'package_subscriptions', ['getData' => true]);
        if ($packageSubscription['status'] == false) {
            $this->setSessionValue($packageSubscription['message']);
            return redirect()->route('vendor.my_subscription.index');
        }
        $package = $this->checkExistance($packageSubscription['data']->package_id, 'packages', ['getData' => true]);
        $interval = $package['data']->billing_cycle == 'monthly' ? 'month' : 'year';
        $secret = PaymentMethod::getAll()->where('id', 3)->first()->consumer_secret;

        try {
            Stripe\Stripe::setApiKey($secret);
            try {
                $customer = Stripe\Customer::create([
                    'email' => Auth::user()->email,
                    "source" => $request->stripeToken
                ]);
                $product = Stripe\Product::create([
                    'name' => $package['data']->name,
                ]);
                $price = Stripe\Price::create([
                    'unit_amount' => round($package['data']->price, 2) * 100,
                    'currency' => $currency,
                    'recurring' => ['interval' => $interval],
                    'product' => $product->id,
                ]);
                $subscription = Stripe\Subscription::create([
                    'customer' => $customer->id,
                    'items' => [
                        ['price' => $price->id],
                    ],
                ]);
            } catch (Stripe\Exception\AuthenticationException $e) {
                $this->setSessionValue(['status' => 'fail', 'message' => $e->getMessage()]);
                return back();
            }
            if ($subscription->status == "active") {
                if ((new PackageSubscription)->renew($subscription, $request->package_subscription_id)) {
                    $response['status'] = 'success';
                    $response['message'] = __('The :x has been successfully renewed.', ['x' => __('Package Subscription')]);
                } else {
                    $response['message'] = __('Something went wrong, please try again.');
                }
                $this->setSessionValue($response);
                return redirect()->route('vendor.my_subscription.index');

            } else {
                $this->setSessionValue(['status' => 'fail', 'message' => __('Something went wrong, please try again.')]);
                return back();
            }
        } catch(Stripe\Exception\InvalidRequestException $e) {
            $this->setSessionValue(['status' => 'fail', 'message' => $e->getMessage()]);
            return back();
        }
    }
}
