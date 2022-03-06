<?php

namespace App\Models\Traits;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
trait HasInstance
{

    public function scopeGetInstance($query, $model = 'instance', $key=null){
        $tk = (is_null($key))?request()->token_inst:$key;
        return $query->whereHas($model, function (Builder $builder)use($tk){
            $builder->where('key','like', '%'.$tk.'%');
        });
    }
}
