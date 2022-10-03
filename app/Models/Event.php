<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'imagen',
        'description',
        'lat',
        'lng',
        'link',
        'f_inicio',
        'f_fin',
        'instance_id'
    ];
}
