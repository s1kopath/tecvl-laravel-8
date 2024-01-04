<?php
/**
 * @package UserRefundController
 * @author techvillage <support@techvill.org>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @created 03-04-2022
 */

namespace Modules\Refund\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Modules\Refund\Entities\Refund;
use Modules\Refund\Entities\RefundProcess;
use Modules\Refund\Http\Resources\UserRefundDetailResource;
use Modules\Refund\Http\Resources\UserRefundResource;

class RefundController extends Controller
{
    /**
     * UserRefund List
     * @param Request $request
     * @return json $data
     */
    public function index(Request $request)
    {
        $configs = $this->initialize([], $request->all());
        $refunds = Refund::where('user_id', auth()->guard('api')->user()->id)->with(['orderDetail', 'refundReason']);
        if ($refunds->count() == 0) {
            return $this->notFoundResponse();
        }
        $invoice = isset($request->invoice) ? $request->invoice : null;
        if (!empty($invoice)) {
            $refunds->whereHas('orderDetail.order', function($q) use ($invoice) {
                $q->where('reference', $invoice);
            });
        }

        $keyword = isset($request->keyword) ? $request->keyword : null;
        if (!empty($keyword)) {
            if (strlen($keyword) >= 3) {
                $refunds->where(function ($query) use ($keyword) {
                    $query->whereHas('orderDetail.order', function($q) use ($keyword) {
                        $q->whereLike('reference', $keyword);
                    });
                });
            }
        }
        return $this->response([
            'data' => UserRefundResource::collection($refunds->paginate($configs['rows_per_page'])),
            'pagination' => $this->toArray($refunds->paginate($configs['rows_per_page'])->appends($request->all()))
        ]);
    }

     /**
     * order refund
     * @param Request $request
     * @return view|\Illuminate\Routing\Redirector
     */
    public function refund(Request $request)
    {
        if ($request->isMethod('get')) {
            $data['orderDetail'] = OrderDetail::where(['id' => $request['id']])->with(['item', 'order'])->first();
            if ($data['orderDetail']) {
                $orderDeliverId = $data['orderDetail']->orderStatus->where('order_by', $data['orderDetail']->orderStatus->max('order_by'))->first()->id;
                if (empty($data['orderDetail']) ||
                    $data['orderDetail']->order_status_id != $orderDeliverId ||
                    $data['orderDetail']->order->user->id != auth()->guard('api')->user()->id ||
                    auth()->guard('api')->user()->refunds()->where('order_detail_id', $data['orderDetail']->id)->count() > 0
                ) {
                    return $this->response([], 204, __('Refund unavailable.'));
                }
                return $this->response([
                    'data' => new UserRefundDetailResource($data['orderDetail'])
                ]);
            }
            return $this->response([], 204, __('Refund unavailable.'));

        } else if ($request->isMethod('post')) {
            $response = OrderDetail::find($request->order_detail_id);
            if (!empty($response)) {
                $orderDeliverId = $response->orderStatus->where('order_by', $response->orderStatus->max('order_by'))->first()->id;
                if (empty($response) ||
                    $response->order_status_id != $orderDeliverId ||
                    $response->order->user->id != auth()->guard('api')->user()->id ||
                    auth()->guard('api')->user()->refunds()->where('order_detail_id', $response->id)->count() > 0
                ) {
                    return $this->unprocessableResponse(__('You are not eligible to send refund request.'));
                }
                $request['user_id'] = auth()->guard('api')->user()->id;
                $request['refund_type'] = $response->quantity == $request->quantity_sent ? 'Full' : 'Partial';
                $request['refund_method'] = 'Wallet';
                $request['shipping_method'] = 'Drop';
                $request['payment_status'] = 'Paid';
                $request['status'] = 'Pending';

                $validator = Refund::storeValidation($request->all());
                if ($validator->fails()) {
                    return $this->unprocessableResponse($validator->messages());
                }

                if ($response->quantity < $request->quantity_sent) {
                    return $this->unprocessableResponse(__('You exceeded the maximum quantity.'));
                }

                $response = (new Refund)->store($request->all());
                if ($response['status'] == 'success') {
                    return $this->okResponse([], $response['message']);
                } else {
                    return $this->unprocessableResponse($response['message']);
                }

            }
            return $this->notFoundResponse();
        }
    }
}
