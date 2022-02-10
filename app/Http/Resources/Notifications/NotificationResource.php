<?php

namespace App\Http\Resources\Notifications;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
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
            'type'=>'notification',
            'id'=>(string)$this->resource->id,
            'titulo'=>$this->resource->titulo,
            'description'=>$this->resource->description,
            'fecha_publicacion'=>$this->resource->fecha_publicacion,
            'category_id'=>$this->resource->category_notification->id,
            'category_name'=>$this->resource->category_notification->name,
            'link_category'=>route('api.notificationCategory.show',[$this->resource->category_notification->id, 'token_inst'=>$request->token_inst]),
            'link_categories'=>route('api.notificationCategory.index',['token_inst'=>$request->token_inst]),
            'link_self'=>route('api.notification.show', [$this->resource->id, 'token_inst'=>$request->token_inst])
        ];
    }
}
