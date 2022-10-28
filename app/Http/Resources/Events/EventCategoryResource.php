<?php

namespace App\Http\Resources\Events;

use Illuminate\Http\Resources\Json\JsonResource;

class EventCategoryResource extends JsonResource
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
            'name'=>$this->resource->name,
            'image'=>asset($this->resource->image),
            'events_count'=>$this->resource->events_count,
            'events_filter'=>route('event.index', ['category'=>$this->resource->id, 'token_inst'=>$request->token_inst])
        ];
    }
}
