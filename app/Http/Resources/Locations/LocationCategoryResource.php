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
            'name'=>$this->resource->name,
            'image'=>url($this->resource->image),
            'link_location'=>route('api.location.index',['category'=>$this->resource->id, 'token_inst'=>$request->token_inst]),
            'link_self'=>route('api.locationCategory.show',[$this->resource->id, 'token_inst'=>$request->token_inst]),
            'location_count'=>$this->resource->locations_count

        ];
    }
}
