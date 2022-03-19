<?php

namespace App\Models;

use App\Models\Traits\HasInstance;
use App\Models\Traits\HasSort;
use App\Scopes\UserInstanceScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory, HasSort, HasInstance;

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
        'location_category_id',
        'lat',
        'lng'
    ];

    protected $casts = [
        'lat'=>'double',
        'lng'=>'double'
    ];

    public $allowedSorts = ['id','name'];

    public function instance(){
        return $this->belongsTo(Instance::class);
    }

    public function location_category(){
        return $this->belongsTo(LocationCategory::class);
    }

    public function getGeoLocateAttribute()
    {
        return $this->lat.",".$this->lng;
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new UserInstanceScope());
    }
}
