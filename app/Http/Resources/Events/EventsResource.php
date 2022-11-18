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
            'categoria'=>$this->resource->event_category->name,
            'category_id'=>(string)$this->resource->event_category_id,
            'latitud'=>$this->resource->lat,
            'longitud'=>$this->resource->lng,
            'url'=>$this->resource->link,
            'fecha_inicio'=>(string)$this->resource->f_inicio,
            'fecha_fin'=>(string)$this->resource->f_fin,
        ];
    }
}
