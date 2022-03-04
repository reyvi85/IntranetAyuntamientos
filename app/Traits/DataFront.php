<?php


namespace App\Traits;


use App\Models\Busine;
use App\Models\CategoryBusine;
use Illuminate\Database\Eloquent\Builder;
//use Illuminate\Http\Request;

trait DataFront
{
    public $sort = 'id', $sortDirection='desc';

    public function getBusinessPublic($key, $search = null, $category = null, $sort, $perPage = 15){
        return Busine::withoutGlobalScopes()->with('category_busine')
            /*
           ->whereHas('instance', function (Builder $builder) use($key){
                $builder->where('key','like', '%'.$key.'%');
            })*/
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
            ->GetIntance('instance')
            ->ApplySorts($sort)
            ->paginate($perPage)->appends(request()->query());
    }

    public function getAllCategoryBusiness($key){
        return CategoryBusine::withoutGlobalScopes()->whereHas('business.instance', function (Builder $builder) use($key){
                $builder->where('key','like', '%'.$key.'%');
        })
        ->orderBy('name', 'asc')
        ->get();
    }

}
