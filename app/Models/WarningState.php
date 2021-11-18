<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarningState extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function warnings(){
        return $this->hasMany(Warning::class);
    }
}
