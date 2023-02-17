<?php

namespace App\Http\Resources\Routes;

use Illuminate\Http\Resources\Json\JsonResource;

class RouteCategoryResourse extends JsonResource
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
            'id'=>(string) $this->resource->id,
            'name'=>$this->resource->name,
            'route_count'=>$this->resource->routes_count
        ];
    }
}
