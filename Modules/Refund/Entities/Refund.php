<?php

/**
 * @package Refund model
 * @author techvillage <support@techvill.org>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @created 24-02-2022
 */

namespace Modules\Refund\Entities;

use App\Models\{
    Inventory,
    Model,
    Order,
    OrderDetail,
    Transaction,
    User
};
use App\Traits\ModelTraits\hasFiles;
use Validator;

class Refund extends Model
{
    use hasFiles;
    /**
     * timestamps
     * @var boolean
     */
    public $timestamps = false;

    /**
     * Relation with User model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation with OrderDetail model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function orderDetail()
    {
        return $this->belongsTo(OrderDetail::class);
    }

    /**
     * Relation with RefundReason model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function refundReason()
    {
        return $this->belongsTo(RefundReason::class);
    }

    /**
     * Relation with RefundProcess model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function refundProcesses()
    {
        return $this->hasMany(RefundProcess::class);
    }

    /**
     * Store Validation
     * @param  array  $data
     * @return mixed
     */
    protected static function storeValidation($data = [])
    {
        $validator = Validator::make($data, [
            'order_detail_id' => 'required|exists:order_details,id',
            'refund_reason_id' => 'required|exists:refund_reasons,id',
            'quantity_sent' => 'required|numeric',
            'refund_type' => 'required|in:Full,Partial',
            'refund_method' => 'required|in:Wallet',
            'shipping_method' => 'required',
            'payment_status' => 'required|in:Paid,Unpaid',
            'status' => 'required|in:Opened,In progress,Accepted,Declined',
        ], [
            'status.in' => __('Refund status must be Opened, In progress, Accepted or Declined.')
        ]);
        return $validator;
    }

    /**
     * Update Validation
     * @param  array  $data
     * @return mixed
     */
    protected static function updateValidation($data = [])
    {
        $validator = Validator::make($data, [
            'status' => 'required|in:Opened,In progress,Accepted,Declined',
        ], [
            'status.in' => __('Refund status must be Opened, In progress, Accepted or Declined.')
        ]);
        return $validator;
    }

    public function store($data)
    {
        $response = ['status' => 'fail', 'message' => __('Something went wrong, please try again.')];
        $refund = parent::where(['user_id' => $data['user_id'], 'order_detail_id' => $data['order_detail_id']])->first();
        if (!empty($refund) && ($refund->quantity_sent + $data['quantity_sent']) > $refund->orderDetail->quantity) {
            $response['message'] = __('You have exceeded item quantity limit.');
            return $response;
        }
        if (parent::insert(array_intersect_key($data, array_flip((array) [
            'user_id',
            'order_detail_id',
            'refund_reason_id',
            'reference',
            'quantity_sent',
            'refund_type',
            'refund_method',
            'shipping_method',
            'payment_status',
            'status',
            ])))) {
            $this->uploadFiles(['isUploaded' => false, 'isSavedInObjectFiles' => true, 'isOriginalNameRequired' => true, 'thumbnail' => false]);
            $response = ['status' => 'success', 'message' => __('Refund request send successfully.')];
        }
        return $response;
    }

    /**
     * Update
     * @param  array  $request
     * @param  string $id
     * @return array
     */
    public function updateData($request = [], $id = null)
    {
        $data = ['status' => 'fail', 'message' => __('Refund does not found.')];
        $result = parent::where('id', $id);
        if ($result->exists()) {
            try {
                \DB::beginTransaction();

                $result->update(array_intersect_key($request, array_flip((array) ['status'])));
                if ($request['status'] == 'Accepted') {
                    Refund::find($id)->orderDetail->item->vendor->users->first()->user->wallet()->decrementBalance($request['total']);
                    User::find($request['user_id'])->wallet()->incrementBalance($request['total']);

                    /* inventory refund */
                    $refundDetails = $result->first();
                    if (isset($refundDetails->orderDetail->itemDetails->is_track_inventory) && $refundDetails->orderDetail->itemDetails->is_track_inventory == 1) {
                        $itemOption = json_decode($refundDetails->orderDetail->payloads);
                        if (!empty($itemOption)) {
                            foreach ($itemOption->item_option_id as $key => $optionId) {
                                $inventory = Inventory::where('item_option_id', $optionId)->where('label', $itemOption->options[$key] ?? null)->first();
                                if (!empty($inventory)) {
                                    $adjustQty = $inventory->quantity + $refundDetails->orderDetail->quantity;
                                    (new Inventory)->updateInventory(['quantity' => $adjustQty], $inventory->id);
                                }
                            }
                        }
                    }
                    /* end inventory */
                    /*transaction reject*/
                    $vendorTransaction = Transaction::where('reference_number', $result->first()->order_detail_id)->where('transaction_type', "Vendor Transaction")->first();
                    $vendorCommission = Transaction::where('reference_number', $result->first()->order_detail_id)->where('transaction_type', "Commission")->first();
                    if (!empty($vendorTransaction)) {
                        $vendorTransaction->status = "Rejected";
                        $vendorTransaction->description = "Refund";
                        $vendorTransaction->save();
                    }
                    if (!empty($vendorCommission)) {
                        $vendorCommission->status = "Rejected";
                        $vendorCommission->description = "Refund";
                        $vendorCommission->save();
                    }
                    /*end transaction reject*/

                }
                self::forgetCache();
                $data = ['status' => 'success', 'message' => __('The :x has been successfully saved.', ['x' => __('Refund')])];
                \DB::commit();
            } catch (\Exception $e) {
                \DB::rollBack();
                $data['error'] = __('Something went wrong, please try again.');
            }
        }
        return $data;
    }

    /**
     * Find order number that is not refund yet.
     * @return array
     */
    public static function getOrders()
    {
        $details = OrderDetail::select('id', 'order_id', 'quantity')
            ->with('order:id,reference')->where(['is_delivery' => 1])
            ->withSum('refund as refund_quantity', 'quantity_sent')
            ->whereHas('order', function($query) {
                $query->where('user_id', auth()->user()->id);
            })
            ->get();

        $orders = [];
        foreach ($details as $detail) {
            if ($detail->refund_quantity == null || $detail->refund_quantity < $detail->quantity) {
                $orders[$detail->order->id] = $detail->order->reference;
            }
        }

        return $orders;
    }

    /**
     * Find items with order reference
     * @param string $reference
     * @return array
     */
    public static function getItems($reference)
    {
        $orderDetail = OrderDetail::select('id', 'item_id', 'item_name', 'quantity')
        ->where('is_delivery', 1)
        ->whereHas('order', function($query) use($reference) {
            $query->where('reference', $reference);
        })
        ->withSum('refund as refund_quantity', 'quantity_sent')
        ->get();

        $details = [];
        foreach ($orderDetail as $detail) {
            if ($detail->quantity > $detail->refund_quantity) {
                $details[] = ['id' => $detail->id, 'item_id' => $detail->item_id, 'item_name' => $detail->item_name, 'quantity' => ($detail->quantity - $detail->refund_quantity)];
            }
        }

        return $details;
    }
}
