<?php

namespace App\Http\Resources\Locations;

use Illuminate\Http\Resources\Json\JsonResource;

class LocationGalleryResource extends JsonResource
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
            'imagen'=>asset($this->resource->image),
        ];
    }
}
