<?php
/**
 * @package SmsTemplateResource
 * @author techvillage <support@techvill.org>
 * @contributor Sakawat Hossain Rony <[sakawat.techvill@gmail.com]>
 * @created 16-08-2021
 */
namespace App\Http\Resources;

use App\Models\SmsTemplate;
use Illuminate\Http\Resources\Json\JsonResource;

class SmsTemplateResource extends JsonResource
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
            'name' => $this->slug,
            'status' => $this->status,
            'created_at' => $this->format_created_at,
        ];
    }
}
