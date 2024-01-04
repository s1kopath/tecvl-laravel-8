<?php
/**
 * @package CouponController
 * @author techvillage <support@techvill.org>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @created 18-11-2021
 */

namespace Modules\Coupon\Http\Controllers\Vendor;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Coupon\DataTables\VendorCouponDataTable;
use Modules\Coupon\Exports\VendorCouponListExport;
use App\Models\{
    Item,
    Vendor,
    VendorUser
};
use Modules\Coupon\Http\Models\{
    ItemCoupon,
    Coupon
};
use Excel;

class CouponController extends Controller
{
    /**
     * Coupon List
     * @param VendorCouponDataTable $dataTable
     * @return Renderable
     */
    public function index(VendorCouponDataTable $dataTable)
    {
        return $dataTable->render('coupon::vendor.index');
    }

    /**
     * Create.
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        if (isActive('Shop')) {
            $data['shops'] = \Modules\Shop\Http\Models\Shop::getAll()->where('vendor_id', session()->get('vendorId'))->where('status', 'Active');
        }
        $data['items'] = Item::select('id', 'name')->where('vendor_id', session()->get('vendorId'))->get();
        return view('coupon::vendor.create', $data);
    }

    /**
     * Store
     * @param  Request $request
     * @return \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        if ($request->discount_type <> 'Percentage') {
            $request['maximum_discount_amount'] = null;
        }
        $request['shop_id'] = isActive('Shop') ? $request['shop_id'] : null;
        $request['vendor_id'] = session()->get('vendorId');
        $validator =  Coupon::storeValidation($request->all());
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $request['start_date'] = DbDateFormat($request->start_date);
        $request['end_date'] = DbDateFormat($request->end_date);

        $couponId = (new Coupon)->store($request->only('name', 'vendor_id', 'shop_id', 'usage_limit', 'code', 'minimum_spend', 'discount_type', 'discount_amount', 'maximum_discount_amount', 'start_date', 'end_date', 'status'));
        if ($couponId) {
            $itemCoupon = [];
            if (!empty($request->item_ids)) {
                foreach ($request->item_ids as $item_id) {
                    $itemCoupon[] = ['coupon_id' => $couponId, 'item_id' => $item_id];
                }
            }
            if (!empty($itemCoupon)) {
                (new ItemCoupon)->store($itemCoupon);
            }
            $data = ['status' => 'success', 'message' => __('The :x has been successfully saved.', ['x' => __('Coupon')])];
        } else {
            $data = ['status' => 'fail', 'message' => __('Something went wrong, please try again.')];
        }

        $this->setSessionValue($data);
        return redirect()->route('vendor.coupons');
    }

    /**
     * Edit
     * @param  string $id
        * @return \Illuminate\Contracts\View\View
     */
    public function edit($id = null)
    {
        $result = $this->checkExistance($id, 'coupons', ['getData' => true]);
        if ($result['status'] == true) {
            $data['coupon'] = Coupon::getAll()->where('id', $id)->first();
            $data['items'] = Item::select('id', 'name')->where('vendor_id', session()->get('vendorId'))->get();
            if (isActive('Shop')) {
                $data['shops'] = \Modules\Shop\Http\Models\Shop::getAll()->where('vendor_id', session()->get('vendorId'))->where('status', 'Active');
                if (!empty($data['coupon']->shop_id)) {
                    $data['items'] = Item::select('id', 'name')->where('shop_id', $data['coupon']->shop_id)->get();
                }
            }

            return view('coupon::vendor.edit', $data);
        }

        $this->setSessionValue(['status' => 'fail', 'message' => $result['message']]);
        return back();
    }

    /**
     * Update
     * @param  Request $request
     * @param  string  $id
     * @return \Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $result = $this->checkExistance($id, 'coupons');
        if ($result['status'] === true) {
            if ($request->discount_type <> 'Percentage') {
                $request['maximum_discount_amount'] = null;
            }
            $request['shop_id'] = isActive('Shop') ? $request['shop_id'] : null;
            $request['vendor_id'] = VendorUser::where('user_id', \Auth::user()->id)->first()->vendor_id ?? null;
            $validator =  Coupon::updateValidation($request->all(), $id);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
            $request['start_date'] = DbDateFormat($request->start_date);
            $request['end_date'] = DbDateFormat($request->end_date);
            $response = (new Coupon)->updateData($request->all(), $id);
            $itemCoupon = [];
            if (!empty($request->item_ids)) {
                foreach ($request->item_ids as $item_id) {
                    $itemCoupon[] = ['coupon_id' => $id, 'item_id' => $item_id];
                }
            }

            (new ItemCoupon)->updateData($itemCoupon, $id);
        } else {
            $response = ['status' => 'fail', 'message' =>$result['message']];
        }

        $this->setSessionValue($response);
        return redirect()->route('vendor.coupons');
    }

    /**
     * Delete
     * @param  string $id
     * @return \Illuminate\Routing\Redirector
     */
    public function destroy($id = null)
    {
        $result = $this->checkExistance($id, 'coupons');
        if ($result['status'] === true) {
            $response = (new Coupon)->remove($id);
        } else {
            $response = ['status' => 'fail', 'message' => $result['message']];
        }

        $this->setSessionValue($response);
        return redirect()->route('vendor.coupons');
    }

    /**
     * Coupon list pdf
     * @return html static page
     */
    public function pdf()
    {
        $data['coupons'] = Coupon::getAll()->where('vendor_id', session()->get('vendorId'));

        return printPDF($data, 'coupon_list' . time() . '.pdf', 'coupon::vendor.pdf', view('coupon::vendor.pdf', $data), 'pdf', 'domPdf');
    }

    /**
     * Coupon list csv
     * @return html static page
     */
    public function csv()
    {
        return Excel::download(new VendorCouponListExport(), 'shop_list' . time() . '.csv');
    }

    /**
     * shop item
     * @return html static page
     */
    public function item($id = null)
    {
        $data['items'] = Item::select('id', 'name')->where('shop_id', $id)->get();
        if ($id == 0) {
            $data['items'] = Item::select('id', 'name')->where('vendor_id', session()->get('vendorId'))->get();
        }
        return json_encode($data);
    }
}
