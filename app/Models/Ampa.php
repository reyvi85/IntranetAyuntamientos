<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ampa extends Model
{
    use HasFactory;

    protected $fillable = [
      'Nombre',
      'Dni',
      'Active'
    ];

    protected $table = 'ampa';
}
