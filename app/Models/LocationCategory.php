<?php

namespace App\Models;

use App\Scopes\UserInstanceScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','image', 'instance_id'
    ];

    public function instance(){
        return $this->belongsTo(Instance::class);
    }

    public function locations(){
        return $this->hasMany(Location::class);
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new UserInstanceScope());
    }
}
