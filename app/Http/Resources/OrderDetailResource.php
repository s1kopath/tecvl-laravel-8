<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request = [])
    {
        $itemInfo = [];
        foreach ($this->orderDetails as $key => $details) {
            $itemInfo[] = ['name' => $details->item->name, 'quantity' => (int)$details->quantity, 'price' => optional($this->currency)->symbol.formatCurrencyAmount($details->item->price)];
        }

        return [
            'id' => $this->id,
            'invoice_id' => $this->reference,
            'item_price' => formatCurrencyAmount($this->total),
            'status' => $this->status,
            'created_at' => timeZoneformatDate($this->created_at),
            'shipping' => [
                'first_name' => optional($this->address)->first_name,
                'last_name' => optional($this->address)->last_name,
                'phone' => optional($this->address)->phone,
                'city' => optional($this->address)->city,
                'address1' => optional($this->address)->address_1,
                'address2' => optional($this->address)->address_2,
            ],
            'billing' => [
                'name' => optional($this->user)->name,
                'email' => optional($this->user)->email,
                'phone' => optional($this->user)->phone,
                'address' => optional($this->user)->address,
            ],
            'payment' => [
                'status' => $this->total == $this->paid ? __('Paid') : __('Unpaid'),
                'paid_amount' => optional($this->currency)->symbol.formatCurrencyAmount($this->paid),
                'vat' => '0',
                'method' => __('Cash')
            ],
            'items' => $itemInfo,
            'sub_total' =>  optional($this->currency)->symbol.formatCurrencyAmount($this->total),
            'shipping_charge' => '0',
            'total' =>  optional($this->currency)->symbol.formatCurrencyAmount($this->total)
        ];
    }
}
