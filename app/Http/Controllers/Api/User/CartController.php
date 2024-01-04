<?php
/**
 * @package CartController
 * @author techvillage <support@techvill.org>
 * @contributor Sakawat Hossain Rony <[sakawat.techvill@gmail.com]>
 * @created 24-02-2021
 */
namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\{
    Inventory,
    Item,
    ItemDetail,
    ItemOption,
    Vendor
};
use Illuminate\Http\Request;
use Cart;

class CartController extends Controller
{
    /**
     * Calculate price
     */
    protected $extraAmount = 0;

    /**
     * cart view page
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $cartWithIndex = [];
        $selectedCarts =  Cart::getSelected() ?? [];
        $cartsValue = Cart::cartCollection()->sortKeys();
        $totalPrice = 0;
        $selectAllDisable = false;
        foreach ($cartsValue as $key => $val) {
            $totalPrice += in_array($key, $selectedCarts) ? $val['price'] : 0;
            $item = Item::select('id','available_from', 'available_to', 'status')->where('id', $val['id'])->with('itemDetail')->first();
            $availability = 0;
            $inventoryEnable = true;
            if(!empty($item->available_from) && availableFrom($item->available_from) || empty($item->available_from)) {
                if(!empty($item->available_to) && availableTo($item->available_to) || empty($item->available_to)) {
                    if ($item->status == 'Active') {
                        $availability = 1;
                    }
                }
            }
            $optionIds = json_decode($val['option_id']);
            $label = json_decode($val['option']);
            if (optional($item->itemDetail)->is_track_inventory == 1) {
                $inventoryEnable = $this->optionQuantity($optionIds, $label, $val['quantity']);
            }
            if ($inventoryEnable == false || $availability == 0) {
                if ($selectAllDisable == false) {
                    $selectAllDisable = true;
                }
            }
            if(isActive('Shop')) {
                $shop =  \Modules\Shop\Http\Models\Shop::getAll()->where('id', $val['shop_id'])->first();
            }
            $vendors = Vendor::getAll()->where('id', $val['vendor_id'])->first();
            $cartWithIndex[] = [
                'index' => $key,
                'id' => $val['id'],
                'item_code' => $val['item_code'],
                'vendor_id' => $val['vendor_id'],
                'vendor_name' => $vendors->name ?? null,
                'shop_id' => $val['shop_id'],
                'shop_name' => $shop->name ?? null,
                'name' => $val['name'],
                'quantity' => $val['quantity'],
                'price' => $val['price'],
                'actual_price' => $val['actual_price'],
                'photo' => $val['photo'],
                'discount_amount' => $val['discount_amount'],
                'discount_type' => $val['discount_type'],
                'option_id' => $val['option_id'],
                'option_name' => $val['option_name'],
                'option' => $val['option'],
                'availability' => $availability,
                'inventoryEnable' => $inventoryEnable
            ];
        }
        $data['cartData'] = collect($cartWithIndex);
        $data['selectedCarts'] = $selectedCarts;
        $data['selectAllDisable'] = $selectAllDisable;
        if(isActive('Coupon')) {
            $data['coupon'] = Cart::getCouponData();
        }
        $data['totalPrice'] = $totalPrice;

        return $this->response(['data' => $data]);
    }

    /**
     * cart store & increment quantity
     *
     * @param Request $request
     * @return array
     */
    public function store(Request $request)
    {
        $message =  __("Failed to added to cart! try again.");
        $validator = Item::cartStoreValidation($request->all());
        if ($validator->fails()) {
            return $this->unprocessableResponse($validator->messages());
        }
        $item = Item::where('id', $request->item_id)->where('status', 'Active')->first();
        $availability = 0;
        $inventoryEnable = true;
        if(!empty($item->available_from) && availableFrom($item->available_from) || empty($item->available_from)) {
            if(!empty($item->available_to) && availableTo($item->available_to) || empty($item->available_to)) {
                $availability = 1;
            }
        }
        if (!empty($item) && $availability == 1) {
            $options = [];
            $optionIds = [];
            $optionNames = [];
            $optionCheck = [];
            $price = $item->isDiscountable() ? $item->discounted_price : $item->price;
            if (isset($request->cartIndex) && !is_null($request->cartIndex)) {
                $index = $request->cartIndex;
                $request['qty'] = 1;
            } else {
                $optionLabelMerge = null;
                $allOptions = isset($request->options) ? json_decode($request->options) : [];
                $allNoLabelOptions = isset($request->optionNoLabel) ? json_decode($request->optionNoLabel) : [];
                $optionLabel =  count($allOptions) > 0 ? $allOptions : [];
                $optionNoLabel = count($allNoLabelOptions) > 0 ? $allNoLabelOptions : [];
                if (count($optionLabel) > 0 && count($optionNoLabel) > 0 ) {
                    $optionLabelMerge = array_merge($optionLabel, $optionNoLabel);
                } elseif (count($optionLabel) > 0 || count($optionNoLabel) > 0) {
                    $optionLabelMerge = count($optionLabel) > 0 ? $optionLabel :  $optionNoLabel;
                }
                $index = hasOption($item->id) ? $this->optionMatch($item->id, Cart::cartCollection(), $optionLabelMerge) : $this->searchIndex($item->id, Cart::cartCollection());
                $itemOptions = ItemOption::getAll()->where('item_id', $item->id);
                if (isset($allOptions) && is_array($allOptions) && count($allOptions) > 0) {
                    foreach ($allOptions as $op) {
                        $existsVal = $this->optionExists($item->id, $price, $itemOptions, $op);
                        if($existsVal != false) {
                            $options[] = $existsVal['label'];
                            $optionIds[] = $existsVal['option_id'];
                            $optionNames[] = $existsVal['name'];
                        }
                    }
                }
                //no label
                if (isset($allNoLabelOptions) && is_array($allNoLabelOptions) && count($allNoLabelOptions) > 0) {
                    foreach ($allNoLabelOptions as $key => $opNoLabel) {
                        $existsValNoLabel = $this->optionExistsNoLabel($item->id, $price, $itemOptions, $opNoLabel, $key);
                        if($existsValNoLabel != false) {
                            $options[] = $existsValNoLabel['label'];
                            $optionIds[] = $existsValNoLabel['option_id'];
                            $optionNames[] = $existsValNoLabel['name'];
                        }
                    }
                }
                //end no label
                $price += $this->extraAmount;

                //required checking
                $itemReqAllOption = ItemOption::getAll()->where('item_id', $request->item_id)->where('is_required', 1)->pluck('name','id')->toArray();
                $itemReqAllOptionId = array_keys($itemReqAllOption);
                $optionCheck = array_diff($itemReqAllOptionId, $optionIds);
                //end required checking
            }

            /* duplicate option checking */
            $optionNamesUnique = null;
            $optionsUnique = [];
            $duplicateOptionIds = array_diff_assoc($optionIds, array_unique($optionIds));
            if (is_array($duplicateOptionIds) && count($duplicateOptionIds) > 0) {
                $duplicateArray = $duplicateOptionIds;
                $optionIdsUnique = array_unique($optionIds);
                $duplicateIdentify = array_shift($duplicateArray);
                $firstDupValKey = array_search($duplicateIdentify, $optionIds);
                $optionNamesUnique = $optionNames[$firstDupValKey];
                $optionsUnique[] = $options[$firstDupValKey];
                foreach ($duplicateOptionIds as $key => $duplicate) {
                    unset($optionNames[$key]);
                    $optionsUnique[] = $options[$key];
                    unset($options[$key]);
                }
                $optionIds = array_values($optionIdsUnique);
                $optionNames[$firstDupValKey] = $optionNamesUnique;
                $options[$firstDupValKey] = implode(",", $optionsUnique);
                $optionNames = array_values($optionNames);
                $options = array_values($options);
            }
            /* end duplicate option checking */

            /* check inventory */
            if (optional($item->itemDetail)->is_track_inventory == 1) {
                if (!is_null($index)) {
                    $cartList = Cart::getCartData();
                    $optionIds = json_decode($cartList[$index]['option_id']);
                    $options = json_decode($cartList[$index]['option']);
                }
                $inventoryEnable = $this->existsQuantity($optionIds, $options, $request->qty ?? 1);
            }
            /*end check inventory*/

            if (count($optionCheck) == 0) {
                if ($inventoryEnable == true) {
                    $add = Cart::add(
                        [
                            'id' => $item->id,
                            'item_code' => $item->item_code,
                            'vendor_id' => $item->vendor_id,
                            'shop_id' => $item->shop_id,
                            'name' => $item->name,
                            'quantity' => $request->qty ?? 1,
                            'price' => $price != null && $price > 0 ? $price : 0,
                            'actual_price' => $item->price,
                            'photo' => $item->fileUrl(),
                            'discount_amount' => dateExists($item->discount_from, $item->discount_to) && $item->discount_amount != null && $item->discount_amount > 0 ? $item->discount_amount : 0,
                            'discount_type' => dateExists($item->discount_from, $item->discount_to) ? $item->discount_type : null,
                            'option_id' => count($optionIds) > 0 ? json_encode($optionIds) : null,
                            'option_name' => count($optionNames) > 0 ? json_encode($optionNames) : null,
                            'option' => count($options) > 0 ? json_encode($options) : null,
                        ], $index
                    );
                    if ($add) {
                        $response = [
                            "message" => __("Item successfully added to your cart."),
                            "totalItem" => Cart::totalItem(),
                            "totalPrice" => Cart::totalPrice(),
                            "carts" => Cart::cartCollection()
                        ];
                        return $this->response(['data' => $response]);
                    }
                } else {
                    $message =  __("Stock is not available.");
                    return $this->errorResponse([], 500, $message);
                }
            } else {
                $txt = [];
                foreach ($optionCheck as $chk) {
                    $txt[] = $itemReqAllOption[$chk];
                }
                if (count($txt) == 1) {
                    $message =  __(':x is required.', ['x' => $txt[0]]);
                } else {
                    $message =  __(':x are required.', ['x' => implode(",", $txt)]);
                }
            }
        }
        return $this->errorResponse([], 500, $message);
    }

