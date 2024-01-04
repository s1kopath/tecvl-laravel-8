<?php

namespace App\Http\Resources;

use App\Models\{
    ItemCrossSale,
    ItemRelate,
    ItemUpsale
};
use Illuminate\Http\Resources\Json\JsonResource;

class ItemDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $attributeData = [];
        $optionData = [];
        $relatedItems = [];
        $crossSale = [];
        $upSale = [];
        $item_relate  = ItemRelate::getAll()->where('item_id', $this->id);
        foreach ($item_relate as $relate) {
            $relatedItems[] = [
              "item" => [
                "id" => $relate->item_id,
                "name" => $relate->item->name,
              ],
              "related_item" => [
                    "id" => $relate->related_item_id,
                    "name" => $relate->relatedItem->name,
                ]
            ];
        }
        $item_cross  = ItemCrossSale::getAll()->where('item_id', $this->id);
        foreach ($item_cross as $cross) {
            $crossSale[] = [
                "item" => [
                    "id" => $cross->item_id,
                    "name" => $cross->item->name,
                ],
                "cross_item" => [
                    "id" => $cross->cross_sale_item_id,
                    "name" => $cross->crossItem->name,
                ]
            ];
        }
        $item_up  = ItemUpsale::getAll()->where('item_id', $this->id);
        foreach ($item_up as $up) {
            $upSale[] = [
                "item" => [
                    "id" => $up->item_id,
                    "name" => $up->item->name,
                ],
                "up_item" => [
                    "id" => $up->upsale_item_id,
                    "name" => $up->upItem->name,
                ]
            ];
        }
        if (isset($this->itemAttributes)) {
            foreach ($this->itemAttributes as $attributes) {
                $attributeData[] = [
                    'attribute' => [
                        "id" => $attributes->attribute_id,
                        "name" => optional($attributes->attribute)->name,
                        "type" => optional($attributes->attribute)->type,
                        "description" => optional($attributes->attribute)->description,
                    ],
                    'values'=> optional($attributes->attribute)->type == "multiple_select" ? json_decode($attributes->payloads) : $attributes->payloads
                ];
            }
        }
        if (isset($this->itemOption)) {
            foreach ($this->itemOption as $option) {
                $optionData[] = [
                    "name" => $option->name,
                    "type" => $option->type,
                    "order_by" => $option->order_by,
                    "is_required" => $option->is_required,
                    "payloads" => json_decode($option->payloads),
                ];
            }
        }
        return [
            'id' => $this->id,
            'name' => $this->name,
            'item_code' => $this->item_code,
            'sku' => $this->sku,
            'category' => isset($this->itemCategory->category->name) ? $this->itemCategory->category->name : null,
            'brand' => optional($this->brand)->name,
            'price' => $this->price,
            'available_from' => !empty($this->available_from) ? formatDate($this->available_from) : null,
            'available_to' => !empty($this->available_to) ? formatDate($this->available_to) : null,
            'description' => $this->description,
            'summary' => $this->summary,
            'attributeData' => $attributeData,
            "relatedItems" => $relatedItems,
            "cross_sale_items" => $crossSale,
            "up-sale_items" => $upSale,
            'option_data' => $optionData,
            'discount_amount' => $this->discount_amount,
            'discount_type' => $this->discount_type,
            'discounted_price' => $this->discounted_price,
            'discount_from' => $this->discount_from,
            'discount_to' => $this->discount_to,
            'maximum_discount_amount' => $this->maximum_discount_amount,
            'minimum_order_for_discount' => $this->minimum_order_for_discount,
            'status' => $this->status,
            'item_details' => $this->itemDetail ?? null,
            'created_at' => $this->format_created_at,
        ];
    }
}
