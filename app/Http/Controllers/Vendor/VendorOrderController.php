<?php
/**
 * @package VendorOrderController
 * @author techvillage <support@techvill.org>
 * @contributor Sakawat Hossain Rony <[sakawat.techvill@gmail.com]>
 * @created 19-01-2022
 */
namespace App\Http\Controllers\Vendor;

use App\DataTables\VendorOrderDataTable;
use App\Exports\VendorOrderListExport;
use App\Http\Controllers\Controller;
use App\Models\{
    Order,
    OrderDetail,
    OrderStatus,
    OrderStatusHistory,
    OrderStatusRole
};
use Illuminate\Http\Request;
use Excel;
use DB;
use Auth;

class VendorOrderController extends Controller
{
    /**
     * vendor order list
     *
     * @param VendorOrderDataTable $dataTable
     * @return mixed
     */
    public function index(vendorOrderDataTable $dataTable)
    {
        $data['statuses'] = OrderStatus::getAll()->sortBy('order_by');
        return $dataTable->render('vendor.orders.index', $data);
    }

    /**
     * vendor order view
     *
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function view($id)
    {
        $vendorId = session()->get('vendorId');
        $order = Order::where('id', $id)->where('id', $id)->whereHas("orderDetails", function ($q) use ($vendorId) {
        $q->where('vendor_id', $vendorId);
       })->with('orderDetails')->first();
        if (!empty($order)) {
            $data['order'] = $order;
            $data['vendorId'] = $vendorId;
            $data['finalOrderStatus'] = Order::getFinalOrderStatus();
            $data['orderStatus'] = OrderStatus::orderBy('order_by', 'ASC')->get();
            return view('vendor.orders.view', $data);
        }
        return redirect()->back();
    }

    /**
     * change status
     *
     * @param Request $request
     * @return array
     */
    public function changeStatus(Request $request)
    {
        $finalOrderStatus = Order::getFinalOrderStatus();
        $orderDetail = OrderDetail::where('id', $request->data['id'])->where('vendor_id', session()->get('vendorId'))->first();
        $data['status'] = 0;
        if (!empty($orderDetail) && $this->isOrderStatusEnable($request->data['status_id']) == true) {
            try {
                DB::beginTransaction();
                if ($request->data['status_id'] != $finalOrderStatus || $request->data['status_id'] == $finalOrderStatus  && optional($orderDetail->order)->payment_status == "Paid") {
                    if ($orderDetail->is_delivery != 1 && OrderStatus::vendorStatusPermission($request->data['status_id'])) {
                        (new OrderDetail)->updateOrder(['order_status_id' => $request->data['status_id']], $orderDetail->id);
                        $history['user_id'] = Auth::user()->id;
                        $history['order_id'] = $orderDetail->order_id;
                        $history['item_id'] = $orderDetail->item_id;
                        $history['order_status_id'] = $request->data['status_id'];
                        (new OrderStatusHistory)->store($history);
                        $checkAllStatus = OrderDetail::where('order_id', $orderDetail->order_id)->pluck('order_status_id')->toArray();
                        $checkAllStatus = array_unique($checkAllStatus);
                        if (count($checkAllStatus) == 1) {
                            if(isset($checkAllStatus[0])) {
                                $order = Order::where('id', $orderDetail->order_id)->first();
                                if ($order->order_status_id != $checkAllStatus[0]) {
                                    (new Order)->updateOrder(['order_status_id' => $checkAllStatus[0]], $orderDetail->order_id);
                                    $history = [];
                                    $history['order_id'] = $orderDetail->order_id;
                                    $history['note'] = "Auto";
                                    $history['order_status_id'] = $request->data['status_id'];
                                    (new OrderStatusHistory)->store($history);
                                }
                            }
                        }
                        //commission
                        if (isActive('Commission')) {
                            (new order)->orderCommission($orderDetail->id, $request->data['status_id']);
                        }
                        $data['status'] = 1;
                    }
                } else {
                    $data['error'] = __("Please paid for reached the final status!");
                }
                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
                $data['error'] = __('Something went wrong, please try again.');
            }
        }
        if ($data['status'] == 0 && !isset($data['error'])) {
            $data['error'] = __('Something went wrong, please try again.');
        }
        return $data;
    }

    /**
     * check vendor order status
     *
     * @param $statusId
     * @return bool
     */
    public function isOrderStatusEnable($statusId)
    {
        $orderStatus = OrderStatusRole::getAll()->where('role_id', 2)->pluck('order_status_id')->toArray();
        if (!empty($orderStatus)) {
            return in_array($statusId, $orderStatus);
        }
        return false;
    }

    /**
     * order list pdf
     * @return html static page
     */
    public function pdf()
    {
        $vendorId = session()->get('vendorId');
        $data['orders'] = Order::whereHas("orderDetails", function ($q) use ($vendorId) {
            $q->where('vendor_id', $vendorId);
        })->with('orderDetails')->get();

        return printPDF(
            $data,
            'order_lists' . time() . '.pdf',
            'vendor.orders.pdf',
            view('vendor.orders.pdf', $data),
            'pdf',
            'domPdf'
        );
    }

    /**
     * order list csv
     * @return html static page
     */
    public function csv()
    {
        return Excel::download(new VendorOrderListExport(), 'order_lists' . time() . '.csv');
    }

    /**
     * order invoice print
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|void
     */
    public function invoicePrint(Request $request, $id)
    {
        $vendorId = session()->get('vendorId');
        $order = Order::where('id', $id)->where('id', $id)->whereHas("orderDetails", function ($q) use ($vendorId) {
            $q->where('vendor_id', $vendorId);
        })->with('orderDetails')->first();
        if (!empty($order)) {
            $data['order'] = $order;
            $data['vendorId'] = $vendorId;
            $data['orderStatus'] = OrderStatus::getAll()->sortBy('order_by');
            $data['type'] = request()->get('type') == 'print' || request()->get('type') == 'pdf' ? request()->get('type') : 'print';
            if ($data['type'] == 'pdf') {
                return printPDF($data, 'invoice_' . time() . '.pdf', 'vendor.orders.invoice_print', view('vendor.orders.invoice_print', $data), $data['type']);
            } else {
                return view('vendor.orders.invoice_print', $data);
            }
        }
        return redirect()->route('vendorOrder.index');
    }
}
