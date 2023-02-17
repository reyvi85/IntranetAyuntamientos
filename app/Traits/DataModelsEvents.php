<?php


namespace App\Traits;


use App\Models\Event;
use App\Models\EventCategory;

trait DataModelsEvents
{
    /**
     * EVENTS
     **/
    public function getAllEvents($search=null, $instancia = null, $categoria = null, $sort='id', $direction='desc'){
        return Event::with('event_category')->when($search, function ($q) use($search){
            $q->where('titulo','like', '%'.$search.'%')
                ->orWhere('description','like', '%'.$search.'%')
                ->orWhere('f_inicio','like', '%'.$search.'%')
                ->orWhere('f_fin','like', '%'.$search.'%');

        })
            ->when($instancia, function ($q) use($instancia){
                $q->where('instance_id',$instancia);
            })
            ->when($categoria, function ($q) use($categoria){
                $q->where('event_category_id',$categoria);
            })
            ->orderBy($sort, $direction)
            ->paginate();
    }

    public function getAllCategoryEvents($search=null){
        return EventCategory::when($search, function ($q) use($search){
            $q->where('name','like', '%'.$search.'%');
        })
            ->orderBy('name', 'asc')
            ->get();
    }

}
