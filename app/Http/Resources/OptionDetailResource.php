<?php
/**
 * @package OptionDetailResource
 * @author techvillage <support@techvill.org>
 * @contributor Sakawat Hossain Rony <[sakawat.techvill@gmail.com]>
 * @created 27-10-2021
 */
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OptionDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $optionValue = [];
        foreach ($this->option as $option) {
            $optionValue[] = [
                "id" => $option->id,
                "option" => $option->option,
                "is_default" => $option->is_default,
                "price" => formatCurrencyAmount($option->price),
                "price_type" => $option->price_type,
                "status" => $option->status,
                "order_by" => $option->order_by
            ];
        }
        return [
            'id' => $this->id,
            'name' => $this->name,
            'category' => optional($this->category)->name,
            'type' => ucwords(str_replace("_"," ",$this->type)),
            'is_required' => $this->is_required == 1 ? __('Yes') : __('No'),
            'created_at' => $this->format_created_at,
            'values' => $optionValue,
        ];
    }
}
