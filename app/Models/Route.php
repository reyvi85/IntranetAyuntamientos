<?php

namespace App\Models;

use App\Models\Traits\HasInstance;
use App\Scopes\UserInstanceScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory, HasInstance;

    protected $fillable = [
        'name',
        'description',
        'imagen',
        'state',
        'price',
        'inicio_ruta_name',
        'inicio_ruta_direccion',
        'inicio_ruta_description',
        'inicio_ruta_imagen',
        'fin_ruta_name',
        'fin_ruta_direccion',
        'fin_ruta_description',
        'fin_ruta_imagen',
        'instance_id',
        'route_category_id',
        'hit'
    ];

    public function instance(){
        return $this->belongsTo(Instance::class);
    }

    public function route_category(){
        return $this->belongsTo(RouteCategory::class);
    }

    public function route_intermediates(){
        return $this->hasMany(RouteIntermediate::class);
    }

    public function route_reserves(){
        return $this->hasMany(RouteReserve::class);
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new UserInstanceScope());
    }

}
