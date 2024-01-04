<?php
/**
 * @package Order
 * @author techvillage <support@techvill.org>
 * @contributor Sakawat Hossain Rony <[sakawat.techvill@gmail.com]>
 * @created 14-12-2021
 */
namespace App\Models;
use App\Http\Controllers\EmailController;
use App\Models\Model;
use App\Traits\ModelTrait;
use Modules\Commission\Http\Models\Commission;
use Modules\Commission\Http\Models\OrderCommission;
use Modules\Coupon\Http\Models\CouponRedeem;
use Modules\Coupon\Http\Models\ItemCoupon;
use Mpdf\Tag\Tr;
use Validator, Auth;

class Order extends Model
{
    use ModelTrait;
    /**
     * Foreign key with currecny model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currency()
    {
        return $this->belongsTo('App\Models\Currency', 'currency_id');
    }
    /**
     * Foreign key with address model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function address()
    {
        return $this->belongsTo('App\Models\Address', 'address_id');
    }

    /**
     * Foreign key with user model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    /**
     * Foreign key with PaymentMethod model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paymentMethod()
    {
        return $this->hasOne('Modules\Gateway\Entities\PaymentLog', 'code', 'reference');
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
     * Relation with OrderDetail model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderDetails()
    {
        return $this->hasMany('App\Models\OrderDetail', 'order_id', 'id')->orderBy("shop_id", "ASC");
    }

    /**
     * Relation with Transaction model
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }

    /**
     * Relation with Order note history model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderNoteHistories()
    {
        return $this->hasMany(OrderNoteHistory::class);
    }


    public function vendorName($orderId)
    {
        $orderDetails = OrderDetail::where('order_id', $orderId)->get();
        $str = '';
        $duplicateId = [];
        foreach ($orderDetails as $detail) {
            if (!in_array($detail->vendor_id, $duplicateId)) {
                $duplicateId[] = $detail->vendor_id;
                $str .= '<p><span class="fas fa-bullseye mr-2"></span>' . optional($detail->vendor)->name . '</p>';
            }
        }
        return $str;
    }

    /**
     * Store Validation
     * @param array $data
     * @return mixed
     */
    protected static function storeValidation($data = [])
    {
        $validator = Validator::make($data, [
            'address_id' => 'required|exists:addresses,id',
        ]);

        return $validator;
    }

    /**
     * Store
     * @param  array  $data
     * @return int|null
     */
    public function store($data = [])
    {
        $id = parent::insertGetId($data);
        if (!empty($id)) {
            return $id;
        }
        return false;
    }

    /**
     * Update Order
     * @param array $data
     * @param null $id
     * @return bool
     */
    public function updateOrder($data = [], $id = null)
    {
        $result = parent::where('id', $id);
        if ($result->exists()) {
            if (isset($data['order_status_id'])) {
                $deliveryId = OrderStatus::orderBy('order_by', 'DESC')->first()->id;
                if ($deliveryId == $data['order_status_id']) {
                    $data['is_delivery'] = 1;
                } else {
                    $data['is_delivery'] = 0;
                }
            }
            $result->update($data);
            return true;
        }

        return false;
    }

    /**
     * Delete
     * @param string $id
     * @return array
     */
    public function remove($id = null)
    {
        $data = ['status' => 'fail', 'message' => __('Something went wrong, please try again.')];
        $record = parent::find($id);
        if (!empty($record)) {
            try {
                $record->delete();
                $data['status'] = 'success';
                $data['message'] = __('The :x has been successfully deleted.', ['x' => __('Order')]);
            } catch (Exception $e) {
                $data['message'] = $e->getMessage();
            }
        }

        return $data;
    }

    public static function getOrderReference($typeStr = "INV")
    {
        $invoice_count = parent::where('transaction_type', 'SALESINVOICE')->count();

        if ($invoice_count > 0) {
            $invoiceReference = parent::where('transaction_type', 'SALESINVOICE')
                ->latest('id')
                ->first(['reference']);
            $ref = str_replace($typeStr, '', $invoiceReference->reference);
            $invoice_count = (int)$ref;
        } else {
            $invoice_count = 0;
        }
        return $typeStr.sprintf("%04d", $invoice_count + 1);
    }

