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
        'rol',
        'instance_id'
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

    public function instance(){
        return $this->belongsTo(Instance::class);
    }

    public function warnings(){
        return $this->hasMany(Warning::class);
    }

    public function isRole($rol)
    {
        return $this->rol === $rol;
    }

    public function scopeForRole($query){
        if(Auth::check() && Auth::user()->rol != 'Super-Administrador') {
            return $query->where('instance_id', Auth::user()->instance_id);
        }
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        if(Auth::check() && Auth::user()->rol != 'Super-Administrador') {
            static::addGlobalScope('instance', function (Builder $builder) {
                $builder->where('instance_id', Auth::user()->instance_id);
            });
        }
    }

}
