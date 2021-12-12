<?php

namespace App\Http\Resources\Warning;

use Illuminate\Http\Resources\Json\JsonResource;

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
            'attributes'=>[
                'asunto'=>$this->resource->asunto,
                'description'=>$this->resource->description,
                'ubicacion'=>$this->resource->ubicacion,
                'image'=>$this->resource->image,
                'latitud'=>$this->resource->lat,
                'longitud'=>$this->resource->lng,
                'categoria'=>$this->resource->warning_sub_category->warning_category->name,
                'sub_categoria'=>$this->resource->warning_sub_category->name,
                'estado'=>$this->resource->warning_state->name
            ],

            'relationships'=>[
                'warning_category'=>[
                'data'=>['type'=>'warning_category', 'id'=>(string)$this->resource->warning_sub_category->warning_category->id],
                'links'=>['related'=>route('api.category.index')],
                'meta'=>['name'=>$this->resource->warning_sub_category->warning_category->name]
                ],
                'warning_sub_category'=>[
                    'data'=>['type'=>'warning_sub_category', 'id'=>(string)$this->resource->warning_sub_category->id],
                    'links'=>['self'=>''],
                    'meta'=>['name'=>$this->resource->warning_sub_category->name]
                ],

                'warning_state'=>[
                    'data'=>['type'=>'warning_state', 'id'=>(string)$this->resource->warning_state->id],
                    'links'=>['self'=>'', 'related'=>''],
                    'meta'=>['name'=>$this->resource->warning_state->name]
                ],
                'warning_answers'=>[
                    'links'=>['self'=>route('api.answer.index', $this->resource->id)]
                ]
            ],
            'links'=>['self'=>route('api.warning.show', $this->resource->id)]
        ];
    }
}
