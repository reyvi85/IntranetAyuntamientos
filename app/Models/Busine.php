<?php

namespace App\Models;

use App\Scopes\BusinessScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Busine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'direccion',
        'telefono',
        'email',
        'logo',
        'description',
        'url_web',
        'slug',
        'category_busine_id',
        'instance_id'
    ];

    protected $hidden = [
        'category_busine_id',
        'instance_id',
    ];

    public function category_busine(){
        return $this->belongsTo(CategoryBusine::class);
    }

    public function instance(){
        return $this->belongsTo(Instance::class);
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new BusinessScope());
    }
}