    /**
     * check exists quantity
     *
     * @param $reqOptionId
     * @param $reqLabel
     * @param $qty
     * @return bool
     */
    protected function existsQuantity($reqOptionId = [], $reqLabel = [],  $qty = 1)
    {
        if (is_array($reqOptionId) && count($reqOptionId) != 0) {
            $existsOptionIds = Cart::cartCollection()->pluck('option_id')->toArray();
            $existsOption = Cart::cartCollection()->pluck('option')->toArray();
            $existsQuantity = Cart::cartCollection()->pluck('quantity')->toArray();
            $checkedOptionId = [];
            $checkedOptionLabel = [];
            $getQty = 0;
            if (is_array($existsOptionIds) && count($existsOptionIds) > 0) {
                foreach ($existsOptionIds as $mainKey => $id) {
                    $decodeOptionId = json_decode($id);
                    $decodeOption = json_decode($existsOption[$mainKey] ?? []);
                    foreach ($decodeOptionId as $secKey => $decodeId) {
                        if (in_array($decodeId, $reqOptionId) && in_array($decodeOption[$secKey] ?? '', $reqLabel)) {
                            $checkedOptionId[] = $decodeId;
                            $checkedOptionLabel[] = $decodeOption[$secKey] ?? '';
                            $inventory = Inventory::where('item_option_id', $decodeId)->where('label', $decodeOption[$secKey] ?? null)->first();
                            $getQty = $this->getStockTotalQty($existsOptionIds, $existsOption, $existsQuantity, $decodeId, $decodeOption[$secKey]);
                            $getQty = $getQty + $qty;
                            if (!empty($inventory) && $inventory->quantity >= $getQty) {
                                continue;
                            } else {
                                return false;
                            }
                        }
                    }
                }
                $checkedOptionLabel = (array_diff($reqLabel, $checkedOptionLabel));
                $checkedOptionId = (array_diff($reqOptionId, $checkedOptionId));
                if (is_array($checkedOptionId) && count($checkedOptionId) != 0 && is_array($checkedOptionLabel) && count($checkedOptionLabel) != 0) {
                    return $this->optionQuantity($checkedOptionId, $checkedOptionLabel, $qty);
                } else {
                    return true;
                }
            } else {
                return $this->optionQuantity($reqOptionId, $reqLabel, $qty);
            }
        } else {
            return false;
        }
    }

