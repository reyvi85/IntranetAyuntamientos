<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Notifications\NotificationResource;
use App\Http\Resources\Notifications\NotificationResourceCollection;
use App\Models\Notification;
use App\Traits\DataAPI;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    use DataAPI;

    public function index(Request $request){
        return NotificationResourceCollection::make($this->getAllNotifications(null, null, null, null));
    }

    public function notificationShow(Notification $notification){
        return NotificationResource::make($notification);
    }
}
