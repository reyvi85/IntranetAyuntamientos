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
        'key',
        'modulos',
        'lat',
        'lng'
    ];

    protected $casts = [
        'modulos'=>'array',
        'lat'=>'double',
        'lng'=>'double'
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

    public function notifications(){
        return $this->hasMany(Notification::class);
    }

    public function category_notifications(){
        return $this->hasMany(CategoryNotification::class);
    }

    public function category_location(){
        return $this->hasMany(LocationCategory::class);
    }

    public function location(){
        return $this->hasMany(Location::class);
    }

    public function warnings(){
        return $this->hasMany(Warning::class);
    }

    public function warning_categories(){
        return $this->hasMany(WarningCategory::class);
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }





    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new InstanceScope());
    }



}
