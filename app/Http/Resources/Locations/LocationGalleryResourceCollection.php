<?php

namespace App\Http\Resources\Locations;

use Illuminate\Http\Resources\Json\ResourceCollection;

class LocationGalleryResourceCollection extends ResourceCollection
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
           'data'=>$this->collection
        ];
    }
}
