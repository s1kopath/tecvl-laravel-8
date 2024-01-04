<?php
/**
 * @package Cart
 * @author techvillage <support@techvill.org>
 * @contributor Sakawat Hossain Rony <[sakawat.techvill@gmail.com]>
 * @created 24-11-2021
 */
namespace App\Cart;
use Validator;
use Cache;
use Auth;

class Cart
{
    /**
     * Added item in cart
     *
     * @param array $data
     * @return bool
     */
    public function add($data = [], $index = null)
    {
        $validator = $this->validate($data);
        if ($validator->fails()) {
            return false;
        }
        $cart = $this->getCartData();
        if (!$cart) {
            $cart[] = [
                    "id" => $data['id'],
                    "item_code" => $data['item_code'],
                    "vendor_id" => $data['vendor_id'],
                    "shop_id" => $data['shop_id'],
                    "name" => $data['name'],
                    "quantity" => $data['quantity'],
                    "price" => $data['price'],
                    "actual_price" => $data['actual_price'],
                    "photo" => $data['photo'],
                    "discount_amount" => $data['discount_amount'],
                    "discount_type" => $data['discount_type'],
                    "option_id" => $data['option_id'],
                    "option_name" => $data['option_name'],
                    "option" => $data['option'],
                 ];
            $this->save($cart);
            $this->destroyCoupon();
            return true;
        } elseif (isset($cart[$index]['id']) && $cart[$index]['id'] == $data['id']) {
            $cart[$index]['quantity'] = $cart[$index]['quantity'] + $data['quantity'];
            $this->save($cart);
            return true;
        } else {
            $cart[] = [
                "id" => $data['id'],
                "item_code" => $data['item_code'],
                "vendor_id" => $data['vendor_id'],
                "shop_id" => $data['shop_id'],
                "name" => $data['name'],
                "quantity" => $data['quantity'],
                "price" => $data['price'],
                "actual_price" => $data['actual_price'],
                "photo" => $data['photo'],
                "discount_amount" => $data['discount_amount'],
                "discount_type" => $data['discount_type'],
                "option_id" => $data['option_id'],
                "option_name" => $data['option_name'],
                "option" => $data['option'],
            ];
            $this->save($cart);
            $this->destroyCoupon();
            return true;
        }
    }

    /**
     * cart item decrement
     *
     * @param $id
     * @return bool|void
     */
    public function reduceQuantity($index)
    {
        $cart = $this->getCartData();
        if (isset($cart[$index])) {
            if ($cart[$index]['quantity'] > 1) {
                $cart[$index]['quantity']--;
                $this->save($cart);
                return true;
            }
        }
    }

    /**
     * return all cart item
     *
     * @return mixed
     */
    public function getCartData()
    {
        return !empty($this->userId()) ? Cache::get(config('cache.prefix') . '.cart.'.$this->userId()) : Cache::get(config('cache.prefix') . '.cart.'.getUniqueAddress());
    }

    /**
     * return coupon
     *
     * @return mixed
     */
    public function getCouponData()
    {
        return !empty($this->userId()) ? Cache::get(config('cache.prefix') . '.coupon.'.$this->userId()) : Cache::get(config('cache.prefix') . '.coupon.'.getUniqueAddress());
    }

    /**
     * cart item in collection
     *
     * @return CartCollection
     */
    public function cartCollection()
    {
        return !empty($this->userId()) ? new CartCollection(Cache::get(config('cache.prefix') . '.cart.'.$this->userId())) : new CartCollection(Cache::get(config('cache.prefix') . '.cart.'.getUniqueAddress()));
    }

    /**
     * selected cart item in collection
     *
     * @return CartCollection
     */
    public function selectedCartCollection()
    {
        $data = [];
        $cart = $this->cartCollection();
        $selectedIndex = $this->getSelected() ?? [];
        foreach ($cart as $key => $item) {
            if (in_array($key, $selectedIndex)) {
                $data[$key] = $item;
            }
        }
        return $data;
    }

