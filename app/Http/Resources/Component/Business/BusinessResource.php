<?php

namespace App\Http\Resources\Component\Business;

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
            'attributes'=>[
                'name'=>$this->resource->name,
                'direccion'=>$this->resource->direccion,
                'telefono'=>$this->resource->telefono,
                'email'=>$this->resource->email,
                'logo'=>url($this->resource->logo),
                'description'=>$this->resource->description,
                'url_web'=>$this->resource->url_web,
                'slug'=>$this->resource->slug,
                'categoria'=>$this->resource->category_busine->name,
            ]
        ];
    }
}
