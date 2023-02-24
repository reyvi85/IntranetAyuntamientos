<?php


namespace App\Traits;


use App\Models\RouteReserve;

trait DataModelsRouteReserve
{
    /**
     * @param null $search
     * @param null $instancia
     * @param null $state
     * @param string $sort
     * @param string $direction
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllReserve($search = null, $instancia = null, $state=null, $sort='id', $direction='desc'){
        return RouteReserve::
            with([
                'user'=>function($q)use($search){
                    $q->when($search, function ($qr)use($search){
                        $qr->where('name', 'like', '%'.$search.'%')
                                ->orWhere('email', 'like','%'.$search.'%');
                    });
                }
                ,
                'route'=>function($q)use($search, $instancia){
                    $q->when($search, function ($q)use($search){
                        $q->where('name','like', '%'.$search.'%')
                            ->orWhere('description','like', '%'.$search.'%');
                    });
                }
            ])
            ->when($instancia, function ($q)use($instancia){
                $q->where('instance_id', $instancia);
            })
            ->when($state, function ($q) use($state){
                $q->where('state', $state);
            })
            ->orderBy($sort, $direction)
            ->paginate();
    }
}
