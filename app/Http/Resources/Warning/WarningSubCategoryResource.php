<?php

namespace App\Http\Resources\Warning;

use Illuminate\Http\Resources\Json\JsonResource;

class WarningSubCategoryResource extends JsonResource
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
            'type'=>'sub-category',
            'id'=>(string)$this->resource->id,
            'attributes'=>[
                'name'=>$this->resource->name,
            ],
            'links'=>[
                'self'=>route('api.subcategory.show', $this->resource->id)
            ]
        ];
    }
}
