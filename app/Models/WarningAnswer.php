<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarningAnswer extends Model
{
    use HasFactory;

    protected $fillable =['answer', 'warning_id'];

    public function warning(){
        return $this->belongsTo(Warning::class);
    }
}
