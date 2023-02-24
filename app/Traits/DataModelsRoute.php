<?php


namespace App\Traits;


use App\Models\Route;
use App\Models\RouteCategory;

trait DataModelsRoute
{
    /**
     * Rutas
     */

    public function getCategoryRoutes($search = null, $sort='id', $direction='desc'){
        return RouteCategory::withCount('routes')
            ->when($search, function ($q) use($search){
                $q->where('name','like','%'.$search.'%');
            })
            ->orderBy($sort, $direction)
            ->get();
    }

    public function getAllRoutes($search = null, $instancia = null, $categoria = null, $sort='id', $direction='desc'){
        return Route::with('route_category')
            ->when($search, function ($q) use($search){
                $q->where('name','like', '%'.$search.'%')
                    ->orWhere('description','like', '%'.$search.'%');
            })
            ->orderBy($sort, $direction)
            ->paginate(10, ['*'],'pageRoutes');
    }

    public function getRoutesPerInstance($instance){
        return Route::where('instance_id', $instance)
            ->get();
    }


}
