<?php


namespace App\Traits;


use App\Models\Busine;
use App\Models\CategoryBusine;

trait DataModelsBusiness
{
    /**
     * Categorías de negocios
     **/

    public function getCategoryBusiness($search = null, $sort='id', $direction = 'desc'){
        return CategoryBusine::withCount('business')
            ->when($search, function ($q) use ($search){
                $q->where('name', 'like', '%'.$search.'%');
            })
            ->orderBy($sort, $direction)
            ->get();
    }

    public function getAllCategoryBusiness(){
        return CategoryBusine::orderBy('name', 'asc')
            ->get();
    }

    /**
     * Comercios
     **/

    public function getBusinessFiltered($search = null, $category = null, $instance = null, $sort='id', $direction = 'desc'){
        return Busine::with('category_busine')
            ->when($search, function ($q) use($search){
                $q->where('name','like','%'.$search.'%')
                    ->orWhere('direccion','like','%'.$search.'%')
                    ->orWhere('telefono','like','%'.$search.'%')
                    ->orWhere('email','like','%'.$search.'%')
                    ->orWhere('description','like','%'.$search.'%')
                    ->orWhere('url_web','like','%'.$search.'%');
            })
            ->when($category, function ($q) use($category){
                $q->where('category_busine_id', $category);
            })
            ->when($instance, function ($q) use($instance){
                $q->where('instance_id', $instance);
            })
            ->orderBy($sort, $direction)
            ->paginate();
    }

    public function getBusinessPublic($key, $search = null, $category = null, $perPage = 12){
        return Busine::withoutGlobalScopes()->with('category_busine')
            ->when($search, function ($q) use($search){
                $q->where(function ($q) use ($search){
                    $q->orWhere('name','like','%'.$search.'%')
                        ->orWhere('direccion','like','%'.$search.'%')
                        ->orWhere('telefono','like','%'.$search.'%')
                        ->orWhere('email','like','%'.$search.'%')
                        ->orWhere('description','like','%'.$search.'%')
                        ->orWhere('url_web','like','%'.$search.'%');
                });
            })
            ->when($category, function ($q) use($category){
                $q->where('category_busine_id', $category);
            })
            ->GetInstance('instance', $key)

            ->paginate($perPage);
    }

    public function getAllCategoryBusinessPublic(){
        return CategoryBusine::withCount(['business'=>function($q){
            $q->GetInstance();
        }])
            ->get();
    }
}
