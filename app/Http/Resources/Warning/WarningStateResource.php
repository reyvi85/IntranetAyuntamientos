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
            'attributes'=>[
                'name'=>$this->resource->name
            ],
            'relationships'=>[
                'warning'=>[
                    'links'=>[
                        'self'=>route('api.warning.index',['state'=>$this->resource->id]),
                    ],
                ],
            ],
            'meta'=>[
                'warning_count'=>$this->resource->warnings_count
            ]
        ];
    }
}
