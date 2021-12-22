<?php

namespace App\Http\Resources\Component\Business;

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
                'slug'=>$this->resource->slug,
            ],
            'link'=>[
                'self'=>route('api.component.business', ['category'=>$this->resource->id,'token_inst'=>$request->token_inst])
            ]
        ];
    }
}
