<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Widget extends Model
{
    use HasFactory;

    protected $fillable =[
        'titulo',
        'subtitulo',
        'image',
        'type',
        'enlace',
        'active',
        'slug',
        'instance_id'
    ];
}
