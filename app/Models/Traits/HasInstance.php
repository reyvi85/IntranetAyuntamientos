<?php

namespace App\Models\Traits;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

trait HasInstance
{

    public function scopeGetInstance($query, $model = 'instance', $key=null){
        $tk = (is_null($key))?request()->token_inst:$key;
        return $query->whereHas($model, function (Builder $builder)use($tk){
            $builder->where('key','like', '%'.$tk.'%');
        });
    }

    public function scopeForView($query, $field){
        $aceptField = array('visitantes', 'residentes','inicio');
        if(is_null($field)){
            return;
       }else{
           $onlyFields = Str::of($field)->explode(',');
           $q = [];
           foreach ($onlyFields as $key){
               if (!in_array($key, $aceptField)){
                   abort(400, "El campo {$key} no está permitido");
               }
              $q = $query->where($key, true);
           }
           return $q;
       }

    }

    public function scopeFilterInstance($query, $instancia){
       return $query->where(function ($q) use($instancia){
            if (Auth::user()->rol != 'Super-Administrador'){
                $q->where('instance_id', '=',Auth()->user()->instance_id);
            }else {
                $q->when($instancia, function ($qr) use ($instancia) {
                    $qr->where('instance_id', $instancia);
                });
            }
        });

    }
}
