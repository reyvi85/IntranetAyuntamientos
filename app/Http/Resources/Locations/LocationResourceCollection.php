<?php

namespace App\Http\Resources\Locations;

use Illuminate\Http\Resources\Json\ResourceCollection;

class LocationResourceCollection extends ResourceCollection
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
            'data'=>$this->collection,
            'categories'=>route('api.locationCategory.index', ['token_inst'=>$request->token_inst])

        ];
    }
}
