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
            'id'=>(string)$this->resource->id,
            'titulo'=>$this->resource->titulo,
            'subtitulo'=>$this->resource->subtitulo,
            'imagen'=>asset($this->resource->image),
            'url'=>$this->resource->enlace,
          //  'embed'=>$this->resource->embed,
          //  'slug'=>$this->resource->slug,
           // 'link_self'=>route('api.widgets.show',[$this->resource->id,'token_inst'=>$request->token_inst])

        ];
    }
}
