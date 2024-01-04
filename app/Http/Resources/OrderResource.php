<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request = [])
    {
        return [
            'id' => $this->id,
            'invoice_id' => $this->reference,
            'item_price' => formatCurrencyAmount($this->total),
            'status' => $this->status,
            'created_at' => timeZoneformatDate($this->created_at)
        ];
    }
}
