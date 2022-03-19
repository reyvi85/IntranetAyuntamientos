<?php

namespace App\Http\Resources\Warning;

use Illuminate\Http\Resources\Json\JsonResource;

class WarningSubCategoryResource extends JsonResource
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
            'id'=>(string)$this->resource->id,
            'name'=>$this->resource->name,
            'link_self'=>route('api.subcategory.show', [$this->resource->id, 'token_inst'=>$request->token_inst]),
            'link_category'=>route('api.category.show', [$this->resource->warning_category_id, 'token_inst'=>$request->token_inst])

        ];
    }
}
