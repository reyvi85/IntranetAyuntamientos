<?php

namespace App\Models;

use App\Scopes\UserInstanceScope;
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

    protected $casts = [
        'lat'=>'double',
        'lng'=>'double'
    ];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new UserInstanceScope());
    }
}
