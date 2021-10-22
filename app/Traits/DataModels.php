<?php
namespace App\Traits;

use App\Models\Busine;
use App\Models\CategoryBusine;
use App\Models\Community;
use App\Models\Instance;
use App\Models\Province;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

trait DataModels {

    public $modalConfig=[], $sort = 'id', $sortDirection='desc', $modalModeDestroy = false ;

    /** Método para ordenar colecciones
     * @param $sort
     */
    public function order($sort){
        if ($this->sort == $sort){
            if($this->sortDirection == 'desc'){
                $this->sortDirection = 'asc';
            }else{
                $this->sortDirection = 'desc';
            }
        }else{
            $this->sort = $sort;
            $this->sortDirection = 'asc';
        }
    }

    /** Generar configuracion del Modal
     * @param string $titulo
     * @param string $icono
     * @param string $action
     */
    public function setConfigModal($titulo='Añadir' , $icono = 'fa-plus-circle', $action='add'){
        $this->modalConfig = [
            'titulo'=>$titulo,
            'icon'=>$icono,
            'action'=>$action
        ];
    }

    /** Lista de comunidades filtradas
     * @param null $search
     * @param $sort
     * @param $direction
     * @return array|Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Traits\Conditionable[]
     */
    public function getComunidades($search = null, $sort, $direction){
        return Community::with('provincias')
            ->when($search, function ($q) use ($search){
                 $q->where('name', 'like', '%'.$search.'%');
            })
            ->orderBy($sort, $direction)
            ->get();
    }

    /** Lista de Comunidades
     * @return Community[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getCommunity(){
        return Community::all();
    }

    /** Lista de provincias
     * @param $community
     * @return mixed
     */
    public function getProvince($community){
        return Province::where('community_id', $community)->get();
    }

    /** Lista de isntancias filtradas por todos los campos a travez de la busqueda
     * @param null $busqueda
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
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

    public function getInstanceWithUser($userId){
        return Instance::whereHas('users', function(Builder $q) use($userId){
            $q->where('user_id', $userId);
        })
            ->get();
    }

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

    public function getUserWithInstance($instanceId){
        return User::whereHas('instances', function(Builder $q) use($instanceId){
            $q->where('instance_id', $instanceId);
        })
            ->get();
    }

    public function getAllInstace(){
        return Instance::all();
    }


    public function getAllUsers($search = null, $sort='id', $direction='desc', $rol = null)
    {
        return User::when($search, function ($q) use($search){
            $q->where('name', 'like', '%'.$search.'%')
                ->orWhere('email', 'like', '%'.$search.'%');
        })->when($rol, function ($q) use($rol){
            $q->orWhere('rol', 'like', $rol);
        })
            ->orderBy($sort, $direction)
            ->paginate();
    }

    /**
     * Categorías de negocios
    **/

    public function getCategoryBusiness($search = null, $sort, $direction = 'desc'){
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
                $q->whereHas('instance', function (Builder $builder) use($instance){
                        $builder->where('id', $instance);
                });
            })
            ->orderBy($sort, $direction)
            ->paginate();
    }

    public function getBusinessPublic($key, $search = null, $category = null, $sort, $direction){
        return Busine::with('category_busine')
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

}