    /**
     * option quantity for new cart
     *
     * @param $optionIds
     * @param $label
     * @param $qty
     * @return bool
     */
    protected function optionQuantity($optionIds = [], $label = [], $qty = 1)
    {
        foreach ($optionIds as $key => $id) {
            $inventory = Inventory::where('item_option_id', $id)->where('label', $label[$key])->first();
            if (empty($inventory) || $qty > $inventory->quantity) {
                return false;
            }
        }
        return true;
    }

    /**
     * sum total quantity from cart list
     *
     * @param $optionIds
     * @param $label
     * @param $qty
     * @param $searchId
     * @param $searchLabel
     * @return int|mixed
     */
    protected function getStockTotalQty($optionIds = [], $label = [], $qty = [], $searchId = null, $searchLabel = null)
    {
        $totalQty = 0;
        foreach ($optionIds as $mainKey => $id) {
            $decodeOptionIds = json_decode($id);
            $decodeOptionLabel = json_decode($label[$mainKey] ?? []);
            foreach ($decodeOptionIds as $secKey => $optionId) {
                $optionLabel = $decodeOptionLabel[$secKey] ?? '';
                if ($optionId == $searchId && $optionLabel == $searchLabel) {
                    $totalQty += $qty[$mainKey] ?? 0;
                }
            }
        }
        return $totalQty;
    }

