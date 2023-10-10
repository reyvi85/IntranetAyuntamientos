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
    protected $primaryKey = 'Id';

    protected $table = 'ampa';
    public $timestamps = false;

    public function setNombreAttribute($value)
    {
        $this->attributes['Nombre'] = strtoupper($value);
    }

    public function setDniAttribute($value)
    {
        $this->attributes['Dni'] = strtoupper($value);
    }

}
