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
            'name'=>$this->resource->name,
            'slug'=>$this->resource->slug,
            'link_business'=>route('api.bussiness.index',['category'=>$this->resource->id, 'token_inst'=>$request->token_inst]),
            'link_self'=>route('api.bussinessCategory.show', [$this->resource->id, 'token_inst'=>$request->token_inst]),
            'business_count'=>$this->resource->business_count
        ];
    }
}
