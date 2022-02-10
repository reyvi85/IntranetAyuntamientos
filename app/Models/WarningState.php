<?php

namespace App\Models;

use App\Models\Traits\HasInstance;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarningState extends Model
{
    use HasFactory, HasInstance;

    protected $fillable = ['name', 'color'];

    public function warnings(){
        return $this->hasMany(Warning::class);
    }
}
