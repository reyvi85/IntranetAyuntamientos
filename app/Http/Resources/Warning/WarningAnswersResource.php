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
            'id'=>(string)$this->resource->id,
            'respuesta'=>$this->resource->answer,
            'fecha'=>date('Y-m-d H:m', strtotime($this->resource->created_at)),
           // 'link_self'=>route('api.answer.show', ['warningAnswer'=>$this->resource->id, 'token_inst'=>$request->token_inst]),
        ];
    }
}