    /**
     * totalVendorItem
     *
     * @param $vendorId
     * @param $orderId
     * @return mixed
     */
    public function getTotalVendorItem($vendorId = null, $orderId = null)
    {
        return OrderDetail::where('vendor_id', $vendorId)->where('order_id', $orderId)->sum('quantity');
    }

    /**
     * payment status
     *
     * @param $total
     * @param $paid
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Translation\Translator|string|null
     */
    public function paymentStatus($total = 0, $paid = 0)
    {
        $payStatus =  __('Unpaid');
        if ($total == $paid) {
            $payStatus = __('Paid');
        } elseif ($paid > 0 && $paid < $total) {
            $payStatus = __('Partially Paid');
        }

        return $payStatus;
    }

    /**
     * vendorItemPrice
     *
     * @param $vendorId
     * @param $orderId
     * @return mixed
     */
    public function vendorItemPrice($vendorId = null, $orderId = null)
    {
        if (isActive('Coupon')) {
            $couponRedeem = CouponRedeem::where('order_id', $orderId)->first();
            if (!empty($couponRedeem) && optional($couponRedeem->coupon)->vendor_id == $vendorId) {
                $discountAmount = $couponRedeem->discount_amount;
                $totalAmount = $this->TotalPriceWithQty($vendorId, $orderId);
                return $totalAmount - $discountAmount;
            } else {
                return $this->TotalPriceWithQty($vendorId, $orderId);
            }
        } else {
            return $this->TotalPriceWithQty($vendorId, $orderId);
        }
    }

    /**
     * calculate price with qty
     *
     * @param $vendorId
     * @param $orderId
     * @return float|int
     */
    protected function TotalPriceWithQty($vendorId, $orderId)
    {
        $orderDetails = OrderDetail::where('vendor_id', $vendorId)->where('order_id', $orderId)->get();
        $totalAmount = 0;
        foreach ($orderDetails as $detail) {
            $totalAmount +=  $detail->price * $detail->quantity;
        }
        return $totalAmount;
    }

    /**
     * vendorShippingTaxCalculate
     *
     * @param $vendorId
     * @param $orderId
     * @return mixed
     */
    public function vendorItemShippingTax($vendorId = null, $orderId = null)
    {
        $shipping = OrderDetail::where('vendor_id', $vendorId)->where('order_id', $orderId)->sum('shipping_charge');
        $tax = OrderDetail::where('vendor_id', $vendorId)->where('order_id', $orderId)->sum('tax_charge');
        return ($shipping + $tax);
    }

    /**
     * vendor order item
     *
     * @param $vendorId
     * @param $orderId
     * @return mixed
     */
    public function vendorOrderItem($vendorId = null, $orderId = null)
    {
        return OrderDetail::where('vendor_id', $vendorId)->where('order_id', $orderId)->get();
    }

    /**
     * order commission
     *
     * @param $orderId
     * @return void
     */
    public function orderCommission($orderDetailId, $statusId)
    {
        $finalOrderStatus = Order::getFinalOrderStatus();
        $orderCommission = OrderCommission::where('order_details_id', $orderDetailId)->first();
        if (($finalOrderStatus) && $finalOrderStatus == $statusId && !empty($orderCommission)) {
            (new OrderCommission)->updateOrderCommission(['status' => 'Approve', 'approval_time' => date('Y-m-d H:i:s')], $orderCommission->id);

            $totalAmount = optional($orderCommission->orderDetail)->price * optional($orderCommission->orderDetail)->quantity;
            $totalCommission = ($orderCommission->amount * $totalAmount) / 100 ;
            /*order transaction*/
            $transactionExists = Transaction::where('transaction_type', 'Commission')->where('reference_number', optional($orderCommission->orderDetail)->id);
            if (!$transactionExists->exists()) {
                $transaction['user_id'] = Auth::user()->id;
                $transaction['currency_id'] = isset($orderCommission->orderDetail->order->currency_id) ? $orderCommission->orderDetail->order->currency_id : null;
                $transaction['order_id'] = isset($orderCommission->orderDetail->order->id) ? $orderCommission->orderDetail->order->id : null;
                $transaction['exchange_rate'] = isset($orderCommission->orderDetail->order->currency->exchange_rate) ? $orderCommission->orderDetail->order->currency->exchange_rate : null;
                $transaction['vendor_id'] = isset($orderCommission->orderDetail->vendor_id) ? $orderCommission->orderDetail->vendor_id : null;
                $transaction['shop_id'] = isset($orderCommission->orderDetail->shop_id) ? $orderCommission->orderDetail->shop_id : null;
                $transaction['total_amount'] = $totalCommission;
                $transaction['amount'] = $totalCommission;
                $transaction['reference_number'] = optional($orderCommission->orderDetail)->id;
                $transaction['transaction_type'] = "Commission";
                $transaction['transaction_date'] = now();
                $transaction['status'] = "Accepted";
                (new Transaction)->store($transaction);
            } elseif ($transactionExists->exists()) {
                $transactionData = $transactionExists->first();
                $transactionData->status = 'Accepted';
                $transactionData->save();
                (new OrderCommission)->updateOrderCommissionByOrder(['status' => 'Approve', 'approval_time' => date('Y-m-d H:i:s')], $orderDetailId);
            }

            /*order transaction*/
        }
    }

