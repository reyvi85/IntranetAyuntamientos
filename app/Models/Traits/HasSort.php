<?php


namespace App\Models\Traits;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

trait HasSort
{
    public function scopeApplySorts(Builder $query,$sort){
        if(!property_exists($this,'allowedSorts')){
            abort(500,'Por favor, agrega la propiedad $allowedSorts en la clase '.get_class($this));
        }
        if(is_null($sort)){
            return;
        }
        $sortFields = Str::of($sort)->explode(',');
        foreach ($sortFields as $sortField){
            $direction = 'asc';
            if(Str::of($sortField)->startsWith('-')){
                $direction = 'desc';
                $sortField = Str::of($sortField)->substr(1);
            }
            if (!collect($this->allowedSorts)->contains($sortField)){
                abort(400, "El parámetro {$sortFields} no está permitido");
            }
            $query->orderBy($sortField, $direction);
        }
    }
}
