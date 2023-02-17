<?php


namespace App\Traits;


use App\Models\CategoryNotification;
use App\Models\Notification;

trait DataModelsNotifications
{
    /**
     * NOtificaciones
     **/
    public function getCategoryNotification($search = null, $instancia=null,$sort='id', $direction='desc'){
        return CategoryNotification::withCount('notifications')
            ->when($search, function ($q) use($search){
                $q->where('name','like','%'.$search.'%');
            })->when($instancia, function ($q) use($instancia){
                $q->where('instance_id',$instancia);
            })
            ->orderBy($sort, $direction)
            ->paginate();
    }

    public function getAllCategoryNotifications($instancia=null, $hasNotification = false){
        return CategoryNotification::when($hasNotification, function ($q){
            $q->has('notifications','<>',0);
        })
            ->when($instancia, function ($q) use($instancia){
                $q->where('instance_id',$instancia);
            })
            ->orderBy('id', 'asc')
            ->get();
    }

    public function getAllNotifications($search = null,  $instancia=null, $category = null, $sort='id', $direction='desc'){
        $notifications = Notification::when($search, function ($q) use($search){
            $q->where('titulo','like','%'.$search.'%');
        })
            ->when($instancia, function ($q) use($instancia){
                $q->where('instance_id',$instancia);
            })
            ->when($category, function ($q) use($category){
                $q->where('category_notification_id', $category);
            })
            ->orderBy($sort, $direction)
            ->paginate();
        if($notifications->count()){
            $notifications->load('category_notification');
        }
        return $notifications;
    }
}
