<?php

namespace App\Http\Resources\Notifications;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationCategoryResource extends JsonResource
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
            'type'=>'category-notification',
            'id'=>(string)$this->resource->id,
            'name'=>$this->resource->name,
            'link_notifications'=>route('api.notification.index',['category'=>$this->resource->id, 'token_inst'=>$request->token_inst]),
            'link_self'=>route('api.notificationCategory.show', [$this->resource->id, 'token_inst'=>$request->token_inst]),
            'notifications_count'=>$this->resource->notifications_count
        ];
    }
}
