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
        return [
            'type'=>'answer',
            'id'=>(string)$this->resource->id,
            'respuesta'=>$this->resource->answer,
            'link_self'=>route('api.answer.show', ['warningAnswer'=>$this->resource->id, 'token_inst'=>$request->token_inst]),
        ];
    }
}
