<?php

namespace App\Models;

use App\Scopes\UserInstanceScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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

    public function getFechaInicioAttribute($value)
    {
        return date("Y-m-d", strtotime($value));
    }

    public function getFechaFinAttribute($value)
    {
        return date("Y-m-d", strtotime($value));
    }

    public function getFechaFullAttribute(){
        return $this->fecha_inicio.' / '.$this->fecha_fin;
    }

    public function instance(){
        return $this->belongsTo(Instance::class);
    }

    public function scopeApplySort($sort){
        $sortFields = Str::of($sort)->explode(',');
        $postQuery = Post::query();

        foreach ($sortFields as $sortField){
            $direction = 'asc';
            if(Str::of($sortField)->startsWith('-')){
                $direction = 'desc';
                $sortField = Str::of($sortField)->substr(1);
            }
            $postQuery->orderBy($sortField, $direction);
        }
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new UserInstanceScope());
    }
}