    /**
     * selected cart item destroy
     *
     * @return CartCollection
     */
    public function selectedCartItemDestroy()
    {
        $cart = $this->cartCollection();
        $selectedIndex = $this->getSelected() ?? [];
        foreach ($cart as $key => $item) {
            if (in_array($key, $selectedIndex)) {
                $this->destroy($key);
            }
        }
        $this->destroyCoupon();
        $this->selectedDestroy();
    }

    /**
     * total item of cart
     *
     * @return int
     */
    public function totalItem()
    {
        $cart = $this->cartCollection();
        return $cart->count();

    }

    /**
     * total quantity of cart
     *
     * @return int|mixed
     */
    public function totalQuantity($action = 'all')
    {
        if ($action == 'selected') {
            $cart = new CartCollection($this->selectedCartCollection());
        } else {
            $cart = $this->cartCollection();
        }
        if ($cart->isEmpty()) return 0;

        $count = $cart->sum(function ($cart) {
            return $cart['quantity'];
        });
        return $count;
    }

    /**
     * total price of cart
     *
     * two types "all" & "selected" if selected then calculate will be selected items
     *
     * @return int|mixed
     */
    public function totalPrice($type = "all")
    {
        $cart = $this->cartCollection();
        $count = 0;
        if ($type == "selected") {
            $selectedIndex = $this->getSelected() ?? [];
            foreach ($cart as $key => $item) {
                if (in_array($key, $selectedIndex)) {
                    $count += $item['price'] * $item['quantity'];
                }
            }
        } else {
            if ($cart->isEmpty()) return 0;

            $count = $cart->sum(function ($cart) {
                return $cart['price'] * $cart['quantity'];
            });
        }
        return $count;
    }


    /**
     * validate cart item
     *
     * @param array $item
     * @return mixed
     */
    public function validate($item = [])
    {
        $validator = Validator::make($item, [
            'id' => 'required',
            'item_code' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric|min:1',
            'name' => 'required',
            'photo' => 'required'
        ]);

        return $validator;
    }

    /**
     * removes an item on cart by item ID
     *
     * @param $id
     * @return bool
     */
    public function destroy($index = null, $action = 'single')
    {
        if ($action == 'single') {
            $cart = $this->getCartData();
            unset($cart[$index]);
            $this->save($cart);
        } else {
            !empty($this->userId()) ? Cache::forget(config('cache.prefix') . '.cart.'.$this->userId()) :  Cache::forget(config('cache.prefix') . '.cart.'.getUniqueAddress());
            $this->destroyCoupon();
            $this->selectedDestroy();
        }
        return true;
    }

    /**
     * removes coupon
     *
     * @param $id
     * @return bool
     */
    public function destroyCoupon()
    {
        if (!empty($this->userId()) && !empty(Cache::get(config('cache.prefix') . '.coupon.'.$this->userId()))) {
            Cache::forget(config('cache.prefix') . '.coupon.'.$this->userId());
        } elseif (!empty(Cache::get(config('cache.prefix') . '.coupon.'.getUniqueAddress()))) {
                Cache::forget(config('cache.prefix') . '.coupon.'.getUniqueAddress());
            }
    }

    /**
     * save the cart
     *
     * @param $cart
     * @return bool
     */
    protected function save($cart)
    {
        if (!empty($this->userId())) {
            Cache::put(config('cache.prefix') . '.cart.'.$this->userId(), $cart, 30 * 86400);
        } else {
            Cache::put(config('cache.prefix') . '.cart.'.getUniqueAddress(), $cart, 30 * 86400);
        }
    }

    /**
     * coupon save
     *
     * @param $data
     */
    public function couponSave($data)
    {
        if (!empty($this->userId())) {
            Cache::put(config('cache.prefix') . '.coupon.'.$this->userId(), $data, 30 * 86400);
        } else {
            Cache::put(config('cache.prefix') . '.coupon.'.getUniqueAddress(), $data, 30 * 86400);
        }
    }

    /**
     * item selected
     *
     * @param $data
     */
    public function selectedStore($data = [])
    {
        if (!empty($this->userId())) {
            Cache::put(config('cache.prefix') . '.selected.'.$this->userId(), $data, 30 * 86400);
        } else {
            Cache::put(config('cache.prefix') . '.selected.'.getUniqueAddress(), $data, 30 * 86400);
        }
        $this->destroyCoupon();
    }

