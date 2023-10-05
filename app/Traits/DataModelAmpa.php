<?php


namespace App\Traits;


use App\Models\Ampa;

trait DataModelAmpa
{
    public function getClientAmpa($search=null){
        return Ampa::when($search !=null, function ($q) use($search){
            $q->where('Dni',$search)
              ->orWhere('Nombre','like','%'.$search.'%');
        })->get();
    }

}
