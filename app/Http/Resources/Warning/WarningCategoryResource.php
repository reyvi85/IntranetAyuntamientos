<?php

namespace App\Http\Resources\Warning;

use Illuminate\Http\Resources\Json\JsonResource;

class WarningCategoryResource extends JsonResource
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
            'type'=>'category',
            'id'=>(string)$this->resource->id,
            'attributes'=>[
                'name'=>$this->resource->name
            ],
            'relationships'=>[
                'sub-category'=>[
                    'links'=>[
                        'self'=>route('api.subcategory.index', $this->resource->id),
                    ],
                ],
            ],
            'links'=>[
                'self'=>route('api.category.show', $this->resource->id)
            ]
        ];
    }
}
