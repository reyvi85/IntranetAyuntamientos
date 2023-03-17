<?php

namespace App\Http\Resources\Routes;

use Illuminate\Http\Resources\Json\JsonResource;

class RouteReserveResource extends JsonResource
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
            'user_id'=>$this->resource->user_id,
            'route_id'=>$this->resource->route_id,
            'ruta'=>$this->resource->route->name,
            'imagen'=>asset($this->resource->route->imagen),
            'num_person'=>$this->resource->num_person,
            'costo'=>(string)$this->resource->cost,
            'fecha_reserva'=>$this->resource->fecha_reserva
        ];
    }
}
