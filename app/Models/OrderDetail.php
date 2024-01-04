<?php
/**
 * @package OrderDetail
 * @author techvillage <support@techvill.org>
 * @contributor Sakawat Hossain Rony <[sakawat.techvill@gmail.com]>
 * @created 14-12-2021
 */
namespace App\Models;

use App\Models\Model;
use Auth;
use Modules\Commission\Http\Models\OrderCommission;
use Modules\Refund\Entities\Refund;

class OrderDetail extends Model
{
    /**
     * Foreign key with Shop model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shop()
    {
        return $this->belongsTo('\Modules\Shop\Http\Models\Shop', 'shop_id');
    }

    /**
     * Foreign key with Item model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function item()
    {
        return $this->belongsTo('App\Models\Item', 'item_id');
    }

    /**
     * Foreign key with itemCategory model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function itemCategory()
    {
        return $this->belongsTo('App\Models\ItemCategory', 'item_id', 'item_id');
    }

    /**
     * Foreign key with Order model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo('App\Models\Order', 'order_id');
    }

    /**
     * Foreign key with Vendor model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vendor()
    {
        return $this->belongsTo('App\Models\Vendor', 'vendor_id');
    }

    /**
     * Foreign key with OrderStatus model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function orderStatus()
    {
        return $this->belongsTo('App\Models\OrderStatus', 'order_status_id');
    }

    /**
     * Relation with Refund model
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function refund()
    {
        return $this->hasOne(\Modules\Refund\Entities\Refund::class);
    }

    public function itemDetails()
    {
        return $this->belongsTo('App\Models\ItemDetail', 'item_id', 'item_id');
    }

    /**
     * Relation with Shipping model
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function shipping()
    {
        return $this->belongsTo(\Modules\Shipping\Entities\Shipping::class);
    }

    /**
     * Store
     * @param  array  $data
     * @return int|null
     */
    public function store($data = [])
    {
        if (parent::insert($data)) {
            return true;
        }
        return false;
    }

    /**
     * Update OrderDetail
     * @param array $data
     * @param null $id
     * @return bool
     */
    public function updateOrder($data = [], $id = null)
    {
        $result = parent::where('id', $id);
        $isDelivery = false;
        if ($result->exists()) {
            $transactionDetail = Transaction::where('reference_number', $id)->where('transaction_type', "Vendor Transaction");
            $orderDeliverId = Order::getFinalOrderStatus();
            if (isset($data['order_status_id']) && $orderDeliverId == $data['order_status_id']) {
                $data['is_delivery'] = 1;
                $isDelivery = true;
            } else {
                $data['is_delivery'] = 0;
                $isDelivery = false;
            }
            if (!$transactionDetail->exists()) {
                if ($isDelivery) {
                    $result->first()->vendor->users()->first()->user->wallet()->incrementBalance($result->first()->price * $result->first()->quantity);
                    $transaction['user_id'] = $result->first()->order->user_id;
                    $transaction['currency_id'] = isset($result->first()->order->currency_id) ? $result->first()->order->currency_id : null;
                    $transaction['order_id'] = $result->first()->order_id;
                    $transaction['exchange_rate'] = isset($result->first()->order->currency->exchange_rate) ? $result->first()->order->currency->exchange_rate : null;
                    $transaction['vendor_id'] = $result->first()->vendor_id;
                    $transaction['shop_id'] = $result->first()->shop_id;
                    $transaction['total_amount'] = $result->first()->price * $result->first()->quantity;
                    $transaction['amount'] = $result->first()->price * $result->first()->quantity;
                    $transaction['reference_number'] = $id;
                    $transaction['transaction_type'] = "Vendor Transaction";
                    $transaction['transaction_date'] = now();
                    $transaction['status'] = "Accepted";
                    (new Transaction)->store($transaction);
                }
            } elseif ($transactionDetail->exists()) {
                if (isset($data['order_status_id']) && $orderDeliverId != $data['order_status_id']) {
                    $result->first()->vendor->users()->first()->user->wallet()->decrementBalance($result->first()->price * $result->first()->quantity);
                    $transactionDetailData = $transactionDetail->first();
                    $transactionDetailData->status = "Pending";
                    $transactionDetailData->save();
                } elseif ($isDelivery) {
                    $result->first()->is_delivery != 1 ? $result->first()->vendor->users()->first()->user->wallet()->incrementBalance($result->first()->price * $result->first()->quantity) : '';
                    $transactionDetailData = $transactionDetail->first();
                    $transactionDetailData->status = "Accepted";
                    $transactionDetailData->save();
                }
                $transactionCommission = Transaction::where('reference_number', $id)->where('transaction_type', "Commission")->first();
                if (!empty($transactionCommission)) {
                    $transactionCommission->status = "Pending";
                    $transactionCommission->save();
                    (new OrderCommission)->updateOrderCommissionByOrder(['status' => 'Pending', 'approval_time' => date('Y-m-d H:i:s')], $id);
                }
            }
            $result->update($data);
            return true;
        }

        return false;
    }

    /**
     * Check order item refundable status
     * @return bool
     */
    public function isRefundable() {

        if ($this->is_delivery == 0) {
            return false;
        }

        if ($this->quantity > (isset($this->refund) ? Refund::where('order_detail_id', $this->id)->sum('quantity_sent') : 0)) {
            return true;
        }

        return false;
    }
}