    /**
     * using for search index by itemId
     *
     * @param $id
     * @param array $array
     * @return int|string|null
     */
    protected function searchIndex($id, $array = [])
    {
        foreach ($array as $key => $val) {
            if ($val['id'] === $id) {
                return $key;
            }
        }
        return null;
    }

    /**
     * matching all option from cart if exists all option then return index
     *
     * @param $id
     * @param array $cart
     * @param null $requestedOption
     * @return int|string|void|null
     */
    protected function optionMatch($id, $cart = [], $requestedOptions = null)
    {
        foreach ($cart as $key => $val) {
            if ($val['id'] === $id) {
                $options = json_decode($cart[$key]['option']);
                $requestedOptions == null ? $requestedOptions[] = $requestedOptions : $requestedOptions;
                $options == null ? $options[] = $options : $options;
                if(count(array_diff($requestedOptions, $options)) == 0 && count(array_diff($options, $requestedOptions)) == 0) {
                    return $key;
                }
            }
        }
        return null;
    }

    /**
     * check options from db if ok then calculate extra price
     *
     * @param $itemId
     * @param $price
     * @param $option
     * @return bool|void
     */
    protected function optionExists($itemId ,$price, $itemOptions, $option)
    {
        $data = [];
        foreach ($itemOptions as $key => $op) {
            $payLoads = json_decode($op->payloads);
            if (isset($payLoads->label) && in_array($option, $payLoads->label)) {
                $index = array_search($option, $payLoads->label);
                $this->extraAmount += $payLoads->option_price_type[$index] == 'Percent' ? ($price * $payLoads->option_price[$index]->option_price) / 100 : $payLoads->option_price[$index]->option_price;
                $data = [
                    'option_id' => $op->id,
                    'name' => $op->name,
                    'label' => $option,
                ];
            } elseif ($op->type == 'date' || $op->type == 'date_time' || $op->type == 'field' || $op->type == 'textarea') {
                if (isset(request()->optionRealId) && request()->optionRealId == $op->id) {
                    $this->extraAmount += $payLoads->option_price_type[0] == 'Percent' ? ($price * $payLoads->option_price[0]->option_price) / 100 : $payLoads->option_price[0]->option_price;
                    $data = [
                        'option_id' => $op->id,
                        'name' => $op->name,
                        'label' => $option,
                    ];
                }

            }
        }
        return count($data) > 0 ? $data : false;
    }

    /**
     * check options from db if ok then calculate extra price
     *
     * @param $itemId
     * @param $price
     * @param $option
     * @return bool|void
     */
    protected function optionExistsNoLabel($itemId ,$price, $itemOptions, $option, $opKey)
    {
        $data = [];
        foreach ($itemOptions as $key => $op) {
            $payLoads = json_decode($op->payloads);
            if ($op->type == 'date' || $op->type == 'date_time' || $op->type == 'field' || $op->type == 'textarea' || $op->type == 'time') {
                if (isset(request()->optionNoLabelId[$opKey]) && request()->optionNoLabelId[$opKey] == $op->id) {
                    $this->extraAmount += $payLoads->option_price_type[0] == 'Percent' ? ($price * $payLoads->option_price[0]->option_price) / 100 : $payLoads->option_price[0]->option_price;
                    $data = [
                        'option_id' => $op->id,
                        'name' => $op->name,
                        'label' => $option,
                    ];
                }

            }
        }
        return count($data) > 0 ? $data : false;
    }

