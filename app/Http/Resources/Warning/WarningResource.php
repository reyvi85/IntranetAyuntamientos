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
            'attributes'=>[
                'asunto'=>$this->resource->asunto,
                'description'=>$this->resource->description,
                'ubicacion'=>$this->resource->ubicacion,
                'image'=>$this->resource->image,
                'latitud'=>$this->resource->lat,
                'longitud'=>$this->resource->lng,
                'categoria'=>$this->resource->warning_sub_category->warning_category->name,
                'sub_categoria'=>$this->resource->warning_sub_category->name,
                'estado'=>$this->resource->warning_state->name,
                'fecha'=>date('Y-m-d', strtotime($this->resource->created_at))
            ],

            'relationships'=>[
                'category'=>[
                'data'=>['type'=>'category', 'id'=>(string)$this->resource->warning_sub_category->warning_category->id],
                'links'=>[
                    'self'=>route('api.category.show', $this->resource->warning_sub_category->warning_category->id),
                    'related'=>route('api.category.index')
                ],
                'meta'=>['name'=>$this->resource->warning_sub_category->warning_category->name]
                ],
                'sub-category'=>[
                    'data'=>['type'=>'sub-category', 'id'=>(string)$this->resource->warning_sub_category->id],
                    'links'=>['self'=>route('api.subcategory.show', $this->resource->warning_sub_category->id)],
                    'meta'=>['name'=>$this->resource->warning_sub_category->name]
                ],

                'state'=>[
                    'data'=>['type'=>'state', 'id'=>(string)$this->resource->warning_state->id],
                    'links'=>[
                        'self'=>route('api.state.show',$this->resource->warning_state->id),
                        'related'=>route('api.state.index')
                    ],
                    'meta'=>['name'=>$this->resource->warning_state->name]
                ],
                'answers'=>[
                    'links'=>['self'=>route('api.answer.index', $this->resource->id)]
                ]
            ],
            'links'=>['self'=>route('api.warning.show', $this->resource->id)]
        ];
    }
}
