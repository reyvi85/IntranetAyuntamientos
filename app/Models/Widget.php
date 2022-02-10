<?php

namespace App\Models;

use App\Models\Traits\HasInstance;
use App\Models\Traits\HasSort;
use App\Scopes\UserInstanceScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Widget extends Model
{
    use HasFactory, HasSort, HasInstance;

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

    public function instance(){
        return $this->belongsTo(Instance::class);
    }

    public function scopeActive($query){
        return $query->where('active', true);
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new UserInstanceScope());
    }
}
