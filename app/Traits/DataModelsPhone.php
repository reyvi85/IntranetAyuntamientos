<?php


namespace App\Traits;


use App\Models\InterestPhone;

trait DataModelsPhone
{
    public function getAllPhone($search = null, $instancia=null, $sort='id', $direction='desc'){
        return InterestPhone::when($search, function ($q) use($search){
            $q->where('name','like','%'.$search.'%')
                ->orWhere('description','like','%'.$search.'%')
                ->orWhere('phone','like','%'.$search.'%');
        })->when($instancia, function ($q) use($instancia){
            $q->where('instance_id',$instancia);
        })
            ->orderBy($sort, $direction)
            ->paginate();
    }
}