    /**
     * remove cart by cart index
     *
     * @param Request $request
     * @return array
     */
    public function destroy(Request $request)
    {
        $message =  __("Something went wrong, please try again.");
        $validator = Item::cartIndexValidation($request->all());
        if ($validator->fails()) {
            return $this->unprocessableResponse($validator->messages());
        }
        if (Cart::destroy($request->cartIndex)) {
            $response = [
                "message" => __("Deleted Successfully"),
                "totalItem" => Cart::totalItem(),
                "totalPrice" => Cart::totalPrice(),
                "carts" => Cart::cartCollection()
            ];
            return $this->response(['data' => $response]);
        }
        return $this->errorResponse([], 500, $message);
    }

    /**
     * remove cart by cart index
     *
     * @param Request $request
     * @return array
     */
    public function destroyAll(Request $request)
    {
        $message =  __("Something went wrong, please try again.");
        if (Cart::destroy(null, "all")) {
            $response = [
                "status" => 1,
                "message" => __("Deleted Successfully"),
                "totalItem" => Cart::totalItem(),
                "totalPrice" => Cart::totalPrice(),
                "carts" => Cart::cartCollection()
            ];
            return $this->response(['data' => $response]);
        }
        return $this->errorResponse([], 500, $message);
    }

    /**
     * cart quantity reduce
     *
     * @param Request $request
     * @return array
     */
    public function reduceQuantity(Request $request)
    {
        $message =  __("Something went wrong, please try again.");
        $validator = Item::cartIndexValidation($request->all());
        if ($validator->fails()) {
            return $this->unprocessableResponse($validator->messages());
        }
        if (Cart::reduceQuantity($request->cartIndex)) {
            $response = [
                "message" => __("Saved Successfully"),
                "totalItem" => Cart::totalItem(),
                "totalPrice" => Cart::totalPrice(),
                "carts" => Cart::cartCollection()
            ];
            return $this->response(['data' => $response]);
        }
        return $this->errorResponse([], 500, $message);
    }

    /**
     * check coupon
     *
     * @param Request $request
     * @return array
     */
    public function checkCoupon(Request $request)
    {
        $message =  __("Something went wrong, please try again.");
        $validator = Item::cartCouponValidation($request->all());
        if ($validator->fails()) {
            return $this->unprocessableResponse($validator->messages());
        }
        if (isActive('Coupon')) {
            if (!empty(Cart::getSelected())) {
                if (empty(Cart::getCouponData())) {
                    $coupon = \Modules\Coupon\Http\Models\Coupon::isValid($request->discount_code);
                    if ($coupon['status'] == true) {
                        $couponItem = \Modules\Coupon\Http\Models\ItemCoupon::where('coupon_id', $coupon['data']->id)->pluck('item_id')->toArray();
                        $validCouponWithAmount = $this->couponAmount($coupon['data'], $couponItem);
                        if ($validCouponWithAmount['status'] == 1) {
                            $data = [
                                "id" => $validCouponWithAmount['id'],
                                "code" => $validCouponWithAmount['code'],
                                "discount_type" =>  $validCouponWithAmount['discount_type'],
                                "discount_amount" =>  $validCouponWithAmount['discount_amount'],
                                "calculated_discount" => $validCouponWithAmount['calculated_discount']
                            ];
                            $response = [
                                "data" => $data
                            ];
                            Cart::couponSave($data);
                            return $this->response(['data' => $response]);
                        } else {
                            $message = $validCouponWithAmount['message'];
                            return $this->errorResponse([], 500, $message);
                        }
                    }
                    $message = $coupon['message'];
                    return $this->errorResponse([], 500, $message);
                }
                $message = __('Coupon already applied');
            } else {
                $message = __('Select an item first!');
            }
        } else {
            $message = __('Errors');
        }

        return $this->errorResponse([], 500, $message);
    }

