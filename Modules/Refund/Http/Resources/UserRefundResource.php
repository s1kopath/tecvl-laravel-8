<?php

/**
 * @package UserRefundResource
 * @author techvillage <support@techvill.org>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @created 03-04-2022
 */

namespace Modules\Refund\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserRefundResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request = [])
    {
        return [
            'order_id' => optional(optional($this->orderDetail)->order)->reference,
            'shipping' => $this->shipping_method,
            'refund_reason' => optional($this->refundReason)->name,
            'refund_method' => $this->refund_method,
            'amount' => $this->quantity_sent . 'x' . formatCurrencyAmount(optional(optional($this->orderDetail)->order)->total),
            'status' => $this->status,
        ];
    }
}
