<?php

namespace App\Http\Resources\Warning;

use Illuminate\Http\Resources\Json\JsonResource;

class WarningAnswersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       // dd($this->resource);
        return [
            'type'=>'answer',
            'id'=>(string)$this->resource->id,
            'attributes'=>[
                'respuesta'=>$this->resource->answer
            ],
            'relationships'=>[
                'warning'=>[
                    'data'=>['type'=>'warning', 'id'=>(string)$this->resource->warning_id],
                    'links'=>['related'=>route('api.warning.show',$this->resource->warning_id)]
                ],
            ],
            'links'=>[
                'self'=>route('api.answer.show', ['warningAnswer'=>$this->resource->id])
            ]
        ];
    }
}
