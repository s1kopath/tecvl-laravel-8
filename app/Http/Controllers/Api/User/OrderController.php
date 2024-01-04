<?php
/**
 * @package OrderController
 * @author techvillage <support@techvill.org>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @created 27-01-2022
 */
namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Modules\Commission\Http\Models\Commission;
use Modules\Commission\Http\Models\OrderCommission;
use App\Http\Resources\{
    OrderDetailResource,
    OrderResource,
};
use App\Models\{Address,
    Country,
    Currency,
    Inventory,
    ItemDetail,
    Order,
    OrderDetail,
    OrderStatus,
    Preference,
    Wishlist};
use Illuminate\Http\Request;
use Cart;
use Auth;
use DB;

class OrderController extends Controller
{
    /**
     * User orders
     * @param Request $request
     * @return json $data
     */
    public function index(Request $request)
    {
        $configs = $this->initialize([], $request->all());
        $order = Order::where('user_id', auth()->guard('api')->user()->id);

        $reference = isset($request->invoice) ? $request->invoice : null;
        if (!empty($reference)) {
            $order->where('reference', $reference);
        }

        $date = isset($request->created_at) ? $request->created_at : null;
        if (!empty($date)) {
            $order->where('created_at', $date);
        }

        $price = isset($request->price) ? $request->price : null;
        if (!empty($price)) {
            $order->where('price', $price);
        }

        $status = isset($request->status) ? $request->status : null;
        if (!empty($status)) {
            $order->where('status', $status);
        }

        $keyword = isset($request->keyword) ? $request->keyword : null;
        if (!empty($keyword)) {
            if (is_int($keyword)) {
                $order->where(function ($query) use ($keyword) {
                    $query->where('id', $keyword)
                        ->orwhere('price', 'LIKE', "%" . $keyword . "%")
                        ->orwhere('reference', 'LIKE', "%" . $keyword . "%");
                });
            } else if (strlen($keyword) >= 2) {
                $order->where(function ($query) use ($keyword) {
                    $query->where('reference', 'LIKE', "%" . $keyword . "%")
                        ->orwhere('price', 'LIKE', "%" . $keyword . "%")
                        ->orwhere('status', $keyword);
                });
            }
        }
        return $this->response([
            'data' => OrderResource::collection($order->paginate($configs['rows_per_page'])),
            'pagination' => $this->toArray($order->paginate($configs['rows_per_page'])->appends($request->all()))
        ]);
    }

    /**
     * Delete wishlist
     * @param int $id
     * @return json $response
     */
    public function details($id)
    {
        $userId = auth()->guard('api')->user()->id;
        $response = $this->checkExistance($id, 'orders');
        if ($response['status']) {
            return $this->response([
                'data' => new OrderDetailResource(Order::where('id', $id)->where('user_id', $userId)->first())
            ]);
        }
        return $this->response([], 204, $response['message']);
    }

