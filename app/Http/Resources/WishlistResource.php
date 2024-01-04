<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WishlistResource extends JsonResource
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
            'image' => optional($this->item)->fileUrl(),
            'item_name' => optional($this->item)->name,
            'item_price' => formatCurrencyAmount(optional($this->item)->price),
            'item_availability' => $this->item->stock_availability,
            'created_at' => timeZoneformatDate($this->created_at)
        ];
    }
}
