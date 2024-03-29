<?php

namespace App\Http\Resources\Events;

use Illuminate\Http\Resources\Json\ResourceCollection;

class EventsResourceCollection extends ResourceCollection
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
            'categorias'=>[
                'link'=>route('event.category', ['token_inst'=>$request->token_inst])
            ]
        ];
    }
}
