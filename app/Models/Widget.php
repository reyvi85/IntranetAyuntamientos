<?php

namespace App\Models;

use App\Models\Traits\HasSort;
use App\Scopes\UserInstanceScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Widget extends Model
{
    use HasFactory, HasSort;

    protected $fillable =[
        'titulo',
        'subtitulo',
        'image',
        'embed',
        'enlace',
        'active',
        'slug',
        'instance_id'
    ];

    public $allowedSorts=['id','titulo'];

    public function scopeActive($query){
        return $query->where('active', true);
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new UserInstanceScope());
    }
}
