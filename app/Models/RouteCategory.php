<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RouteCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function routes(){
        return $this->hasMany(Route::class);
    }
}
