<?php

namespace App\Models;

use App\Models\Traits\HasInstance;
use App\Scopes\UserInstanceScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RouteReserve extends Model
{
    use HasFactory, HasInstance;

    protected $fillable = [
        'user_id',
        'route_id',
        'state',
        'fecha_reserva',
        'instance_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function route(){
        return $this->belongsTo(Route::class);
    }

    public function instance(){
        return $this->belongsTo(Instance::class);
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new UserInstanceScope());
    }
}
