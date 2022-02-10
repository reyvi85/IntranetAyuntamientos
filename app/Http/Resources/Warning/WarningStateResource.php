<?php

namespace App\Http\Resources\Warning;

use Illuminate\Http\Resources\Json\JsonResource;

class WarningStateResource extends JsonResource
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
            'type'=>'state',
            'id'=>(string)$this->resource->id,
            'name'=>$this->resource->name,
            'warning_filter'=>route('api.warning.index',['state'=>$this->resource->id, 'token_inst'=>$request->token_inst]),
            'warning_count'=>$this->resource->warnings_count

        ];
    }
}
