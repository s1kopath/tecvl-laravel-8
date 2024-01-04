<?php
/**
 * @package PackageController
 * @author techvillage <support@techvill.org>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @created 31-08-2021
 * @modified 30-09-2021
 */

namespace App\Http\Controllers;

use App\Exports\PackageListExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\PackageDataTable;
use App\Models\{
    Package,
    Preference
};
use Excel;

class PackageController extends Controller
{
    /**
     * Package
     * @param  PackageDataTable $dataTable
     * @return \Illuminate\Contracts\View\View
     */
    public function index(PackageDataTable $dataTable)
    {
        return $dataTable->render('admin.package.index');
    }

    /**
     * Create
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.package.create');
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
        if (isset($request->status) && array_key_exists(strtolower($request->status), ['pending' => 'pending', 'inactive' => 'inactive', 'active' => 'active'])) {
            $request['status'] = strtolower($request->status);
        }
        $validator =  Package::storeValidation($request->all());
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if ((new Package)->store($request->only('name', 'code', 'description', 'params', 'price', 'billing_cycle', 'is_private', 'status'))) {
            $data['status'] = 'success';
            $data['message'] = __('The :x has been successfully saved.', ['x' => __('Package')]);
        } else {
            $data['message'] = __('Something went wrong, please try again.');
        }

        $this->setSessionValue(['status' => $data['status'], 'message' => $data['message']]);
        return redirect()->route('package.index');
    }

    /**
     * Edit
     * @param  string $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id = null)
    {
        $data['package'] = isset($id) && !empty($id) ? Package::getAll()->where('id', $id)->first() : null;
        $data['digit'] = Preference::getAll()->where('category', 'preference')->pluck('value', 'field')->toArray();

        return view('admin.package.edit', $data);
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
        if (isset($request->status) && array_key_exists(strtolower($request->status), ['pending' => 'pending', 'inactive' => 'inactive', 'active' => 'active'])) {
            $request['status'] = strtolower($request->status);
        }

        $result = $this->checkExistance($id, 'packages');
        if ($result['status'] === true) {
            $validator =  Package::updateValidation($request->all(), $id);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
            $response = (new Package)->updatePackage($request->all(), $id);
        } else {
            $response['message'] = $result['message'];
        }


        $this->setSessionValue(['status' => $response['status'], 'message' => $response['message']]);
        return redirect()->route('package.index');
    }

    /**
     * Delete
     * @param  Request $request
     * @param  string $id
     * @return \Illuminate\Routing\Redirector
     */
    public function destroy($id = null)
    {
        $response = ['status' => 'fail', 'message' => __('Invalid Request')];

        $result = $this->checkExistance($id, 'packages');
        if ($result['status'] === true) {
            if ((new Package)->isPackageUsed($id)) {
                $response['message'] = __('Package already used.');
            } else {
                $response = (new Package)->remove($id);
            }

        } else {
            $response['message'] = $result['message'];
        }

        $this->setSessionValue(['status' => $response['status'], 'message' => $response['message']]);
        return redirect()->route('package.index');
    }

    /**
     * Package list pdf
     * @return html static page
     */
    public function pdf()
    {
        $data['packages'] = Package::getAll();
        $data['digit'] = Preference::getAll()->where('category', 'preference')->pluck('value', 'field')->toArray();

        return printPDF(
            $data,
            'package_list' . time() . '.pdf',
            'admin.package.list_pdf',
            view('admin.package.list_pdf', $data),
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
        return Excel::download(new PackageListExport(), 'package_list' . time() . '.csv');
    }
}
