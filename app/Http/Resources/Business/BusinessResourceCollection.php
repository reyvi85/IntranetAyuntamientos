<?php

namespace App\Http\Resources\Business;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BusinessResourceCollection extends ResourceCollection
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
            'meta'=>[
                'categorias'=>route('api.bussinessCategory.index', ['token_inst'=>$request->token_inst]),
            ]
        ];
    }
}
