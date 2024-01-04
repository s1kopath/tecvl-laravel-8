<?php
/**
 * @package PackageResource
 * @author techvillage <support@techvill.org>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @created 01-09-2021
 * @modified 07-09-2021
 */

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PackageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request = [])
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'description' => $this->description,
            'params' => $this->params,
            'price' => $this->price,
            'billing_cycle' => $this->billing_cycle,
            'sort_order' => $this->sort_order,
        ];
    }
}
