<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaxResource extends JsonResource
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
            'name' => $this->name,
            'tax_rate' => formatCurrencyAmount($this->tax_rate),
            'is_default' => $this->is_default == 1 ? __('Yes') : __('No'),
        ];
    }
}
