<?php
namespace App\Traits;

use App\Models\Instance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;

trait Helper {

    public function getUsersRoles(){
        $roles = [1=>'Super-Administrador', 2=>'Administrador-Instancia', 3=>'Gestor-Instancia', 4=>'Usuarios'];
        $data = collect($roles);
        if(Auth::user()->rol !='Super-Administrador'){
           $aux =  $data->except(1);
            return $aux;
        }
        return $data;

    }

    public function generateChar($leng=32){
        return Str::random($leng);
    }

    public function getCheckInstance($intanceKey){
        return Instance::where('key', $intanceKey)->first();
    }

    public function modulosApp(){
        return collect([
            ['id'=>1,'modulo'=>'Gestión de Avisos', 'routeName'=>'gestion.'],
            ['id'=>2,'modulo'=>'Gestión de comercios', 'routeName'=>'gestion.business'],
            ['id'=>3,'modulo'=>'Gestión de información Destacada', 'routeName'=>'gestion.'],
            ['id'=>4,'modulo'=>'Gestión de Notificaciones', 'routeName'=>'gestion.'],
            ['id'=>5,'modulo'=>'Gestión de Noticias', 'routeName'=>'gestion.'],
            ['id'=>6,'modulo'=>'Gestión de teléfonos de interés', 'routeName'=>'gestion.phones'],
            ['id'=>7,'modulo'=>'Gestión de Sitios de Interés', 'routeName'=>'gestion.'],
        ]);
    }
}
