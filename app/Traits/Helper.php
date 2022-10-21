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
            ['id'=>1,'modulo'=>'Seguimiento de avisos', 'icon'=>'fa-bullhorn','routeName'=>'gestion.avisos', 'imagen'=>'avisos.jpg'],
            ['id'=>2,'modulo'=>'Comercios', 'icon'=>'fa-euro-sign', 'routeName'=>'gestion.business', 'imagen'=>'comercios.jpg'],
            ['id'=>3,'modulo'=>'Widgets','icon'=>'fa-cog', 'routeName'=>'gestion.widgets', 'imagen'=>'widgets.jpg'],
            ['id'=>4,'modulo'=>'Envío de notificaciones','icon'=>'fa-bell', 'routeName'=>'gestion.notifications', 'imagen'=>'notificaciones.jpg'],
            ['id'=>5,'modulo'=>'Gestión de Noticias', 'icon'=>'fa-newspaper','routeName'=>'gestion.noticias', 'imagen'=>'noticias.jpg'],
            ['id'=>6,'modulo'=>'Directorio telefónico', 'icon'=>'fa-phone', 'routeName'=>'gestion.phones', 'imagen'=>'telefonos.jpg'],
            ['id'=>7,'modulo'=>'Localizaciones', 'icon'=>'fa-map-marker-alt', 'routeName'=>'gestion.localizaciones', 'imagen'=>'localizaciones.jpg'],
            ['id'=>8,'modulo'=>'Dashboard', 'icon'=>'fa-cogs', 'routeName'=>'home', 'imagen'=>'dashboard.jpg'],
            ['id'=>9,'modulo'=>'Eventos', 'icon'=>'fa-cogs', 'routeName'=>'gestion.events', 'imagen'=>'eventos.jpg'],
            //['id'=>10,'modulo'=>'Turismo', 'icon'=>'fa-cogs', 'routeName'=>'home', 'imagen'=>'turismo.jpg'],
        ]);
    }

    public function getOptionMenu(){
        $instancePermission = Auth::user()->instance->modulos;
        $modulos = $this->modulosApp();
        $access = $modulos->whereIn('id', $instancePermission);
        return (object)$access;
    }

    public function getClassColor($key=null){
        $colors = ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'];
        return (is_null($key))?$colors:$colors[$key];
    }


}
