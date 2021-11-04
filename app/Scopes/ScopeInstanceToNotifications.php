<?php
/**
 * Created by PhpStorm.
 * User: reyvi
 * Date: 4/11/2021
 * Time: 10:12
 */

namespace App\Scopes;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class ScopeInstanceToNotifications implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if(Auth::check() && Auth::user()->rol != 'Super-Administrador'){
         //   $builder->where('instance_id',Auth::user()->instance_id);
        }
    }
}