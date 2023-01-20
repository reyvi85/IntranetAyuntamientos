<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RouteIntermediate extends Model
{
    use HasFactory;

    protected $fillable =[
        'name',
        'address',
        'description',
        'image'
    ];

    public function routes(){
        return $this->belongsTo(Route::class);
    }

}
