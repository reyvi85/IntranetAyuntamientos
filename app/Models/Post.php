<?php

namespace App\Models;

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
        'instance_id'
    ];

    public function instance(){
        return $this->belongsTo(Instance::class);
    }
}