    /**
     * get selected item
     *
     * @param $data
     */
    public function getSelected()
    {
        return !empty($this->userId()) ? Cache::get(config('cache.prefix') . '.selected.'.$this->userId()) : Cache::get(config('cache.prefix') . '.selected.'.getUniqueAddress());
    }

    /**
     * item selected destroy
     *
     * @param $data
     */
    public function selectedDestroy()
    {
        if (!empty($this->userId()) && !empty(Cache::get(config('cache.prefix') . '.selected.'.$this->userId()))) {
            Cache::forget(config('cache.prefix') . '.selected.'.$this->userId());
        } elseif (!empty(Cache::get(config('cache.prefix') . '.selected.'.getUniqueAddress()))) {
            Cache::forget(config('cache.prefix') . '.selected.'.getUniqueAddress());
        }
    }

    /**
     * cart data transfer local to user
     */
    public function cartDataTransfer()
    {
        if (!empty($this->userId()) && empty(Cache::get(config('cache.prefix') . '.cart.'.$this->userId()))) {
            if (!empty(Cache::get(config('cache.prefix') . '.cart.'.getUniqueAddress()))) {
                Cache::put(config('cache.prefix') . '.cart.'.$this->userId(), Cache::get(config('cache.prefix') . '.cart.'.getUniqueAddress()), 30 * 86400);
                if (!empty(Cache::get(config('cache.prefix') . '.selected.'.getUniqueAddress()))) {
                    Cache::put(config('cache.prefix') . '.selected.'.$this->userId(), Cache::get(config('cache.prefix') . '.selected.'.getUniqueAddress()), 30 * 86400);
                }
            }
        } elseif (!empty($this->userId()) && !empty(Cache::get(config('cache.prefix') . '.cart.'.$this->userId())) && !empty(Cache::get(config('cache.prefix') . '.cart.'.getUniqueAddress()))) {
            $authUserCarts = Cache::get(config('cache.prefix') . '.cart.'.$this->userId());
            $browserCarts = Cache::get(config('cache.prefix') . '.cart.'.getUniqueAddress());
            foreach ($browserCarts as $key => $cart) {
                $unique = [
                    'id' => $cart['id'],
                    'optionId' => json_decode($cart['option_id']),
                    'option' => json_decode($cart['option'])
                ];
                if ($this->authCartsSearch($unique, $authUserCarts) == false) {
                    $this->add($cart);
                }
            }
            Cache::forget(config('cache.prefix') . '.cart.'.getUniqueAddress());
            Cache::forget(config('cache.prefix') . '.selected.'.getUniqueAddress());
            Cache::put(config('cache.prefix') . '.cart.'.getUniqueAddress(), Cache::get(config('cache.prefix') . '.cart.'.$this->userId()), 30 * 86400);
        }
    }

    /**
     * search & match existing value between user & browser
     *
     * @param $existsValue
     * @param $authCarts
     * @return bool
     */
    public function authCartsSearch($existsValue, $authCarts)
    {
        foreach ($authCarts as $cart) {
            $option = json_decode($cart['option']);
            $optionId = json_decode($cart['option_id']);
            if ($cart['id'] == $existsValue['id']) {
                if ($option != null && $optionId != null && $existsValue['option'] != null && $existsValue['optionId'] != null) {
                    if (count(array_diff($existsValue['optionId'], $optionId)) == 0 && count(array_diff($optionId, $existsValue['optionId'])) == 0 && count(array_diff($option, $existsValue['option'])) == 0 && count(array_diff($existsValue['option'], $option)) == 0) {
                        return true;
                    }
                } elseif ($option == null && $optionId == null && $existsValue['option'] == null && $existsValue['optionId'] == null) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * @return null
     */
    public function userId()
    {
        $userId = null;
        if (isset(Auth::user()->id)) {
            $userId = Auth::user()->id;
        } elseif (isset(auth()->guard('api')->user()->id)) {
            $userId = auth()->guard('api')->user()->id;
        }
        return $userId;
    }
}