    public function couponAmount($coupon = [], $couponItem = null)
    {
        $selectedCart = collect(Cart::selectedCartCollection());
        if (isActive('Shop')) {
            $cartFilter = $selectedCart->where('shop_id', $coupon['shop_id'])->where('vendor_id', $coupon['vendor_id'])->whereIn('id', $couponItem)->all();
            if (!empty($cartFilter)) {
                $cartFilterCollect = collect($cartFilter);
                $totalPrice = $cartFilterCollect->sum(function ($cartFilterCollect) {
                    return $cartFilterCollect['price'] * $cartFilterCollect['quantity'];
                });
            } else {
                return [
                    'status' => 0,
                    'message' => __('Invalid :x', ['x' => __('Coupon')])
                ];
            }
        } else {
            $cartFilter = $selectedCart->where('vendor_id', $coupon['vendor_id'])->whereIn('id', $couponItem)->all();
            if (!empty($cartFilter)) {
                $cartFilterCollect = collect($cartFilter);
                $totalPrice = $cartFilterCollect->sum(function ($cartFilterCollect) {
                    return $cartFilterCollect['price'] * $cartFilterCollect['quantity'];
                });
            } else {
                return [
                    'status' => 0,
                    'message' => __('Invalid :x', ['x' => __('Coupon')])
                ];
            }
        }

        if ($coupon['usage_limit'] > $coupon['usage_count']) {
            if ($totalPrice >= $coupon['minimum_spend']) {
                $discountPrice = 0;
                if ($coupon['discount_type'] == 'Percentage') {
                    $discountPrice = ($totalPrice * $coupon['discount_amount']) / 100 ;
                    if ($discountPrice > $coupon['maximum_discount_amount']) {
                        $discountPrice = $coupon['maximum_discount_amount'];
                    }
                } else {
                    $discountPrice = min($totalPrice, $coupon['discount_amount']);
                }
                return [
                    'status' => 1,
                    'id' => $coupon['id'],
                    'code' => $coupon['code'],
                    'discount_type' => $coupon['discount_type'],
                    'discount_amount' => $coupon['discount_amount'],
                    'calculated_discount' => $discountPrice
                ];
            } else {
                return [
                    'status' => 0,
                    'message' => __('Please spend more for apply this coupon.')
                ];
            }
        } else {
            return [
                'status' => 0,
                'message' => __('Coupon usage limit has been reached.')
            ];
        }


    }

    /**
     * destroy selected
     *
     * @param Request $request
     * @return array
     */
    public function destroySelected(Request $request)
    {
        $message =  __("Something went wrong, please try again.");
        $validator = Item::cartIndexValidation($request->all());
        if ($validator->fails()) {
            return $this->unprocessableResponse($validator->messages());
        }
        $cartIndex = json_decode($request->cartIndex);
        if (is_array($cartIndex) && count($cartIndex) > 0) {
            foreach ($cartIndex as $index) {
                Cart::destroy($index);
            }
            $response = [
                "status" => 1,
                "message" => __("Deleted Successfully"),
                "totalItem" => Cart::totalItem(),
                "totalPrice" => Cart::totalPrice(),
                "carts" => Cart::cartCollection()
            ];
            return $this->response(['data' => $response]);
        } else {
            return $this->errorResponse([], 500, $message);
        }
    }

    /**
     * selected index store
     *
     * @param Request $request
     * @return array
     */
    public function storeSelected(Request $request)
    {
        $message =  __("Something went wrong, please try again.");
        $validator = Item::cartIndexValidation($request->all());
        if ($validator->fails()) {
            return $this->unprocessableResponse($validator->messages());
        }
        $cartIndex = json_decode($request->cartIndex);
        if (is_array($cartIndex) && count($cartIndex) > 0) {
            Cart::selectedStore($cartIndex);
            $response = [
                "message" => __("Saved Successfully."),
            ];
            return $this->response(['data' => $response]);
        } else {
            return $this->errorResponse([], 500, $message);
        }
    }

    /**
     * get stock
     *
     * @param Request $request
     * @return array
     */
    public function getStock(Request $request)
    {
        $message =  __("Something went wrong, please try again.");
        $inventory = Inventory::where('item_option_id', $request->item_option_id)->where('label', $request->option_label)->first();
        if (!empty($inventory)) {
            $response['quantity'] = $inventory->quantity;
            $itemDetails = ItemDetail::where('item_id', optional($inventory->itemOption)->item_id)->first();
            $response = [
                'status' => 1,
                'quantity' => $inventory->quantity,
                'is_track_inventory' => optional($itemDetails)->is_track_inventory,
                'is_hide_stock' => optional($itemDetails)->is_hide_stock,
            ];
            return $this->response(['data' => $response]);
        }
        return $this->errorResponse([], 500, $message);
    }
}
