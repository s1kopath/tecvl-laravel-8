<?php
/**
 * @package UserRefundDetailResource
 * @author techvillage <support@techvill.org>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @created 27-10-2021
 */
namespace Modules\Refund\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Refund\Entities\RefundReason;

class UserRefundDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $refundReasons = RefundReason::getAll()->where('status', 'Active')->pluck('name', 'id');
        return [
            'invoice' => optional($this->order)->reference,
            'price' => formatNumber($this->price),
            'quantity' => (int) $this->quantity,
            'order_date' => timezoneFormatDate($this->created_at),
            'payment' => __('Paid'),
            'status' => optional($this->orderStatus)->name,
            'item' => optional($this->item)->name,
            'picture_url' => optional($this->item)->fileUrl(),
            'reasons' => $refundReasons,
        ];
    }
}
