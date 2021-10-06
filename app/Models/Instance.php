<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instance extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'province_id' ,
        'municipio',
        'barrio',
        'key'
    ];

    public function province(){
        return $this->belongsTo(Province::class);
    }

    public function users(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }


}
