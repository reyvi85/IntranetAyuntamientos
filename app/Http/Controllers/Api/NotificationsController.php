<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Notifications\NotificationCategoryResource;
use App\Http\Resources\Notifications\NotificationCategoryResourceCollection;
use App\Http\Resources\Notifications\NotificationResource;
use App\Http\Resources\Notifications\NotificationResourceCollection;
use App\Models\CategoryNotification;
use App\Models\Notification;
use App\Traits\DataAPI;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    use DataAPI;


    public function index(Request $request){
        return NotificationResourceCollection::make($this->getAllNotifications($request->search, $request->category, $request->sort, $request->perPage));
    }

    public function notificationShow(Notification $notification){
        return NotificationResource::make($notification);
    }

    public function notificationCategoryIndex(){
        return NotificationCategoryResourceCollection::make($this->getAllNotificationsCategory());
    }

    public function notificationCategoryShow(CategoryNotification $categoryNotification)
    {
        return NotificationCategoryResource::make($categoryNotification);
    }
}
