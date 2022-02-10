<?php

namespace App\Http\Resources\Widgets;

use Illuminate\Http\Resources\Json\ResourceCollection;

class WidgetsResourceCollection extends ResourceCollection
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
            'widgets'=>route('api.widgets.index', ['token_inst'=>$request->token_inst])
        ];
    }
}
