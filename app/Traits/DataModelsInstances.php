<?php


namespace App\Traits;


use App\Models\Community;
use App\Models\Instance;
use App\Models\Province;
use Illuminate\Database\Eloquent\Builder;

trait DataModelsInstances
{


    /** Lista de isntancias filtradas por todos los campos a travez de la busqueda
     * @param null $busqueda
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getInstancia($Id){
        return Instance::find($Id);
    }

    public function getInstancias($busqueda=null){
        $search = trim($busqueda);
        return Instance::with(['province', 'province.community'])
            ->when($search, function ($q) use($search){
                $q->where('name', 'like', '%'.$search.'%')
                    ->orWhere('municipio', 'like', '%'.$search.'%')
                    ->orWhere('barrio', 'like', '%'.$search.'%')
                    ->orWhere('key', 'like', '%'.$search.'%')
                    ->orWhere(function($qr)use($search){
                        $qr->whereHas('province', function (Builder $query) use($search){
                            $query->where('name', 'like', '%'.$search.'%');
                        });
                    })
                    ->orWhere(function($qr)use($search){
                        $qr->whereHas('province.community', function (Builder $query) use($search){
                            $query->where('name', 'like', '%'.$search.'%');
                        });
                    });
            })
            ->orderBy('id', 'Desc')
            ->paginate(5);
    }

    public function getAllInstancias($busqueda = null, $limit = null){
        return Instance::when($busqueda, function ($q) use ($busqueda){
            $q->where('name','like','%'.$busqueda.'%');
        })
            ->when($limit, function ($q) use($limit){
                $q->limit($limit);
            })
            ->get();
    }

    public function getAllInstace(){
        return Instance::get();
    }

    public function getInstancePerKey($key){
        return Instance::where('key',  $key)->first();
    }
}
