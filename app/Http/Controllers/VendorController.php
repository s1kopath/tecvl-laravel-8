<?php
/**
 * @package VendorController
 * @author techvillage <support@techvill.org>
 * @contributor Sakawat Hossain Rony <[sakawat.techvill@gmail.com]>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @created 17-08-2021
 * @modified 29-09-2021
 */

namespace App\Http\Controllers;

use App\DataTables\VendorListDataTable;
use App\Exports\VendorListExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\StoreVendorRequest;
use App\Http\Requests\Admin\UpdateVendorRequest;
use App\Models\{
    EmailTemplate,
    File,
    Language,
    Role,
    User,
    Vendor,
    RoleUser,
    VendorUser
};
use Modules\Commission\Http\Models\Commission;
use Modules\Shop\Http\Models\Shop;
use Excel, Cache, Str;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    /**
     * Constructor
     * @param EmailController $email
     */
    public function __construct(EmailController $email)
    {
        $this->email = $email;
    }

    /**
     * Vendor List
     * @param VendorListDataTable $dataTable
     * @return mixed
     */
    public function index(VendorListDataTable $dataTable)
    {

        return $dataTable->render('admin.vendors.index');
    }

    /**
     * Vendor create
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $data['roles'] = Role::getAll()->where('type', 'vendor');
        $data['commission'] = Commission::getAll()->first();
        return view('admin.vendors.create', $data);
    }

    /**
     * Store vendor
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreVendorRequest $request)
    {
        $response = $this->messageArray(__('Invalid Request'), 'fail');
        if ($request->isMethod('post')) {

            $password = $request->password;
            $request['password'] = \Hash::make($request->password);
            $request['email'] = validateEmail($request->email) ? strtolower($request->email) : null;

            try {
                \DB::beginTransaction();
                $vendorId = (new Vendor)->store($request->only('name', 'email', 'phone', 'formal_name', 'website', 'status', 'sell_commissions'));
                $request['vendor_id'] = $vendorId;
                (new Shop)->store($request->only('vendor_id', 'name', 'email', 'website', 'alias', 'phone', 'address'));

                $request['activation_code'] = NULL;
                if ($request->status <> 'Active') {
                    $request['activation_code'] = Str::random(10);
                }

                // Store user information
                $id = (new User)->store($request->only('name', 'email', 'password', 'activation_code', 'status'));
                if (!empty($id)) {
                    $roles = [];
                    foreach ($request->role_ids as $role_id) {
                        $roles[] = ['user_id' => $id, 'role_id' => $role_id];
                    }
                    if (!empty($roles)) {
                        (new RoleUser)->store($roles);
                    }

                    $request['user_id'] = $id;
                    (new VendorUser)->store($request->only('vendor_id', 'user_id', 'status'));

                    if ((isset($request->send_mail) && isset($request->email) && !empty($request->email) && validateEmail($request->email)) || ($request->status != 'Active') &&  validateEmail($request->email)) {
                        // Retrive preference value and field name and language id
                        $prefer = preference();
                        $languageId = Language::getAll()->where('short_name', $prefer['dflt_lang'])->first()->id;

                        // Retrive welcome user email template
                        if ($request->status == 'Active') {
                            $parent = EmailTemplate::getAll()->where('slug', 'user')->where('language_id', $languageId)->first();
                        } else {
                            $parent = EmailTemplate::getAll()->where('slug', 'email-verification')->where('language_id', $languageId)->first();
                        }
                        $emailInfo = !empty($parent) ? $parent : EmailTemplate::getAll()->where('parent_id', $parent->parent_id)->where('language_id', $languageId)->first();

                        $subject =  $emailInfo->subject;
                        $message =  $emailInfo->body;

                        // Replacing template variable
                        // Need to change assigned by whom value with auth user
                        $subject = str_replace('{company_name}', $prefer['company_name'], $subject);
                        $message = str_replace('{user_name}', $request->name, $message);
                        $message = str_replace('{user_id}', $request->email, $message);
                        $message = str_replace('{user_pass}', $password, $message);
                        if ($request->status != 'Active') {
                            $url = route('users.verify', ['code' => $request->activation_code]);
                            $message = str_replace('{verification_url}', $url, $message);
                        } else {
                            $message = str_replace('{company_url}', url('admin/login'), $message);
                        }
                        $message = str_replace('{company_name}', $prefer['company_name'], $message);

                        // Send Mail to the customer
                        $emailResponse = $this->email->sendEmail($request->email, $subject, $message, null, $prefer['company_name']);

                        if ($emailResponse['status'] == false) {
                            \DB::rollBack();
                            return redirect()->back()->withInput()->withErrors(['fail' => $emailResponse['message']]);
                        }
                    }
                }
                \DB::commit();
                $response = $this->messageArray(__('The :x has been successfully saved.', ['x' => __('Vendor')]), 'success');

            } catch (\Exception $e) {
                \DB::rollBack();
                $response['status'] = 'fail';
                $response['message'] = $e->getMessage();
            }
        }
        $this->setSessionValue($response);
        return redirect()->route('vendors.index');
    }

    /**
     * Edit vendor
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit(Request $request, $id)
    {
        $vendor = Vendor::getAll()->where('id', $id)->first();
        if (empty($vendor)) {
            $response = $this->messageArray( __(':x does not exist.', ['x' => __('Vendor')]), 'fail');
            $this->setSessionValue($response);
            return redirect()->route('vendors.index');
        }
        $data['commission'] = Commission::getAll()->first();
        $data['vendors'] = $vendor;
        $data['shops'] = Shop::getAll()->where('vendor_id', $id);
        $data['shop_exist'] = isset($request->shop) && !empty($request->shop) ? $request->shop : null;

        return view('admin.vendors.edit', $data);
    }

    /**
     * Update Vendor
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateVendorRequest $request, $id)
    {
        $response = $this->messageArray(__('Invalid Request'), 'fail');
        if ($request->isMethod('post')) {
            $result = $this->checkExistance($id, 'vendors');
            if ($result['status'] === true) {
                if ((new Vendor)->updateVendor($request->only('name', 'email', 'phone', 'formal_name', 'website', 'status', 'sell_commissions'), $id)) {
                    $response = $this->messageArray(__('The :x has been successfully saved.', ['x' => __('Vendor')]), 'success');
                }
            } else {
                $response['message'] = $result['message'];
            }
        }
        $this->setSessionValue($response);
        if ($request->shop) {
            return redirect()->route('shop.index');
        }
        return redirect()->route('vendors.index');
    }

    /**
     * Remove Vendor
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, $id)
    {
        $response = $this->messageArray(__('Invalid Request'), 'fail');
        if ($request->isMethod('post')) {
            $result = $this->checkExistance($id, 'vendors');
            if ($result['status'] === true) {
                $response = (new Vendor)->remove($id);
            } else {
                $response['message'] = $result['message'];
            }
        }

        $this->setSessionValue($response);
        return redirect()->route('vendors.index');
    }

    /**
     * Vendor list pdf
     * @return html static page
     */
    public function pdf()
    {
        $data['vendors'] = Vendor::getAll();

        return printPDF($data, 'vendors_lists' . time() . '.pdf', 'admin.vendors.list_pdf', view('admin.vendors.list_pdf', $data), 'pdf', 'domPdf');
    }

    /**
     * Vendor list csv
     * @return html static page
     */
    public function csv()
    {
        return Excel::download(new VendorListExport(), 'vendor_lists' . time() . '.csv');
    }
}
