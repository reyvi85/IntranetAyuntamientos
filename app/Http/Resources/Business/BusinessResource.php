<?php

namespace App\Http\Resources\Business;

use Illuminate\Http\Resources\Json\JsonResource;

class BusinessResource extends JsonResource
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
            'type'=>'business',
            'id'=>$this->resource->id,
            'name'=>$this->resource->name,
            'direccion'=>$this->resource->direccion,
            'telefono'=>$this->resource->telefono,
            'email'=>$this->resource->email,
            'logo'=>url($this->resource->logo),
            'description'=>$this->resource->description,
            'url_web'=>$this->resource->url_web,
            'slug'=>$this->resource->slug,
            'categoria'=>$this->resource->category_busine->name,
            'link_category'=>route('api.bussinessCategory.show',[$this->resource->category_busine_id, 'token_inst'=>$request->token_inst]),
            'link_categories'=>route('api.bussinessCategory.index', ['token_inst'=>$request->token_inst]),
            'link_self'=>route('api.bussiness.show', [$this->resource->id, 'token_inst'=>$request->token_inst]),
        ];
    }
}
