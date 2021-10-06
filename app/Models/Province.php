<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'community_id'
    ];

    public function community(){
        return $this->belongsTo(Community::class);
    }

    public function instancias(){
        return $this->hasMany(Instance::class);
    }
}
