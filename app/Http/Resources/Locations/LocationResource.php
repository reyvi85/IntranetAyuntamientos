<?php

namespace App\Http\Resources\Locations;

use Illuminate\Http\Resources\Json\JsonResource;

class LocationResource extends JsonResource
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
            //'type'=>'location',
            'id'=>(string)$this->resource->id,
            'name'=>$this->resource->name,
            'description'=>$this->resource->description,
            'direccion'=>$this->resource->ubicacion,
            'telefono'=>$this->resource->telefono,
            'web'=>$this->resource->web,
            'image'=>url($this->resource->image),
            'visitantes'=>($this->resource->visitantes)?true:false,
            'residentes'=>($this->resource->residentes)?true:false,
            'inicio'=>($this->resource->inicio)?true:false,
            'latitud'=>$this->resource->lat,
            'longitud'=>$this->resource->lng,
            'latlng'=>$this->resource->GeoLocate,
            'category_id'=>$this->resource->location_category->id,
            'category_name'=>$this->resource->location_category->name,
            'link_category'=>route('api.locationCategory.show', [$this->resource->location_category_id, 'token_inst'=>$request->token_inst]),
            'links_location_self'=>route('api.location.show',[$this->resource, 'token_inst'=>$request->token_inst])
        ];
    }
}
