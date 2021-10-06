<?php
namespace App\Traits;

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
}
