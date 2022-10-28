<?php

namespace App\Http\Resources\Events;

use Illuminate\Http\Resources\Json\JsonResource;

class EventsResource extends JsonResource
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
            'id'=>(string)$this->resource->id,
            'evento'=>$this->resource->titulo,
            'imagen'=>asset($this->resource->imagen),
            'descripcion'=>$this->resource->description,
            'categoría'=>$this->resource->event_category->name,
            'latitud'=>$this->resource->lat,
            'longitud'=>$this->resource->lng,
            'url'=>$this->resource->link,
            'fecha_inicio'=>$this->resource->f_inicio,
            'fecha_fin'=>$this->resource->f_fin,
        ];
    }
}
