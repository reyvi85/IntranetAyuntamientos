<?php

namespace App\Models;

use App\Scopes\InstanceScope;
use App\Scopes\UserInstanceScope;
use App\Scopes\UsersScope;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'api_token',
        'rol'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function instances(){
        return $this->belongsToMany(Instance::class)->withTimestamps();
    }

    public function isRole($rol)
    {
        return $this->rol === $rol;
    }

    public function scopeForRole($query){
        if(Auth::check() && Auth::user()->rol != 'Super-Administrador') {
            return $query->whereHas('instances', function (Builder $q) {
                $q->whereIn('instance_id', Auth::user()->instances->pluck('id'));
            });
        }
    }

}