    public function TransactionId($orderId = null, $transactionType = 'Order')
    {
        $transaction = Transaction::where('order_id', $orderId)->where('transaction_type', $transactionType)->first();
        if (!empty($transaction)) {
            return $transaction->id;
        }
        return null;
    }

    public function deliveryDate($orderId = null, $statusId = null)
    {
        $orderDetail = OrderStatusHistory::where('order_id', $orderId)->where('order_status_id', $statusId)->whereNull('item_id')->orderBy('id', 'DESC')->first();
        if (!empty($orderDetail)) {
            return $orderDetail->created_at;
        }
        return null;
    }

    /**
     * send email
     *
     * @param $order
     * @return void
     */
    public function sendEmail($order = null, $type = "all")
    {
        $prefer = preference();
        $languageId = Language::getAll()->where('short_name', $prefer['dflt_lang'])->first()->id;
        /* for customer */
        if ($type == "customer" || $type == "all") {
            createDirectory("public/uploads/invoices");
            $invoiceName = 'invoice_' . time() . '.pdf';
            $this->invoicePdfEmail($order, $invoiceName);
            $parent = EmailTemplate::getAll()->where('slug', 'invoice')->where('language_id', $languageId)->first();
            $parentId = EmailTemplate::getAll()->where('slug', 'invoice')->first()->id;
            $emailInfo = !empty($parent) ? $parent : EmailTemplate::getAll()->where('parent_id', $parentId)->where('language_id', $languageId)->first();
            if (!empty($emailInfo)) {
                $subject =  $emailInfo->subject;
                $message =  $emailInfo->body;
                $subject = str_replace('{company_name}', $prefer['company_name'], $subject);
                $subject = str_replace('{invoice_reference_no}', $order->reference, $subject);
                $message = str_replace('{invoice_reference_no}', $order->reference, $message);
                $message = str_replace('{company_name}', $prefer['company_name'], $message);
                $message = str_replace('{customer_name}', optional($order->user)->name, $message);
                $message = str_replace('{currency}', optional($order->currency)->symbol, $message);
                $message = str_replace('{total_amount}', formatCurrencyAmount($order->total), $message);
                $message = str_replace('{paid_amount}', formatCurrencyAmount($order->paid), $message);
                $message = str_replace('{payment_method}', optional($order->paymentMethod)->gateway, $message);
                $customerEmailResponse = (new EmailController)->sendEmailWithAttachment(optional($order->user)->email, $subject, $message, $invoiceName, $prefer['company_name']);
            }
        }
        /* end for customer */
        if ($type == "vendor" || $type == "all") {
            /* for vendor */
            $parentVendor = EmailTemplate::getAll()->where('slug', 'vendor-invoice')->where('language_id', $languageId)->first();
            $parentIdVendor = EmailTemplate::getAll()->where('slug', 'vendor-invoice')->first()->id;
            $emailInfoVendor = !empty($parentVendor) ? $parentVendor : EmailTemplate::getAll()->where('parent_id', $parentIdVendor)->where('language_id', $languageId)->first();
            if (!empty($emailInfoVendor)) {
                foreach ($order->orderDetails->groupBy('vendor_id') as $key => $detail) {
                    $vendorId = $detail[0]->vendor_id ?? null;
                    $vendorEmail = $detail[0]->vendor->email ?? null;
                    $vendorName = $detail[0]->vendor->name ?? null;
                    $orderId = $detail[0]->order_id ?? null;
                    $subjectVendor =  $emailInfoVendor->subject;
                    $messageVendor =  $emailInfoVendor->body;
                    $subjectVendor = str_replace('{company_name}', $prefer['company_name'], $subjectVendor);
                    $subjectVendor = str_replace('{invoice_reference_no}', $order->reference, $subjectVendor);
                    $messageVendor = str_replace('{invoice_reference_no}', $order->reference, $messageVendor);
                    $messageVendor = str_replace('{company_name}', $prefer['company_name'], $messageVendor);
                    $messageVendor = str_replace('{customer_name}', optional($order->user)->name, $messageVendor);
                    $messageVendor = str_replace('{vendor_name}', $vendorName, $messageVendor);
                    $messageVendor = str_replace('{currency}', optional($order->currency)->symbol, $messageVendor);
                    $messageVendor = str_replace('{total_amount}', formatCurrencyAmount($detail[0]->order->vendorItemPrice($vendorId, $orderId) + $detail[0]->order->vendorItemShippingTax($vendorId, $orderId)), $messageVendor);
                    $messageVendor = str_replace('{payment_method}', optional($order->paymentMethod)->gateway, $messageVendor);
                    $vendorOrder = Order::where('id', $order->id)->whereHas("orderDetails", function ($q) use ($vendorId) {
                        $q->where('vendor_id', $vendorId);
                    })->with('orderDetails')->first();
                    if (!empty($vendorOrder)) {
                        $vendorInvoiceName = 'order_invoice_' . time() . '.pdf';
                        $this->invoicePdfEmail($vendorOrder, $vendorInvoiceName, 'vendor', $vendorId);
                        $vendorEmailResponse = (new EmailController)->sendEmailWithAttachment($vendorEmail, $subjectVendor, $messageVendor, $vendorInvoiceName, $prefer['company_name']);
                    }
                }

            }
            /* end for vendor */
        }
            if ($type == "vendor") {
                return $vendorEmailResponse['status'] ?? null;
            } elseif ($type == "customer") {
                return $customerEmailResponse['status'] ?? null;
            }
    }

