<?php


namespace App\Traits;


use App\Models\Busine;
use App\Models\CategoryBusine;
use Illuminate\Database\Eloquent\Builder;

trait DataFront
{
    public $sort = 'id', $sortDirection='desc';

    public function getBusinessPublic($key, $search = null, $category = null, $sort, $direction){
        return Busine::withoutGlobalScopes()->with('category_busine')
           ->whereHas('instance', function (Builder $builder) use($key){
                $builder->where('key','like', '%'.$key.'%');
            })
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
            ->orderBy($sort, $direction)
            ->paginate(16);
    }

    public function getAllCategoryBusiness(){
        return CategoryBusine::orderBy('name', 'asc')
            ->get();
    }

}