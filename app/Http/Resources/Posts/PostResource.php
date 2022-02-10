<?php

namespace App\Http\Resources\Posts;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return[
            'type'=>'post',
            'id'=>(string)$this->resource->id,
            'titulo'=>$this->resource->titulo,
            'subtitulo'=>$this->resource->subtitulo,
            'contenido'=>$this->resource->contenido,
            'image'=>url($this->resource->image),
            'inicia'=>$this->resource->fecha_inicio,
            'termina'=>$this->resource->fecha_fin,
            'visitantes'=>($this->resource->visitantes)?true:false,
            'residentes'=>($this->resource->residentes)?true:false,
            'inicio'=>($this->resource->inicio)?true:false,
            'slug'=>$this->resource->slug,
            'link_self'=>route('api.post.show', [$this->resource, 'token_inst'=>$request->token_inst])
        ];
    }
}
