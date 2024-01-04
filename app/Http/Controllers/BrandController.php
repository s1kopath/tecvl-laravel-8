<?php

namespace App\Http\Controllers;
/**
 * @package BrandController
 * @author techvillage <support@techvill.org>
 * @contributor Sakawat Hossain Rony <[sakawat.techvill@gmail.com]>
 * @created 26-08-2021
 */
use App\DataTables\BrandListDataTable;
use App\Exports\BrandListExport;
use App\Http\Controllers\Controller;
use App\Models\{
    Brand,
    File,
    Vendor
};
use Illuminate\Http\Request;
use Excel;

class BrandController extends Controller
{
    /**
     * Brand List
     * @param BrandListDataTable $dataTable
     * @return mixed
     */
    public function index(BrandListDataTable $dataTable)
    {
        $data['brandVendors'] = Brand::select('vendor_id')->distinct()->with('vendor:id,name')->get();
        return $dataTable->render('admin.brands.index', $data);
    }

    /**
     * Brand create
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $data['vendors'] = Vendor::getAll()->where('status', 'Active');

        return view('admin.brands.create', $data);
    }

    /**
     * Store Brand
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $response = $this->messageArray(__('Invalid Request'), 'fail');
        if ($request->isMethod('post')) {
            $validator = Brand::storeValidation($request->all());
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
            $request['vendor_id'] = $request->vendor;
            $brandId = (new Brand)->store($request->only('name', 'vendor_id', 'description', 'status'));

            $response = $this->messageArray(__('The :x has been successfully saved.', ['x' => __('Brand')]), 'success');
        }
        $this->setSessionValue($response);
        return redirect()->route('brands.index');
    }

    /**
     * Edit Brand
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        $brand = Brand::getAll()->where('id', $id)->first();
        if (empty($brand)) {
            $response = $this->messageArray(__(':x does not exist.', ['x' => __('Brand')]), 'fail');
            $this->setSessionValue($response);
            return redirect()->route('brands.index');
        }
        $data['brands'] = $brand;
        $data['vendors'] = Vendor::getAll()->where('status', 'Active');

        return view('admin.brands.edit', $data);
    }

    /**
     * Update Brand
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $response = $this->messageArray(__('Invalid Request'), 'fail');
        if ($request->isMethod('post')) {
            $result = $this->checkExistance($id, 'brands');
            if ($result['status'] === true) {
                $validator = Brand::updateValidation($request->all(), $id);
                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput();
                }
                $request['vendor_id'] = $request->vendor;
                if ((new Brand)->updateBrand($request->only('name', 'vendor_id', 'description', 'status'), $id)) {
                    $response = $this->messageArray(__('The :x has been successfully saved.', ['x' => __('Brand')]), 'success');
                }
            } else {
                $response['message'] = $result['message'];
            }
        }
        $this->setSessionValue($response);
        return redirect()->route('brands.index');
    }

    /**
     * Remove Brand
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, $id)
    {
        $response = $this->messageArray(__('Invalid Request'), 'fail');
        if ($request->isMethod('post')) {
            $result = $this->checkExistance($id, 'brands');
            if ($result['status'] === true) {
                $response = (new Brand)->remove($id);
            } else {
                $response['message'] = $result['message'];
            }
        }

        $this->setSessionValue($response);
        return redirect()->route('brands.index');
    }

    /**
     * Brand list pdf
     * @return html static page
     */
    public function pdf()
    {
        $data['brands'] = Brand::getAll();

        return printPDF(
            $data,
            'brands_lists' . time() . '.pdf',
            'admin.brands.list_pdf',
            view('admin.brands.list_pdf', $data),
            'pdf',
            'domPdf'
        );
    }

    /**
     * Brand list csv
     * @return html static page
     */
    public function csv()
    {
        return Excel::download(new BrandListExport(), 'brands_lists' . time() . '.csv');
    }
}
