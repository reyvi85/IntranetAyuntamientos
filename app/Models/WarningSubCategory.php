<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class WarningSubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'warning_category_id'
    ];

    public function warning_category(){
        return $this->belongsTo(WarningCategory::class);
    }

    public function warnings(){
        return $this->hasMany(Warning::class);
    }


    protected static function booted()
    {
        if(Auth::check() && Auth::user()->rol != 'Super-Administrador') {
            static::addGlobalScope('instance', function (Builder $builder) {
                $builder->whereHas('warning_category', function ($q){
                    $q->where('instance_id', Auth::user()->instance_id);
                });
            });
        }
    }
}
