<?php
namespace App\Traits;

use App\Models\Busine;
use App\Models\CategoryBusine;
use App\Models\CategoryNotification;
use App\Models\Community;
use App\Models\Event;
use App\Models\EventCategory;
use App\Models\Instance;
use App\Models\InterestPhone;
use App\Models\Location;
use App\Models\LocationCategory;
use App\Models\Notification;
use App\Models\Post;
use App\Models\Province;
use App\Models\Route;
use App\Models\RouteCategory;
use App\Models\User;
use App\Models\Warning;
use App\Models\WarningCategory;
use App\Models\WarningState;
use App\Models\WarningSubCategory;
use App\Models\Widget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

trait DataModels {

    public $modalConfig=[], $sort = 'id', $sortDirection='desc', $modalModeDestroy = false, $instanceSelected,
        $listInstance, $instancias;
    protected $paginationTheme = 'bootstrap';
    public $patchToUpload;

    public function __construct()
    {
        $this->listInstance = collect();
    }

    /**
     * @return mixed
     */
    public function getPatchToUpload()
    {
        return $this->patchToUpload;
    }

    /**
     * @param mixed $patchToUpload
     */
    public function setPatchToUpload($patchToUpload)
    {
        $this->patchToUpload = $patchToUpload;
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
}
