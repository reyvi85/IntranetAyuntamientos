<?php

namespace App\Http\Resources\Business;

use Illuminate\Http\Resources\Json\JsonResource;

class BusinessCategoryResource extends JsonResource
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
            'type'=>'category-busines',
            'id'=>$this->resource->id,
            'attributes'=>[
                'name'=>$this->resource->name,
                'slug'=>$this->resource->slug
            ],
            'relationships'=>[
                'busine'=>[
                    'links'=>[
                        'self'=>route('api.bussinessCategory.index',['category'=>$this->resource->id]),
                    ],
                ],
            ],
            'links'=>[
                'self'=>route('api.bussinessCategory.show',$this->resource->id),
            ]

        ];
    }
}
