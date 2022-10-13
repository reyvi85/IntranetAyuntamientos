<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationGallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'image'
    ];

    public function location(){
        return $this->belongsTo(Location::class);
    }
}
