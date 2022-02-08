<?php

namespace App\Http\Resources\Warning;

use Illuminate\Http\Resources\Json\JsonResource;

class WarningCategoryResource extends JsonResource
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
            'type'=>'category',
            'id'=>(string)$this->resource->id,
            'name'=>$this->resource->name,
            'sub-category-count'=>$this->resource->sub_categories_count,
           // 'sub-category'=>WarningSubCategoryResourceCollection::make($this->resource->sub_categories),

            'relationships'=>[
                'sub-category'=>[
                    'links'=>[
                        'self'=>route('api.subcategory.index', [$this->resource->id, 'token_inst'=>$request->token_inst]),
                    ],
                ],
            ],
            'links'=>[
                'self'=>route('api.category.show', $this->resource->id)
            ],
            'meta'=>['sub-category-count'=>$this->resource->sub_categories_count]
        ];
    }
}
