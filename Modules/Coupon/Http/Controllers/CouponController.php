<?php
/**
 * @package CouponController
 * @author techvillage <support@techvill.org>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @created 18-11-2021
 */

namespace Modules\Coupon\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Item;
use Modules\Coupon\DataTables\CouponDataTable;
use Modules\Coupon\Http\Models\Coupon;
use Modules\Coupon\Exports\CouponListExport;
use App\Models\Vendor;
use Excel;
use Modules\Coupon\Http\Models\ItemCoupon;

class CouponController extends Controller
{
    /**
     * Coupon List
     * @param CouponDataTable $dataTable
     * @return Renderable
     */
    public function index(CouponDataTable $dataTable)
    {
        return $dataTable->render('coupon::index');
    }

    /**
     * Create.
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $data['vendors'] = Vendor::getAll()->where('status', 'Active');
        $data['shops'] = \Modules\Shop\Http\Models\Shop::getAll()->where('status', 'Active');
        return view('coupon::create', $data);
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
        $validator =  Coupon::storeValidation($request->all());
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $request['start_date'] = DbDateFormat($request->start_date);
        $request['end_date'] = DbDateFormat($request->end_date);

        $couponId = (new Coupon)->store($request->only('name', 'vendor_id', 'shop_id', 'usage_limit', 'code', 'discount_type', 'minimum_spend', 'discount_amount', 'maximum_discount_amount', 'start_date', 'end_date', 'status'));
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
        return redirect()->route('coupon.index');
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
            $data['coupon'] = $result['data'];
            $data['vendors'] = Vendor::getAll()->where('status', 'Active');
            $data['shops'] = \Modules\Shop\Http\Models\Shop::getAll()->where('status', 'Active');
            return view('coupon::edit', $data);
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
        return redirect()->route('coupon.index');
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
        return redirect()->route('coupon.index');
    }

    /**
     * Coupon list pdf
     * @return html static page
     */
    public function downloadPdf()
    {
        $data['coupons'] = Coupon::getAll();

        return printPDF($data, 'coupon_list' . time() . '.pdf', 'coupon::pdf', view('coupon::pdf', $data), 'pdf', 'domPdf');
    }

    /**
     * Coupon list csv
     * @return html static page
     */
    public function downloadCsv()
    {
        return Excel::download(new CouponListExport(), 'shop_list' . time() . '.csv');
    }

    /**
     * vendor shop
     * @return html static page
     */
    public function getShopByVendor($id = null)
    {
        $shops = [];
        if (!is_null($id)) {
            $shops = \Modules\Shop\Http\Models\Shop::getAll()->where('vendor_id', $id);
        }
        return json_encode($shops);
    }

    /**
     * shop item
     * @return html static page
     */
    public function getCouponItem(Request $request, $id = null)
    {
        $data['items'] = [];
        if (!is_null($id)) {
            if (isActive('Shop') ? false : false) {
                $data['items'] = Item::select('id', 'name')->where('shop_id', $id)->get();
            } else {
                $data['items'] = Item::select('id', 'name')->where('vendor_id', $id)->get();
            }
        }
        if (isset($request->coupon_id) && !empty($request->coupon_id)) {
            $data['select'] = [];
            $itemIds = ItemCoupon::select('item_id')->where('coupon_id', $request->coupon_id)->get();
            foreach ($itemIds as $key => $value) {
                $data['select'][] = $value->item_id;
            }
        }

        return json_encode($data);
    }
}
