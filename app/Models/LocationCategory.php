<?php

namespace App\Models;

use App\Models\Traits\HasInstance;
use App\Scopes\UserInstanceScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','image'
    ];

    public function locations(){
        return $this->hasMany(Location::class);
    }
}
