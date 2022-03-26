<?php

namespace App\Http\Resources\Warning;

use Illuminate\Http\Resources\Json\ResourceCollection;

class WarningCategoryResourceCollection extends ResourceCollection
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
         /*   'links'=>[
                'self'=>route('api.category.index', ['token_inst'=>$request->token_inst]),
            ],
            'meta'=>[
                'category_count'=>$this->collection->count()
            ]*/
        ];
    }
}
