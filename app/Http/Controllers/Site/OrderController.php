<?php

/**
 * @package OrderController
 * @author techvillage <support@techvill.org>
 * @contributor Sakawat Hossain Rony <[sakawat.techvill@gmail.com]>
 * @created 14-12-2021
 */

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\{Address,
    Country,
    Currency,
    EmailTemplate,
    Inventory,
    Item,
    ItemDetail,
    Language,
    Order,
    OrderDetail,
    OrderStatusHistory,
    PaymentMethod,
    Preference,
    OrderStatus,
    Transaction};
use App\Http\Controllers\EmailController;
use Illuminate\Http\Request;
use Cart, Auth, DB;

use Modules\Coupon\Http\Models\CouponRedeem;
use Modules\Gateway\Facades\GatewayHelper;
use Modules\Gateway\Redirect\GatewayRedirect;

use Modules\Commission\Http\Models\Commission;
use Modules\Commission\Http\Models\OrderCommission;
use Modules\Gateway\Entities\PaymentLog;
use Modules\Shipping\Entities\Shipping;
use PDF;

class OrderController extends Controller
{
    /**
     * address view page
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $orders = Auth::user()->orders();
        $data['statuses'] = OrderStatus::getAll()->sortBy('order_by');
        $data['filterStatus'] = false;
        $filterDay = ['today' => today(), 'last_week' => now()->subWeek(), 'last_month' => now()->subMonth(), 'last_year' => now()->subYear()];
        if (isset($request->filter_day) && array_key_exists($request->filter_day, $filterDay)) {
            $orders->whereDate('order_date', '>=', $filterDay[$request->filter_day]);
        }
        if (isset($request->filter_status)) {
            $orders->where('order_status_id', $request->filter_status);
            $data['filterStatus'] = true;
        }
        $preference = Preference::getAll()->pluck('value', 'field')->toArray();
        $data['orders'] = $orders->paginate($preference['row_per_page']);
        return view('site.order.index', $data);
    }

    /**
     * order checkout
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function checkOut(Request $request)
    {
        /*select all cart item*/
        if (isset($request->select) && $request->select == "all") {
            $allData = Cart::getCartData();
            if (is_array($allData) && count($allData) > 0) {
               $this->checkCartData($allData);
            }
        } else {
            $this->checkCartData(Cart::selectedCartCollection());
        }
        /*end select all cart item*/
        $data['selectedTotal'] = Cart::totalPrice('selected');
        $hasCart = Cart::selectedCartCollection();
        $shipping = 0;
        $tax = 0;
        if (is_array($hasCart) && count($hasCart) > 0) {
            foreach ($hasCart as $key => $cart) {
                $item = ItemDetail::where('item_id', $cart['id'])->first();
                $priceWithQty = $cart['price'] * $cart['quantity'];
                if (isActive('Shipping')) {
                    if (isset($item->shipping)) {
                        if (empty($item->shipping->minimum_amount) || $priceWithQty >= $item->shipping->minimum_amount) {
                            $shipping += $item->shipping->cost;
                        }
                    }
                }

                if (isset($item->tax->tax_rate)) {
                    $taxWithPrice = ($priceWithQty * $item->tax->tax_rate) / 100;
                    $tax += $taxWithPrice;
                }
            }
            $data['addresses'] = Address::getAll()->where('user_id', Auth::user()->id);
            $data['defaultAddresses'] = Address::getAll()->where('user_id', Auth::user()->id)->where('is_default', 1)->first();
            $data['countries'] = Country::getAll();
            $data['tax'] = $tax;
            $data['shipping'] = $shipping;
            if (isActive('Coupon')) {
                $data['coupon'] = Cart::getCouponData();
            }
            return view('site.order.checkout', $data);
        }
        return redirect()->route('site.cart');
    }

    /**
     * check cart data
     *
     * @param $data
     * @return void
     */
    public function checkCartData($data = [])
    {
        $cartKey = [];
        foreach ($data as $key => $cartData) {
            $item = Item::where('id', $cartData['id'])->where('status', 'Active')->first();
            if (empty($item)) {
                Cart::destroy($key);
                continue;
            }
            if(!empty($item) && !empty($item->available_from) && availableFrom($item->available_from) || !empty($item) && empty($item->available_from)) {
                if(!empty($item->available_to) && availableTo($item->available_to) || empty($item->available_to)) {
                    $cartKey[] = $key;
                }
            }
        }
        Cart::selectedStore($cartKey);
    }

    /**
     * order store
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $order = [];
        $detailData = [];
        $cartData = Cart::selectedCartCollection();
        if (is_array($cartData) && count($cartData) > 0) {

            $totalTax = 0;
            $totalShipping = 0;
            $taxShipping = $this->getTaxShipping($cartData);
            $totalTax = $taxShipping['totalTax'];
            $totalShipping = $taxShipping['totalShipping'];
            $coupon = [];
            if (isActive('Coupon')) {
                $coupon = Cart::getCouponData();
                if (is_array($coupon) && count($coupon) > 0) {
                    $couponDetails = \Modules\Coupon\Http\Models\Coupon::where('id', $coupon['id'])->first();
                }
            }
            $defaultCurrency = Currency::getDefault();
            if (isset($request->selected_tab) && $request->selected_tab == 'new') {
                $request['user_id'] = Auth::user()->id;
                $request['is_default'] = isset($request->default_future) && $request->default_future == 'on' ? 1 : 0;
                $validator =  Address::storeValidation($request->all());
                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput();
                }
                $addressId = (new Address)->store($request->only('user_id', 'first_name', 'last_name', 'phone', 'address_1', 'address_2', 'state', 'country', 'city', 'zip', 'is_default', 'type_of_place', 'email'));
            } elseif (isset($request->address_id) && isset($request->selected_tab) && $request->selected_tab == 'old') {
                $defAddress = Address::where('user_id', Auth::user()->id)->where('id', $request->address_id)->first();
                if (!empty($defAddress)) {
                    $addressId = $defAddress->id;
                } else {
                    return back()->withErrors(['error' => __('Address not found.')])->withInput();
                }
            }

            $request['address_id'] = $addressId ?? null;
            $validator = Order::storeValidation($request->all());
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
            $orderStatus = OrderStatus::getAll()->where('is_default', 1)->first();
            $userId = Auth::user()->id;
            $order['transaction_type'] = "SALESINVOICE";
            $order['invoice_type'] = "quantity";
            $order['order_type'] = "Direct Order";
            $order['user_id'] = $userId;
            $order['tax_type'] = "exclusive";
            $order['order_date'] = DbDateFormat(date('Y-m-d'));
            $order['address_id'] = $addressId;
            $order['discount_on'] = "before";
            $order['currency_id'] = $defaultCurrency->id;
            $order['exchange_rate'] = $defaultCurrency->exchange_rate;
            $order['shipping_charge'] = $totalShipping;
            $order['tax_charge'] = $totalTax;
            $couponDiscount = $coupon['calculated_discount'] ?? 0;
            if (isset($couponDetails)) {
                $order['other_discount_amount'] = $coupon['calculated_discount'] ?? null;
                $order['other_discount_type'] = $coupon['discount_type'] ?? null;
                $order['total'] = (Cart::totalPrice('selected') + $totalShipping + $totalTax) - $couponDiscount;
            } else {
                $order['total'] = Cart::totalPrice('selected') + $totalShipping + $totalTax;
            }
            $order['total_quantity'] = Cart::totalQuantity('selected');
            $order['paid'] = 0;
            $order['amount_received'] = 0;
            $order['order_status_id'] = $orderStatus->id;

            $coupon = [];
            if (isActive('Coupon')) {
                $coupon = Cart::getCouponData();
                if (is_array($coupon) && count($coupon) > 0) {
                    $couponDetails = \Modules\Coupon\Http\Models\Coupon::where('id', $coupon['id'])->first();
                }
            }

            $preference = Preference::getAll()->pluck('value', 'field')->toArray();
            $reference = Order::getOrderReference($preference['invoice_prefix'] ?? null);
            $orderStatus = OrderStatus::getAll()->where('is_default', 1)->first();

            $order['reference'] = $reference;

            try {
                DB::beginTransaction();
                $orderId = (new Order)->store($order);
                /* initial history add */
                $history['order_id'] = $orderId;
                $history['order_status_id'] = $orderStatus->id;
                (new OrderStatusHistory)->store($history);
                /* initial history end */
                if (!empty($orderId)) {
                    foreach ($cartData as $key => $cart) {
                        $itemDetails = ItemDetail::where('item_id', $cart['id'])->first();
                        if ($cart['option_id']) {
                            $itemOption = [
                                'item_option_id' => json_decode($cart['option_id']),
                                'option_name' => json_decode($cart['option_name']),
                                'options' => json_decode($cart['option']),
                            ];
                            /*Check Inventory & update*/
                            if (!empty($itemDetails) && $itemDetails->is_track_inventory == 1) {
                                foreach ($itemOption['item_option_id'] as $opKey => $optionId) {
                                    $inventory = Inventory::where('item_option_id', $optionId)->where('label', $itemOption['options'][$opKey])->first();
                                    if (!empty($inventory) && $inventory->quantity >= $cart['quantity']) {
                                        (new Inventory)->updateInventory(['quantity' => $inventory->quantity - $cart['quantity']], $inventory->id);
                                    } else {
                                        DB::rollBack();
                                        $response = $this->messageArray(__('Invalid Order!'), 'fail');
                                        $this->setSessionValue($response);
                                        return redirect()->back();
                                    }
                                }
                            }
                            /*End Inventory & update*/
                        }
                        $shipping = 0;
                        $tax = 0;
                        if (!empty($itemDetails)) {
                            $priceWithQty = $cart['price'] * $cart['quantity'];
                            if (isset($itemDetails->tax->tax_rate)) {
                                $taxWithPrice = ($priceWithQty * $itemDetails->tax->tax_rate) / 100;
                                $tax = $taxWithPrice;
                            }
                            if (isActive('Shipping')) {
                                if (isset($itemDetails->shipping)) {
                                    if (empty($itemDetails->shipping->minimum_amount) || $priceWithQty >= $itemDetails->shipping->minimum_amount) {
                                        $shipping = $itemDetails->shipping->cost;
                                    }
                                }
                            }
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
                            'shipping_id' => $itemDetails->shipping_id,
                            'shipping_charge' => $shipping,
                            'tax_charge' => $tax
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
                    $latestOrder = Order::where('id', $orderId)->where('transaction_type', "SALESINVOICE")->first();

                    session(['redirect_url_success_' . $latestOrder->reference => 'site.orderpaid',]);

                    $route = GatewayRedirect::paymentRoute($latestOrder, $latestOrder->total, $latestOrder->currency->name, $latestOrder->reference, $request);

                    return redirect($route);
                }
            } catch (Exception $e) {
                DB::rollBack();
                return redirect()->back();
            }
        }
        return redirect()->route('site.cart');
    }

    /**
     * calculate tax shipping
     *
     * @param $cartData
     * @return array
     */
    public function getTaxShipping($cartData = [])
    {
        $totalTax = 0;
        $totalShipping = 0;
        foreach ($cartData as $cart) {
            $itemDetails = ItemDetail::where('item_id', $cart['id'])->first();
            if (!empty($itemDetails)) {
                $priceWithQty = $cart['price'] * $cart['quantity'];
                if (isset($itemDetails->tax->tax_rate)) {
                    $taxWithPrice = ($priceWithQty * $itemDetails->tax->tax_rate) / 100;
                    $totalTax += $taxWithPrice;
                }
                if (isActive('Shipping')) {
                    if (isset($itemDetails->shipping)) {
                        if (empty($itemDetails->shipping->minimum_amount) || $priceWithQty >= $itemDetails->shipping->minimum_amount) {
                            $totalShipping += $itemDetails->shipping->cost;
                        }
                    }
                }
            }
        }
        return [
            'totalTax' => $totalTax,
            'totalShipping' => $totalShipping
        ];
    }

    /**
     * order confirmation
     *
     * @param $reference
     * @return void
     */
    public function confirmation($reference)
    {
        $order = Order::where('reference', $reference)->where('transaction_type', "SALESINVOICE")->first();
        if (!empty($order) && isset(Auth::user()->roles[0]->type) && Auth::user()->roles[0]->type == 'global' && Auth::user()->roles[0]->slug == 'super-admin' || !empty($order) && $order->user_id == Auth::user()->id) {
            $data['order'] = $order;
            $data['orderDetails'] = collect($order->orderDetails);
            return view('site.order.confirmation', $data);
        }
        return redirect()->back();
    }

    /**
     * order details
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function orderDetails($reference)
    {
        $order = Order::where('reference', $reference)->where('transaction_type', "SALESINVOICE")->first();
        $data['orderStatus'] = OrderStatus::getAll()->sortBy('order_by');
        if (!empty($order) && isset(Auth::user()->roles[0]->type) && Auth::user()->roles[0]->type == 'global' && Auth::user()->roles[0]->slug == 'super-admin' || !empty($order) && $order->user_id == Auth::user()->id) {
            $data['order'] = $order;
            $data['orderDetails'] = collect($order->orderDetails);
            $data['orderHistories'] = collect($order->orderHistories);
            $shippingIds = $order->orderDetails->pluck('shipping_id')->toArray();
            $data['shippingMethods'] = Shipping::whereIn('id', $shippingIds)->pluck('name')->toArray();
            $data['detailGroups'] = $data['orderDetails']->groupBy('vendor_id');
            return view('site.order.order-details', $data);
        }
        return redirect()->back();
    }

    /**
     * order track
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function track(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('site.order.order-track');
        } else if ($request->isMethod('post')) {
            $order = Order::where('reference', $request->reference)->first();
            $data['orderStatus'] = OrderStatus::getAll()->sortBy('order_by');
            if (!empty($order)) {
                $data['order'] = $order;
                return view('site.order.order-track', $data);
            }
            return view('site.order.order-track');
        }
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function orderPaid(Request $request)
    {
        try {
            $code = bdcrypt($request->code);
            $order = Order::where('reference', $code)->first();
            if (!$order) {
                return redirect()->route('site.cart')->withErrors(__('Order not found.'));
            }
            $log = GatewayHelper::getPaymentLog($code);
            if (!$log) {
                return redirect()->route('site.cart')->withErrors(__('Payment data not found.'));
            }
            if ($log->status == 'completed') {
                $data = json_decode($log->response);
                $order->paid = $data->amount;
                $order->amount_received = $data->amount;
                $order->payment_status = "Paid";
                /*order transaction*/
                $this->transactionStore($order);
                /*order transaction*/
            }
            $order->save();
            return redirect()->route('site.orderConfirm', $order->reference);
        } catch (\Exception $e) {
            return redirect()->route('site.cart')->withErrors($e->getMessage());
        }
    }

    /**
     * Vendor Wise Order Transaction
     *
     * @param $order
     * @return void
     */
    public function transactionStore($order = null)
    {
        $orderData = [];
        if (!empty($order)) {
            foreach ($order->orderDetails->groupBy('vendor_id') as $detail) {
                $vendorId = $detail[0]->vendor_id ?? null;
                $totalPrice = $order->vendorItemPrice($vendorId, $order->id) + $order->vendorItemShippingTax($vendorId, $order->id);
                $discount = 0;
                $couponRedeem = CouponRedeem::where('order_id', $order->id)->first();
                if (!empty($couponRedeem) && optional($couponRedeem->coupon)->vendor_id == $vendorId) {
                    $discount = $couponRedeem->discount_amount;
                }
                $orderData[] = [
                    'user_id' => Auth::user()->id,
                    'currency_id' => $order->currency_id,
                    'order_id' => $order->id,
                    'vendor_id' => $vendorId,
                    'shop_id' => $detail[0]->shop_id ?? null,
                    'exchange_rate' => optional($order->currency)->exchange_rate,
                    'paid_amount' => $totalPrice,
                    'total_amount' => $totalPrice,
                    'discount_amount' => $discount,
                    'transaction_type' => "Order",
                    'transaction_date' => now(),
                    'status' => "Accepted"
                ];
            }
            (new Transaction)->orderTransactionStore($orderData);
        }
    }
    public function orderManage(){
        return view('site.order.order-manage');
    }
}
