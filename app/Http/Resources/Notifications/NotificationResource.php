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
            'attributes'=>[
                'titulo'=>$this->resource->titulo,
                'description'=>$this->resource->description,
                'fecha_publicacion'=>$this->resource->fecha_publicacion,
                'categoria'=>$this->resource->category_notification->name,
            ],
            'relationships'=>[
                'category'=>[
                    'links'=>[
                        'self'=>route('api.notificationCategory.show',$this->resource->category_notification->id)
                    ],
                ],
            ],
            'links'=>[
                'self'=>route('api.notification.show', $this->resource->id)
            ]
        ];
    }
}
