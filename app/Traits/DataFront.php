<?php


namespace App\Traits;


use App\Models\Busine;
use App\Models\CategoryBusine;
use App\Models\Traits\HasInstance;
use Illuminate\Database\Eloquent\Builder;
//use Illuminate\Http\Request;

trait DataFront
{
    //use HasInstance;
    public $sort = 'id', $sortDirection='desc';

    public function getBusinessPublic($key, $search = null, $category = null, $perPage = 10){
        return Busine::withoutGlobalScopes()->with('category_busine')

        /* ->whereHas('instance', function (Builder $builder) use($key){
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
            ->GetInstance('instance', $key)

           ->paginate($perPage);
    }

    public function getAllCategoryBusiness(){
        return CategoryBusine::withCount(['business'=>function($q){
            $q->GetInstance();
        }])
            ->get();
    }

}
