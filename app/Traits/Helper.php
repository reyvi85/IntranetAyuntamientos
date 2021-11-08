<?php
namespace App\Traits;

use App\Models\Instance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;

trait Helper {


    public function getRouteName(){
       return Route::currentRouteName();
    }

    public function getUsersRoles(){
        $roles = [1=>'Super-Administrador', 2=>'Administrador-Instancia', 3=>'Gestor-Instancia', 4=>'Usuarios'];
        $data = collect($roles);
        if(Auth::user()->rol !='Super-Administrador'){
           $aux =  $data->except(1);
            return $aux;
        }
        return $data;

    }

    /**
     * @return bool
     * Comprobar acceso a modulos de instancia segun ruta
     */
    public function getCheckAccessModules(){
        $instancePermission = Auth::user()->instance->modulos;
        $modulos = $this->modulosApp()->where('routeName', $this->getRouteName());
        $access = $modulos->whereIn('id', $instancePermission);
        return ($access->count())?true:false;
    }

    public function getModuleNameAccess(){
        $mod = $this->modulosApp()->where('routeName', $this->getRouteName())->first();
        return $mod['modulo'];
    }

    public function generateChar($leng=32){
        return Str::random($leng);
    }

    public function getCheckInstance($intanceKey){
        return Instance::where('key', $intanceKey)->first();
    }

    public function modulosApp(){
        return collect([
            ['id'=>1,'modulo'=>'Gestión de Avisos', 'icon'=>'fa-cog','routeName'=>'home'],
            ['id'=>2,'modulo'=>'Comercios', 'icon'=>'fa-euro-sign', 'routeName'=>'gestion.business'],
            ['id'=>3,'modulo'=>'Gestión de información Destacada','icon'=>'fa-cog', 'routeName'=>'home'],
            ['id'=>4,'modulo'=>'Notificaciones','icon'=>'fa-bell', 'routeName'=>'gestion.notifications'],
            ['id'=>5,'modulo'=>'Gestión de Noticias', 'icon'=>'fa-cog','routeName'=>'home'],
            ['id'=>6,'modulo'=>'Teléfonos de interés', 'icon'=>'fa-phone', 'routeName'=>'gestion.phones'],
            ['id'=>7,'modulo'=>'Gestión de Sitios de Interés', 'icon'=>'fa-cog', 'routeName'=>'home'],
        ]);
    }

    public function getOptionMenu(){
        $instancePermission = Auth::user()->instance->modulos;
        $modulos = $this->modulosApp();
        $access = $modulos->whereIn('id', $instancePermission);
        return $access;
    }
}
