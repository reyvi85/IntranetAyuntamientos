<?php
namespace App\Traits;

use App\Models\Instance;
use Illuminate\Support\Str;

trait Helper {

    public function getUsersRoles(){
        return collect([
            'Super-Administrador',
            'Administrador-Instancia',
            'Gestor-Instancia',
            'Usuarios'
        ]);
    }

    public function generateChar($leng=32){
        return Str::random($leng);
    }

    public function getCheckInstance($intanceKey){
        return Instance::where('key', $intanceKey)->first();
    }
}
