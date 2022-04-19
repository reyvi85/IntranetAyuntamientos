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
            'id'=>(string)$this->resource->id,
            'asunto'=>$this->resource->asunto,
            'description'=>$this->resource->description,
            'ubicacion'=>$this->resource->ubicacion,
            'image'=>$this->resource->image,
            'latitud'=>$this->resource->lat,
            'longitud'=>$this->resource->lng,
            'latlng'=>$this->resource->GeoLocate,
            'categoria'=>$this->resource->warning_sub_category->warning_category->name,
            'sub_categoria'=>$this->resource->warning_sub_category->name,
            'estado'=>$this->resource->warning_state->name,
            'fecha'=>date('Y-m-d', strtotime($this->resource->created_at)),
            'answers_count'=>$this->resource->warning_answers->count(),
            'answers'=>WarningAnswersResourceCollection::make($this->resource->warning_answers),
           // 'link_self'=>route('api.warning.show', [$this->resource->id, 'token_inst'=>$request->token_inst])
        ];
    }
}