    /**
     * generate & store pdf
     *
     * @param $order
     * @param $invoiceName
     * @return void
     */
    private function invoicePdfEmail($order = null, $invoiceName = null, $type = 'admin', $vendorId = null)
    {
        if (!empty($order)) {
            $data['orderStatus'] = OrderStatus::getAll()->sortBy('order_by');
            $data['order'] = $order;
            $data['type'] = 'pdf';
            if ($type == 'admin') {
                $data['orderDetails'] = $order->orderDetails;
                return printPDF($data, public_path() . '/uploads/invoices/' . $invoiceName, 'admin.orders.invoice_print', view('admin.orders.invoice_print', $data), null, "email");
            } elseif ($type == 'vendor') {
                $data['vendorId'] = $vendorId;
                return printPDF($data, public_path() . '/uploads/invoices/' . $invoiceName, 'vendor.orders.invoice_print', view('vendor.orders.invoice_print', $data), null, "email");
            }
        }

    }

    /**
     * get finalOrder status
     *
     * @return mixed
     */
    public static function getFinalOrderStatus()
    {
        $orderStatus = OrderStatus::getAll()->sortByDesc('order_by')->first();
        if (!empty($orderStatus)) {
            return $orderStatus->id;
        }
        return false;
    }

    public static function checkCashOnDelivery($data = null)
    {
        $response = ['status' => false, 'notAvailable' => true];
        if (isset($data['sending_details']->id)) {
            $itemIds = OrderDetail::select('item_id')->where('order_id', $data['sending_details']->id)->pluck('item_id')->toArray();
            $cashDeliveryData = ItemDetail::whereIn('item_id', $itemIds)->pluck('is_cash_on_delivery')->toArray();
            $response = ['status' => true, 'notAvailable' => in_array(0, $cashDeliveryData)];
        }
        return $response;
    }
}
