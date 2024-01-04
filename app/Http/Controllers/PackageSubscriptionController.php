<?php
/**
 * @package PackageSubscriptionController
 * @author techvillage <support@techvill.org>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @created 02-09-2021
 * @modified 30-09-2021
 */

namespace App\Http\Controllers;

use App\Exports\PackageSubscriptionListExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\PackageSubscriptionDataTable;
use App\Models\{
    Country,
    PackageSubscription,
    Vendor,
    PaymentMethod,
    Package,
    Preference
};
use Excel;

class PackageSubscriptionController extends Controller
{
    /**
     * Package subscription list
     * @param  PackageSubscriptionDataTable $dataTable
     * @return \Illuminate\Contracts\View\View
     */
    public function index(PackageSubscriptionDataTable $dataTable)
    {
        return $dataTable->render('admin.package_subscription.index');
    }

    /**
     * Show
     * @param  string $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $data['subscription'] = isset($id) && !empty($id) ? PackageSubscription::getAll()->where('id', $id)->first() : null;
        $data['digit'] = Preference::getAll()->where('category', 'preference')->pluck('value', 'field')->toArray();

        if ($data['subscription'] == null) {
            return redirect()->back();
        }
        return view('admin.package_subscription.show', $data);
    }

    /**
     * Create
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $data['vendors'] = Vendor::getAll();
        $data['payments'] = PaymentMethod::getAll();
        $data['packages'] = Package::getAll();
        $data['countries'] = Country::getAll();

        return view('admin.package_subscription.create', $data);
    }

    /**
     * Store
     * @param  Request $request
     * @return \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $data = ['status' => 'fail', 'message' => __('Invalid Request')];

        if (isset($request->billing_cycle) && array_key_exists(strtolower($request->billing_cycle), ['monthly' => 'monthly', 'yearly' => 'yearly'])) {
            $request['billing_cycle'] = strtolower($request->billing_cycle);
        }
        if (isset($request->status) && array_key_exists(strtolower($request->status), ['pending' => 'pending', 'expired' => 'expired', 'active' => 'active', 'paused' => 'paused'])) {
            $request['status'] = strtolower($request->status);
        }

        $request['customized_records'] = empty($request->is_customized) ? null : $request->customized_records;
        $request['activation_date'] = DbDateFormat($request->activation_date);
        $request['billing_date'] = DbDateFormat($request->billing_date);
        $request['next_billing_date'] = DbDateFormat($request->next_billing_date);
        $validator =  PackageSubscription::storeValidation($request->all());
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if ((new PackageSubscription)->store($request->only(
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
            ))) {

            $data['status'] = 'success';
            $data['message'] = __('The :x has been successfully saved.', ['x' => __('Package Subscription')]);
        } else {
            $data['message'] = __('Something went wrong, please try again.');
        }

        $this->setSessionValue($data);
        return redirect()->route('packageSubscription.index');
    }

    /**
     * Edit
     * @param  string $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id = null)
    {
        $data['subscription'] = isset($id) && !empty($id) ? PackageSubscription::getAll()->where('id', $id)->first() : null;
        $data['vendors'] = Vendor::getAll();
        $data['payments'] = PaymentMethod::getAll();
        $data['packages'] = Package::getAll();
        $data['digit'] = Preference::getAll()->where('category', 'preference')->pluck('value', 'field')->toArray();
        $data['countries'] = Country::getAll();

        return view('admin.package_subscription.edit', $data);
    }

    /**
     * Update
     * @param  Request $request
     * @param  string  $id
     * @return \Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id = null)
    {
        $response = ['status' => 'fail', 'message' => __('Invalid Request')];

        if (isset($request->billing_cycle) && array_key_exists(strtolower($request->billing_cycle), ['monthly' => 'monthly', 'yearly' => 'yearly'])) {
            $request['billing_cycle'] = strtolower($request->billing_cycle);
        }
        if (isset($request->status) && array_key_exists(strtolower($request->status), ['pending' => 'pending', 'expired' => 'expired', 'active' => 'active', 'paused' => 'paused'])) {
            $request['status'] = strtolower($request->status);
        }

        $result = $this->checkExistance($id, 'package_subscriptions');
        if ($result['status'] === true) {
            $request['activation_date'] = DbDateFormat($request->activation_date);
            $request['billing_date'] = DbDateFormat($request->billing_date);
            $request['next_billing_date'] = DbDateFormat($request->next_billing_date);
            $request['customized_records'] = empty($request->is_customized) ? null : $request->customized_records;
            $validator =  PackageSubscription::updateValidation($request->all(), $id);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            $response = (new PackageSubscription)->updatePackage($request->all(), $id);
        } else {
            $response['message'] = $result['message'];
        }

        $this->setSessionValue(['status' => $response['status'], 'message' => $response['message']]);
        return redirect()->route('packageSubscription.index');
    }

    /**
     * Delete
     * @param  string $id
     * @return \Illuminate\Routing\Redirector
     */
    public function destroy($id = null)
    {
        $response = ['status' => 'fail', 'message' => __('Invalid Request')];

        $result = $this->checkExistance($id, 'package_subscriptions');
        if ($result['status'] === true) {
            $response = (new PackageSubscription)->remove($id);
        } else {
            $response['message'] = $result['message'];
        }

        $this->setSessionValue(['status' => $response['status'], 'message' => $response['message']]);
        return redirect()->route('packageSubscription.index');
    }

    /**
     * Package Subscription list pdf
     * @return html static page
     */
    public function pdf()
    {
        $data['subscriptions'] = PackageSubscription::getAll();
        $data['digit'] = Preference::getAll()->where('category', 'preference')->pluck('value', 'field')->toArray();

        return printPDF(
            $data,
            'package_subscription_list' . time() . '.pdf',
            'admin.package_subscription.list_pdf',
            view('admin.package_subscription.list_pdf', $data),
            'pdf',
            'domPdf'
        );
    }

    /**
     * Package list csv
     * @return html static page
     */

    public function csv()
    {
        return Excel::download(new PackageSubscriptionListExport(), 'package_subscription_list' . time() . '.csv');
    }
}
