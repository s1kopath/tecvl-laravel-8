<?php

/**
 * @package UserRefundController
 * @author techvillage <support@techvill.org>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @created 24-02-2022
 */
namespace Modules\Refund\Http\Controllers\Site;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderDetail;
use Modules\Refund\Entities\{
    Refund,
    RefundProcess,
    RefundReason
};

class RefundController extends Controller
{
    /**
     * Refund List
     * @return Renderable
     */
    public function index(Request $request)
    {
        $refunds = Refund::where('user_id', auth()->user()->id)->with(['orderDetail', 'refundReason']);

        $filterDay = ['today' => today(), 'last_week' => now()->subWeek(), 'last_month' => now()->subMonth(), 'last_year' => now()->subYear()];
        if (isset($request->filter_day) && array_key_exists($request->filter_day, $filterDay)) {
            $refunds->whereDate('created_at', '>=', $filterDay[$request->filter_day]);
        }
        if (isset($request->filter_status) && $request->filter_status != 'All Status') {
            $refunds->where('status', $request->filter_status);
        }

        $data['refunds'] = $refunds->paginate(preference('row_per_page'));
        return view('refund::site.index', $data);
    }

    /**
     * order refund
     * @param Request $request
     * @return view|\Illuminate\Routing\Redirector
     */
    public function refund(Request $request)
    {

        $response = OrderDetail::find($request->order_detail_id);
        if (!empty($response)) {
            $request['user_id'] = auth()->user()->id;
            $request['refund_type'] = $response->quantity == $request->quantity_sent ? 'Full' : 'Partial';
            $request['refund_method'] = 'Wallet';
            $request['shipping_method'] = $response->shipping->name;
            $request['payment_status'] = $response->order->total == $response->order->paid ? 'Paid' : 'Unpaid';
            $request['reference'] = \Str::random(6);
            $request['status'] = 'Opened';

            $validator = Refund::storeValidation($request->all());
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            if ($response->quantity < $request->quantity_sent) {
                return back()->withErrors(__('You exceeded the maximum quantity.'));
            }

            $this->setSessionValue((new Refund)->store($request->all()));
            if (isset($request->type) && $request->type == 'admin') {
                return redirect()->back();
            }
            return redirect()->route('site.refundRequest');
        }
        $this->setSessionValue(['status' => 'fail', 'message' => __('Something went wrong, please try again.')]);
        return redirect()->back();

    }

    public function createRequest(){
        $data['orders'] = Refund::getOrders();
        $data['reasons'] = RefundReason::getAll();
        return view('refund::site.create-refund-request', $data);
    }

    /**
     * order refund details
     * @param int $id
     * @return view|\Illuminate\Routing\Redirector
     */
    public function refundDetails($id = null)
    {
        if (is_null($id)) {
            return redirect()->back()->withErrors(__('Refund not found.'));
        }

        $data['refund'] = Refund::where(['user_id' => auth()->user()->id, 'id' => $id])->with(['orderDetail', 'refundReason'])->first();
        $data['refundProcesses'] = RefundProcess::where(['refund_id' => $id])->orderByDesc('id')->with(['user'])->get();
        if (empty($data['refund'])) {
            return redirect()->back()->withErrors(__('Refund not found.'));
        }
        return view('refund::site.refund-details', $data);
    }

    /**
     * Get refund items with order reference
     * @param int $reference
     * @return response $orderDetail
     */
    public function getItems($reference = null)
    {
        return json_encode(Refund::getItems($reference));
    }
}
