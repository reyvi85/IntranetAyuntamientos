<?php

namespace App\Models;

use App\Scopes\InstanceScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return $this->hasMany(User::class);
    }

    public function business(){
        return $this->hasMany(Busine::class);
    }

    public function interestPhones(){
        return $this->hasMany(InterestPhone::class);
    }





    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new InstanceScope());
    }



}
