<?php


namespace App\Traits;


use App\Models\Location;
use App\Models\LocationCategory;

trait DataModelsLocation
{
    /**
     * Localizaciones
     */

    public function getCategoryLocation($search = null, $sort='id', $direction='desc'){
        return LocationCategory::withCount('locations')
            ->when($search, function ($q) use($search){
                $q->where('name','like','%'.$search.'%');
            })
            ->orderBy($sort, $direction)
            ->paginate();
    }

    public function getAllCategoryLocation($instancia=null){
        return LocationCategory::orderBy('name','asc')
            ->get();
    }

    public function getLocations($search = null,  $instancia=null, $category = null, $sort='id', $direction='desc'){
        return Location::when($search, function ($q) use($search){
            $q->where('name','like','%'.$search.'%')
                ->orWhere('ubicacion','like','%'.$search.'%')
                ->orWhere('telefono','like','%'.$search.'%');
        })
            ->when($instancia, function ($q) use($instancia){
                $q->where('instance_id',$instancia);
            })
            ->when($category, function ($q) use($category){
                $q->where('location_category_id',$category);
            })
            ->orderBy($sort, $direction)
            ->paginate();
    }
}
