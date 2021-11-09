<?php

namespace App\Models;

use App\Scopes\UserInstanceScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'ubicacion',
        'telefono',
        'web',
        'image',
        'visitantes',
        'residentes',
        'inicio',
        'instance_id',
        'location_category_id'
    ];

    public function instance(){
        return $this->belongsTo(Instance::class);
    }

    public function location_category(){
        return $this->belongsTo(LocationCategory::class);
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new UserInstanceScope());
    }
}
