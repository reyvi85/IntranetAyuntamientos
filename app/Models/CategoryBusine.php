<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryBusine extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'slug'
    ];

    public function business(){
        return $this->hasMany(Busine::class);
    }
}
