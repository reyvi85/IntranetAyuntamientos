<?php

namespace App\Http\Resources\Routes;
use Illuminate\Http\Resources\Json\JsonResource;

class RouteResourse extends JsonResource
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
            'name'=>$this->resource->name,
            'description'=>$this->resource->description,
            'imagen'=>asset($this->resource->imagen),
            'state'=>(boolean)$this->resource->state,
            'price'=>($this->resource->price == 0)?"0.0":$this->resource->price,
            'inicio_ruta_name'=>$this->resource->inicio_ruta_name,
            'inicio_ruta_direccion'=>$this->resource->inicio_ruta_direccion,
            'inicio_ruta_description'=>$this->resource->inicio_ruta_description,
            'inicio_ruta_imagen'=>asset($this->resource->inicio_ruta_imagen),
            'fin_ruta_name'=>$this->resource->fin_ruta_name,
            'fin_ruta_direccion'=>$this->resource->fin_ruta_direccion,
            'fin_ruta_description'=>$this->resource->fin_ruta_description,
            'fin_ruta_imagen'=>asset($this->resource->fin_ruta_imagen),
            'route_intermediate'=>RouteIntermediateResourseCollection::make($this->resource->route_intermediates),
            'route_category_name'=>$this->resource->route_category->name,
            'route_category_id'=>$this->resource->route_category_id,
        ];
    }
}
