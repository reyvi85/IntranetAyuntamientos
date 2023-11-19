<?php

namespace App\Http\Resources\Instances;

use Illuminate\Http\Resources\Json\JsonResource;

class InstancesResource extends JsonResource
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
            'id'=>$this->resource->id,
            'nombre'=>$this->resource->name,
            'key'=>$this->resource->key,
            'descripcion'=>$this->resource->description,
            'imagen'=>asset($this->resource->imagen),
            'comunidad'=>$this->resource->province->community->name,
            'provincia'=>$this->resource->province->name,
            'municipio'=>$this->resource->municipio,
            'barrio'=>$this->resource->barrio,
            'postalCode'=>$this->resource->postal_code,
            'latitud'=>$this->resource->lat,
            'longitud'=>$this->resource->lng,
            'color_title'=>$this->resource->color_title,
            'color_sub_title'=>$this->resource->color_sub_title,
            'background_color_dark'=>$this->resource->background_color_dark,
            'background_color_dark_plus'=>$this->resource->background_color_dark_plus,
            'background_color_light'=>$this->resource->background_color_light,
            'modulos'=>$this->resource->modulos
        ];
    }
}
