<?php
namespace App\Traits;

use App\Models\Busine;
use App\Models\CategoryBusine;
use App\Models\CategoryNotification;
use App\Models\Community;
use App\Models\Instance;
use App\Models\InterestPhone;
use App\Models\Location;
use App\Models\LocationCategory;
use App\Models\Notification;
use App\Models\Province;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;



trait DataModels {

    public $modalConfig=[], $sort = 'id', $sortDirection='desc', $modalModeDestroy = false, $instanceSelected,
        $listInstance, $instancias;
    protected $paginationTheme = 'bootstrap';

    public function __construct()
    {
        $this->listInstance = collect();
        //$this->instancias = collect();
    }

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

    public function checkInstanceForUser(){
        if(Auth::user()->rol != 'Super-Administrador'){
            $this->instanceSelected = auth()->user()->instance_id;
        }else{
            $this->listInstance = $this->getAllInstace();
        }
    }
    public function updatedSearch(){
        $this->resetPage();
    }
    public function updatedInstancias(){
        $this->resetPage();
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

    /*public function getInstanceWithUser($userId){
        return Instance::whereHas('users', function(Builder $q) use($userId){
            $q->where('user_id', $userId);
        })
            ->get();
    }*/

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

    public function getAllInstace(){
        return Instance::all();
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
                $q->where('instance_id', $instance);
            })
            ->orderBy($sort, $direction)
            ->paginate();
    }

    public function getAllPhone($search = null, $instancia=null, $sort, $direction){
        return InterestPhone::when($search, function ($q) use($search){
            $q->where('name','like','%'.$search.'%')
                ->orWhere('description','like','%'.$search.'%')
                ->orWhere('phone','like','%'.$search.'%');
            })->when($instancia, function ($q) use($instancia){
                 $q->where('instance_id',$instancia);
            })
            ->orderBy($sort, $direction)
            ->paginate();
    }
    /**
     * NOtificaciones
    **/
    public function getCategoryNotification($search = null, $instancia=null, $sort, $direction){
        return CategoryNotification::withCount('notifications')
            ->when($search, function ($q) use($search){
                    $q->where('name','like','%'.$search.'%');
                })->when($instancia, function ($q) use($instancia){
                     $q->where('instance_id',$instancia);
                })
                ->orderBy($sort, $direction)
                ->paginate();
    }

    public function getAllCategoryNotifications($instancia=null, $hasNotification = false){
        return CategoryNotification::when($hasNotification, function ($q){
            $q->has('notifications','<>',0);
            })
            ->when($instancia, function ($q) use($instancia){
                $q->where('instance_id',$instancia);
            })
            ->orderBy('id', 'asc')
            ->get();
    }

    public function getAllNotifications($search = null,  $instancia=null, $category = null, $sort, $direction){
        $notifications = Notification::when($search, function ($q) use($search){
                $q->where('titulo','like','%'.$search.'%');
            })
            ->when($instancia, function ($q) use($instancia){
                $q->where('instance_id',$instancia);
            })
            ->when($category, function ($q) use($category){
                $q->where('category_notification_id', $category);
            })
            ->orderBy($sort, $direction)
            ->paginate();
        if($notifications->count()){
            $notifications->load('category_notification');
        }
        return $notifications;
    }

    /**
     * Localizaciones
    */

    public function getCategoryLocation($search = null, $instancia=null, $sort='id', $direction='desc'){
        return LocationCategory::withCount('locations')
            ->when($search, function ($q) use($search){
                $q->where('name','like','%'.$search.'%');
            })
            ->when($instancia, function ($q) use($instancia){
                $q->where('instance_id',$instancia);
            })
            ->orderBy($sort, $direction)
            ->paginate();
    }

    public function getAllCategoryLocation($instancia=null){
        return LocationCategory::when($instancia, function ($q) use($instancia){
            $q->where('instance_id',$instancia);
            })
            ->orderBy('name','asc')
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
