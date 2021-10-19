<?php


namespace App\Scopes;

use App\Models\User;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class InstanceScope implements Scope
{

    public function apply(Builder $builder, Model $model)
    {
        if(Auth::user()->rol != 'Super-Administrador'){
            $builder->whereHas('users', function (Builder $q){
                $q->where('user_id', Auth()->user()->id);
            });
        }

    }
}
