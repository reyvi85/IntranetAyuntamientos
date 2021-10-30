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
        if(Auth::check() && Auth::user()->rol != 'Super-Administrador'){
            $builder->where('id', Auth()->user()->instance_id);
        }

    }
}
