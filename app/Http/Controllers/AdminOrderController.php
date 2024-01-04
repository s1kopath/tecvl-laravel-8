<?php
/**
 * @package AdminOrderController
 * @author tehcvillage <support@techvill.org>
 * @contributor Sakawat Hossain Rony <[sakawat.techvill@gmail.com]>
 * @created 19-01-2022
 */
namespace App\Http\Controllers;

use App\DataTables\OrderDataTable;
use App\Exports\OrderListExport;
use Modules\Refund\Entities\RefundReason;
use App\Models\{Order, OrderDetail, OrderNoteHistory, OrderStatus, OrderStatusHistory, User, Vendor};
use Illuminate\Http\Request;
use Excel;
use Auth;
use DB;
use PDF;

class AdminOrderController extends Controller
{
    /**
     * All orders
     *
     * @param OrderDataTable $dataTable
     * @return mixed
     */
    public function index(OrderDataTable $dataTable)
    {
        $data['statuses'] = OrderStatus::getAll()->sortBy('order_by');
        $data['vendors'] = OrderDetail::select('vendor_id')->distinct()->with('vendor:id,name')->get();
        return $dataTable->render('admin.orders.index', $data);
    }

    /**
     * Order view
     *
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function view($id)
    {
        $order = Order::where('id', $id)->first();
        if (!empty($order)) {
            $data['customers'] = User::where('status', 'Active')->whereHas("roleIds", function ($q) {
                $q->where('role_id', '!=', 2);
            })->with('roleIds')->get();
            $data['orderStatus'] = OrderStatus::getAll()->sortBy('order_by');
            $data['order'] = $order;
            $data['orderDetails'] = $order->orderDetails->groupBy('vendor_id');
            $data['refundReasons'] = RefundReason::where('status', 'Active')->get();
            $data['orderStatusHistories'] = OrderStatusHistory::where('order_id', $id)->whereNotNull('item_id')->get();
            $data['finalOrderStatus'] = OrderStatus::orderBy('order_by', 'DESC')->first()->id;
            $data['orderNotes'] = OrderNoteHistory::where(['order_id' => $id, 'user_id' => auth()->user()->id])->get();
            return view('admin.orders.view', $data);
        }
        return redirect()->back();
    }

    /**
     * change oreder status
     *
     * @param Request $request
     * @return array
     */
    public function changeStatus(Request $request)
    {
        $finalOrderStatus = Order::getFinalOrderStatus();
        if (!isset($request->data['type'])) {
            $order = Order::where('id', $request->data['order_id'])->first();
            $data['status'] = 0;
            if (!empty($order)) {
                try {
                    DB::beginTransaction();
                    if ($request->data['status_id'] != $finalOrderStatus || $request->data['status_id'] == $finalOrderStatus  && $order->payment_status == "Paid") {
                        if ((new Order)->updateOrder(['order_status_id' => $request->data['status_id']], $order->id)) {
                            $orderDetails = OrderDetail::where('order_id', $request->data['order_id'])->get();
                            foreach($orderDetails as $detail) {
                                if (optional($detail->refund)->status != "Completed") {
                                    (new OrderDetail)->updateOrder(['order_status_id' => $request->data['status_id']], $detail->id);
                                    if (isActive('Commission')) {
                                        $order->orderCommission($detail->id, $request->data['status_id']);
                                    }
                                }
                            }
                            $history['user_id'] = Auth::user()->id;
                            $history['order_id'] = $request->data['order_id'];
                            $history['order_status_id'] = $request->data['status_id'];
                            (new OrderStatusHistory)->store($history);
                            $data['status'] = 1;
                        } else {
                            $data['error'] = __('Something went wrong, please try again.');
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
        } elseif (isset($request->data['type']) && $request->data['type'] == 'detail') {
            $orderDetail = OrderDetail::where('id', $request->data['id'])->first();
            $data['status'] = 0;
            if (!empty($orderDetail)) {
                try {
                    DB::beginTransaction();
                    if ($request->data['status_id'] != $finalOrderStatus || $request->data['status_id'] == $finalOrderStatus  && optional($orderDetail->order)->payment_status == "Paid") {
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
        }


        return $data;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function update(Request $request)
    {
        if (isset($request->data['order_id'])) {
            $order = Order::where('id', $request->data['order_id'])->first();
            $data['status'] = 0;
            if (!empty($order)) {
                if (isset($request->data['type'])) {
                    if ($request->data['type'] == 'orderDate') {
                        if ((new Order)->updateOrder(['order_date' => DbDateFormat($request->data['orderDate'])], $order->id)) {
                            $data['status'] = 1;
                        }
                    } elseif ($request->data['type'] == 'userId') {
                        if ((new Order)->updateOrder(['user_id' => $request->data['user_id']], $order->id)) {
                            $data['status'] = 1;
                        }
                    } elseif ($request->data['type'] == 'deliveryDate') {
                        $orderDeliverId = Order::getFinalOrderStatus();
                        $historyId = OrderStatusHistory::where('order_id', $order->id)->where('order_status_id', $orderDeliverId)->whereNull('item_id')->orderBy('id', 'DESC')->first();
                        if (!empty($historyId)) {
                            if ((new OrderStatusHistory)->updateOrder(['created_at' => DbDateFormat($request->data['deliveryDate'])], $historyId->id)) {
                                $data['status'] = 1;
                            }
                        }
                    } elseif ($request->data['type'] == 'note') {
                        $user['user_id'] = auth()->user()->id;
                        $data = array_merge($request->data, $user);

                        $validator = OrderNoteHistory::storeValidation($data);
                        if ($validator->fails()) {
                            $response['status'] = 0;
                            $response['error'] = $validator->errors()->first();
                            return $response;
                        }

                        if ((new OrderNoteHistory)->storeData($data)) {
                            $data['status'] = 1;
                        }
                    } elseif ($request->data['type'] == 'orderAction') {
                        if (isset($request->data['action_val'])) {
                            if ($request->data['action_val'] == 1) {
                                if ((new Order)->sendEmail($order, "customer")) {
                                    $data['status'] = 1;
                                    $data['message'] = __('Email sent successfully');
                                }
                            } elseif ($request->data['action_val'] == 3) {
                                if ((new Order)->sendEmail($order, "vendor")) {
                                    $data['status'] = 1;
                                    $data['message'] = __('Email sent successfully');
                                }
                            }
                        }
                    } elseif ($request->data['type'] == 'payment') {
                        if ((new Order)->updateOrder(['payment_status' => $request->data['payment_status']], $order->id)) {
                            $data['status'] = 1;
                        }
                    }
                }
            }
            if ($data['status'] == 0) {
                $data['error'] = __('Something went wrong, please try again.');
                if (isset($request->data['action_val'])) {
                    if ($request->data['action_val'] == 1 || $request->data['action_val'] == 3) {
                        $data['error'] = __('Email can not be sent, please check email configuration or try again.');
                    }
                }
            }
        }
        return $data;
    }

    /**
     * Order destroy
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $response = $this->messageArray(__('Invalid Request'), 'fail');
        $result = $this->checkExistance($id, 'orders');
        if ($result['status'] === true) {
            $response = (new Order)->remove($id);
        } else {
            $response['message'] = $result['message'];
        }
        $this->setSessionValue($response);
        return redirect()->route('order.index');
    }

    /**
     * order list pdf
     * @return html static page
     */
    public function pdf()
    {
        $data['orders'] = Order::all();

        return printPDF(
            $data,
            'order_lists' . time() . '.pdf',
            'admin.orders.pdf',
            view('admin.orders.pdf', $data),
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
        return Excel::download(new OrderListExport(), 'order_lists' . time() . '.csv');
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
        $order = Order::where('id', $id)->first();
        if (!empty($order)) {
            $data['orderStatus'] = OrderStatus::getAll()->sortBy('order_by');
            $data['order'] = $order;
            $data['orderDetails'] = $order->orderDetails;
            $data['type'] = request()->get('type') == 'print' || request()->get('type') == 'pdf' ? request()->get('type') : 'print';
            if ($data['type'] == 'pdf') {
                return printPDF($data, 'invoice_' . time() . '.pdf', 'admin.orders.invoice_print', view('admin.orders.invoice_print', $data), $data['type']);
            } else {
                return view('admin.orders.invoice_print', $data);
            }
        }
        return redirect()->route('order.index');
    }
}
