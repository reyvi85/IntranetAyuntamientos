<?php

namespace App\Http\Resources\Locations;

use Illuminate\Http\Resources\Json\JsonResource;

class LocationCategoryResource extends JsonResource
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
            'id'=>$this->resource->id,
            'attributes'=>[
                'name'=>$this->resource->name,
                'image'=>url($this->resource->image),
            ],
            'relationships'=>[
                'location'=>[
                    'links'=>[
                        'self'=>route('api.location.index',['category'=>$this->resource->id]),
                    ],
                ],
            ],
            'links'=>[
                'self'=>route('api.locationCategory.show',$this->resource->id)
            ]
        ];
    }
}
