<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug'
    ];

    public function provincias(){
        return $this->hasMany(Province::class);
    }

    public function instances(){
        return $this->hasManyThrough(Instance::class,Province::class);
    }
}
