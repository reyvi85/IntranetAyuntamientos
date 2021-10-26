<?php

namespace App\Models;

use App\Scopes\InstanceScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Instance extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'province_id' ,
        'municipio',
        'barrio',
        'postal_code',
        'key'
    ];

    public function province(){
        return $this->belongsTo(Province::class);
    }

    public function users(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function business(){
        return $this->hasMany(Busine::class);
    }





    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new InstanceScope());
    }



}
