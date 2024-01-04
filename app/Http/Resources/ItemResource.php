<?php
/**
 * @package ItemResource
 * @author techvillage <support@techvill.org>
 * @contributor Sakawat Hossain Rony <[sakawat.techvill@gmail.com]>
 * @created 28-10-2021
 */
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'item_code' => $this->item_code,
            'sku' => $this->sku,
            'category' => optional(optional($this->itemCategory)->category)->name,
            'brand' => optional($this->brand)->name,
            'price' => formatNumber($this->price),
            'available_from' => !empty($this->available_from) ? formatDate($this->available_from) : null,
            'available_to' => !empty($this->available_to) ? formatDate($this->available_to) : null,
            'description' => $this->description,
            'summary' => $this->summary,
            'status' => $this->status,
            'created_at' => $this->format_created_at,
            'image' => $this->fileUrl(),
        ];
    }
}