    /**
     * order store
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $detailData = [];
        $cartData = Cart::selectedCartCollection();
        if (is_array($cartData) && count($cartData) > 0) {
            $coupon = [];
            if (isActive('Coupon')) {
                $coupon = Cart::getCouponData();
                if (is_array($coupon) && count($coupon) > 0) {
                    $couponDetails = \Modules\Coupon\Http\Models\Coupon::where('id', $coupon['id'])->first();
                }
            }
            $defaultCurrency = Currency::getDefault();
            $validator = Order::storeValidation($request->all());
            if ($validator->fails()) {
                return $this->unprocessableResponse($validator->messages());
            }
            $orderStatus = OrderStatus::getAll()->where('is_default', 1)->first();
            $preference = Preference::getAll()->pluck('value', 'field')->toArray();
            $reference = Order::getOrderReference($preference['invoice_prefix'] ?? null);
            $userId = auth()->guard('api')->user()->id;
            $order['reference'] = $reference;
            $order['transaction_type'] = "SALESINVOICE";
            $order['invoice_type'] = "quantity";
            $order['order_type'] = "Direct Order";
            $order['user_id'] = $userId;
            $order['tax_type'] = "exclusive";
            $order['order_date'] = DbDateFormat(date('Y-m-d'));
            $order['payment_method_id'] = $request->payment_method_id;
            $order['address_id'] = $request->address_id;
            $order['discount_on'] = "before";
            $order['currency_id'] = $defaultCurrency->id;
            $order['exchange_rate'] = $defaultCurrency->exchange_rate;
            $couponDiscount = $coupon['calculated_discount'] ?? 0;
            if (isset($couponDetails)) {
                $order['other_discount_amount'] = $coupon['calculated_discount'] ?? null;
                $order['other_discount_type'] = $coupon['discount_type'] ?? null;
                $order['total'] = Cart::totalPrice('selected') - $couponDiscount;
            } else {
                $order['total'] = Cart::totalPrice('selected');
            }
            $order['total_quantity'] = Cart::totalQuantity('selected');
            $order['paid'] = 0;
            $order['amount_received'] = 0;
            $order['order_status_id'] = $orderStatus->id;

            try {
                DB::beginTransaction();
                $orderId = (new Order)->store($order);
                if (!empty($orderId)) {
                    foreach ($cartData as $key => $cart) {
                        if ($cart['option_id']) {
                            $itemOption = [
                                'item_option_id' => json_decode($cart['option_id']),
                                'option_name' => json_decode($cart['option_name']),
                                'options' => json_decode($cart['option']),
                            ];

                            /*Check Inventory & update*/
                            $itemDetails = ItemDetail::where('item_id', $cart['id'])->first();
                            if (!empty($itemDetails) && $itemDetails->is_track_inventory == 1) {
                                foreach ($itemOption['item_option_id'] as $opKey => $optionId) {
                                    $inventory = Inventory::where('item_option_id', $optionId)->where('label', $itemOption['options'][$opKey])->first();
                                    if (!empty($inventory) && $inventory->quantity >= $cart['quantity']) {
                                        (new Inventory)->updateInventory(['quantity' => $inventory->quantity - $cart['quantity']], $inventory->id);
                                    } else {
                                        DB::rollBack();
                                        return $this->errorResponse([], 500, __('Invalid Order!'));
                                    }
                                }
                            }
                            /*End Inventory & update*/
                        }
                        $detailData[] = [
                            'item_id' => $cart['id'],
                            'order_id' => $orderId,
                            'vendor_id' => $cart['vendor_id'],
                            'shop_id' => $cart['shop_id'],
                            'item_name' => $cart['name'],
                            'price' => $cart['price'],
                            'quantity_sent' => 0,
                            'quantity' => $cart['quantity'],
                            'discount_amount' => $cart['discount_amount'],
                            'discount_type' => $cart['discount_type'],
                            'order_status_id' => $orderStatus->id,
                            'payloads' => isset($itemOption) ? json_encode($itemOption) : null,
                            'order_by' => $key,
                        ];
                    }
                    (new OrderDetail)->store($detailData);

                    //commission
                    $commission = Commission::getAll()->first();
                    if (!empty($commission) && $commission->is_active == 1) {
                        $orderDetails = OrderDetail::where('order_id', $orderId)->get();
                        $orderCommission = [];
                        foreach ($orderDetails as $details) {
                            if (isset($details->vendor->sell_commissions) && optional($details->vendor)->sell_commissions > 0) {
                                $orderCommission[] = [
                                    'order_details_id' => $details->id,
                                    'category_id' => null,
                                    'vendor_id' => $details->vendor_id,
                                    'amount' => $details->vendor->sell_commissions,
                                    'status' => 'Pending',
                                ];
                            } elseif ($commission->is_category_based == 1 && isset($details->itemCategory->category->sell_commissions) && !empty($details->itemCategory->category->sell_commissions) && $details->itemCategory->category->sell_commissions > 0) {
                                $orderCommission[] = [
                                    'order_details_id' => $details->id,
                                    'category_id' => $details->itemCategory->category_id,
                                    'vendor_id' => null,
                                    'amount' => $details->itemCategory->category->sell_commissions,
                                    'status' => 'Pending',
                                ];
                            } else {
                                $orderCommission[] = [
                                    'order_details_id' => $details->id,
                                    'category_id' => $details->itemCategory->category_id ?? null,
                                    'vendor_id' => $details->vendor_id ?? null,
                                    'amount' => $commission->amount,
                                    'status' => 'Pending',
                                ];
                            }
                        }
                        if (is_array($orderCommission) && count($orderCommission) > 0) {
                            (new OrderCommission)->store($orderCommission);
                        }
                    }
                    //end commission
                    if (isActive('Coupon')) {
                        if (is_array($coupon) && count($coupon) > 0) {
                            $couponRedem['coupon_id'] = $coupon['id'];
                            $couponRedem['user_id'] = Auth::user()->id;
                            $couponRedem['order_id'] = $orderId;
                            $couponRedem['discount_amount'] = $coupon['calculated_discount'];
                            (new \Modules\Coupon\Http\Models\CouponRedeem)->store($couponRedem);
                        }
                    }
                    DB::commit();
                    Cart::selectedCartItemDestroy();
                    return $this->okResponse([], __('The :x has been successfully saved.', ['x' => __('Order')]));
                }
            } catch (Exception $e) {
                DB::rollBack();
                return $this->errorResponse([], 500, $e->getMessage());
            }
        }
        return $this->errorResponse([]);
    }

    /**
     * order checkout
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function checkOut()
    {
        $data['selectedTotal'] = Cart::totalPrice('selected');
        $hasCart = Cart::selectedCartCollection();
        if (is_array($hasCart) && count($hasCart) > 0) {
            $data['addresses'] = Address::getAll();
            $data['defaultAddresses'] = Address::getAll()->where('is_default', 1)->first();
            $data['countries'] = Country::getAll();
            if (isActive('Coupon')) {
                $data['coupon'] = Cart::getCouponData();
            }
            return $this->response($data);
        }
        return $this->errorResponse([]);
    }
}
