<?php

namespace App\Http\Resources\Routes;

use Illuminate\Http\Resources\Json\ResourceCollection;

class RouteResourseCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data'=>$this->resource
        ];
    }
}
