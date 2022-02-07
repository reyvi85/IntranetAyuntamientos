<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserInstanceScope implements Scope
{


    public function apply(Builder $builder, Model $model)
    {
        if(Auth::check() && Auth::user()->rol != 'Super-Administrador'){
            $builder->where('instance_id',Auth::user()->instance_id);
        }else{
            $builder->whereHas('instance', function (Builder $q){
                $q->where('key',request()->token_inst);
            });
        }
    }
}
