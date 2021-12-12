<?php

namespace App\Http\Resources\Warning;

use Illuminate\Http\Resources\Json\ResourceCollection;

class WarningSubCategoryResourceCollection extends ResourceCollection
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
            'relationships'=>[
                'sub-category'=>[
                    'links'=>[
                        'self'=>route('api.category.show', $request->warningCategory),
                    ],
                ],
            ],
            'meta'=>[
                'sub_categories_count'=>(string)$this->collection->count(),
            ]


        ];
    }
}
