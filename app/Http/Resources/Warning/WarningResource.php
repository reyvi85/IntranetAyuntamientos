<?php

namespace App\Http\Resources\Warning;

use Illuminate\Http\Resources\Json\JsonResource;
use function Livewire\str;

class WarningResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       // dd($this->resource->warning_answers);
        return[
            'type'=>'warning',
            'id'=>(string)$this->resource->id,
            'asunto'=>$this->resource->asunto,
            'description'=>$this->resource->description,
            'ubicacion'=>$this->resource->ubicacion,
            'image'=>$this->resource->image,
            'latitud'=>$this->resource->lat,
            'longitud'=>$this->resource->lng,
            'categoria'=>$this->resource->warning_sub_category->warning_category->name,
            'sub_categoria'=>$this->resource->warning_sub_category->name,
            'estado'=>$this->resource->warning_state->name,
            'fecha'=>date('Y-m-d', strtotime($this->resource->created_at)),

            'relationships'=>[
                'category'=>[
                    'type'=>'category',
                    'id'=>(string)$this->resource->warning_sub_category->warning_category->id,
                    'name'=>$this->resource->warning_sub_category->warning_category->name,
                    'link_self'=>route('api.category.show', [$this->resource->warning_sub_category->warning_category->id, 'token_inst'=>$request->token_inst]),
                    'link_categories'=>route('api.category.index',['token_inst'=>$request->token_inst]),
                    'link_sub_categories'=>route('api.subcategory.index',[$this->resource->warning_sub_category->warning_category->id, 'token_inst'=>$request->token_inst])
                 ],
                'sub-category'=>[
                   'type'=>'sub-category',
                   'id'=>(string)$this->resource->warning_sub_category->id,
                   'name'=>$this->resource->warning_sub_category->name,
                   'link_self'=>route('api.subcategory.show', [$this->resource->warning_sub_category->id, 'token_inst'=>$request->token_inst]),
                ],

                'state'=>[
                    'type'=>'state',
                    'id'=>(string)$this->resource->warning_state->id,
                    'name'=>$this->resource->warning_state->name,
                    'link_self'=>route('api.state.show',[$this->resource->warning_state->id,'token_inst'=>$request->token_inst]),
                    'link_state'=>route('api.state.index', ['token_inst'=>$request->token_inst])
                    ],

                'answers'=>WarningAnswersResourceCollection::make($this->resource->warning_answers)
                    //['links'=>['self'=>route('api.answer.index', [$this->resource->id, 'token_inst'=>$request->token_inst])]

            ],
            'link_self'=>route('api.warning.show', [$this->resource->id, 'token_inst'=>$request->token_inst])
        ];
    }
}
