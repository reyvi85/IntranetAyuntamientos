<?php

namespace App\Models;

use App\Scopes\UserInstanceScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'subtitulo',
        'contenido',
        'image',
        'fecha_inicio',
        'fecha_fin',
        'visitantes',
        'residentes',
        'inicio',
        'slug',
        'active',
        'instance_id'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
    ];

    public function instance(){
        return $this->belongsTo(Instance::class);
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new UserInstanceScope());
    }
}
