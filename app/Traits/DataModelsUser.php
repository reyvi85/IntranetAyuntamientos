<?php


namespace App\Traits;


use App\Models\User;

trait DataModelsUser
{
    public function getAllUsersWhithFilter($busqueda = null, $limit = null, $rol =null){
        return User::when($busqueda, function ($q) use ($busqueda){
            $q->where('name','like','%'.$busqueda.'%')
                ->orWhere('email', 'like', '%'.$busqueda.'%');
        })
            ->when($rol, function ($q) use($rol){
                $q->orWhere('rol', 'like', '%'.$rol.'%');
            })
            ->when($limit, function ($q) use($limit){
                $q->limit($limit);
            })
            ->get();
    }

    public function getAllUsers($search = null, $instancia = null, $sort='id', $direction='desc', $rol = null)
    {
        return User::when($search, function ($q) use($search){
            $q->where('name', 'like', '%'.$search.'%')
                ->orWhere('email', 'like', '%'.$search.'%');
        })->when($rol, function ($q) use($rol){
            $q->orWhere('rol', 'like', $rol);
        })->when($instancia, function ($q) use($instancia){
            $q->where('instance_id', $instancia);
        })
            //   ->ForRole()
            ->orderBy($sort, $direction)
            ->paginate();
    }

}
