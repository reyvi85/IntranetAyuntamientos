<?php

namespace App\Http\Resources\Warning;

use Illuminate\Http\Resources\Json\ResourceCollection;

class WarningAnswersResourceCollection extends ResourceCollection
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
            'links'=>[
                'related'=>route('api.answer.index', $request->id)
            ]
        ];
    }
}
