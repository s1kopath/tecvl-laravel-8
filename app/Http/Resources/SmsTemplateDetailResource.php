<?php

namespace App\Http\Resources;

use App\Models\Language;
use App\Models\SmsTemplate;
use Illuminate\Http\Resources\Json\JsonResource;

class SmsTemplateDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request = [])
    {
        $childTemplates = SmsTemplate::getAll()->where('parent_id', $this->id);
        $childs         = [];
        foreach ($childTemplates as $key => $value) {
            $childs[] = [
                'language' => $this->when(isset($value->language_id) && !empty($value->language_id), Language::where('id', $value->language_id)->first(['id', 'short_name'])),
                'body' => $value->body,
            ];
        }
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'body' => $this->body,
            'language' => $this->when(isset($this->language_id) && !empty($this->language_id), Language::where('id', $this->language_id)->first(['id', 'short_name'])),
            'variables' => $this->variables,
            'status' => $this->status,
            'created_at' => $this->format_created_at,
            'childs' => $childs,
        ];
    }
}
