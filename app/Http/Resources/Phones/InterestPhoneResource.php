<?php

namespace App\Http\Resources\Phones;

use Illuminate\Http\Resources\Json\JsonResource;

class InterestPhoneResource extends JsonResource
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
            'type'=>'phone',
            'id'=>(string)$this->resource->id,
            'attributes'=>[
                'name'=>$this->resource->name,
                'description'=>$this->resource->description,
                'phone'=>$this->resource->phone
            ],
            'links'=>[
                'self'=>route('api.phones.show', $this->resource->id)
            ]
        ];
    }
}
