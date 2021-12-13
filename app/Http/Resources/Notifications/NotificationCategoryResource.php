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
            'attributes'=>[
                'name'=>$this->resource->name
            ],
            'relationships'=>[
                'notification'=>[
                    'links'=>[
                        'self'=>route('api.notification.index',['category'=>$this->resource->id]),
                    ],
                ],
            ],
            'links'=>[
                'self'=>route('api.notificationCategory.show', $this->resource->id)
            ]
        ];
    }
}
