<?php

namespace App\Http\Resources\Routes;

use Illuminate\Http\Resources\Json\JsonResource;

class RouteIntermediateResourse extends JsonResource
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
            'name'=>$this->resource->name,
            'description'=>$this->resource->description,
            'address'=>$this->resource->address,
            'imagen'=>asset($this->resource->image)
        ];
    }
}
