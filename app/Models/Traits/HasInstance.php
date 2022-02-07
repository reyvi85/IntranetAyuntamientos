<?php

namespace App\Models\Traits;
use Illuminate\Database\Eloquent\Builder;

trait HasInstance
{
    private $keyInst;

    public function getKey(){
        return $this->key = request()->token_inst;
    }

    public function scopeGetIntance($query, $model){
        return $query->whereHas($model, function (Builder $builder){
            $builder->where('key','like', '%'.$this->getKey().'%');
        });
    }
}