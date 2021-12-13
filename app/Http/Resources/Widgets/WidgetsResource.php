<?php

namespace App\Http\Resources\Widgets;

use Illuminate\Http\Resources\Json\JsonResource;

class WidgetsResource extends JsonResource
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
            'type'=>'widget',
            'id'=>(string)$this->resource->id,
            'attributes'=>[
                'titulo'=>$this->resource->titulo,
                'subtitulo'=>$this->resource->subtitulo,
                'image'=>url($this->resource->titulo),
                'url'=>$this->resource->enlace,
                'embed'=>$this->resource->embed,
                'slug'=>$this->resource->slug,
            ],
            'links'=>[
                'self'=>route('api.widgets.show',$this->resource->id)
            ]
        ];
    }
}
