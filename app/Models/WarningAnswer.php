<?php

namespace App\Models;

use App\Models\Traits\HasInstance;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarningAnswer extends Model
{
    use HasFactory, HasInstance;

    protected $fillable =['answer', 'warning_id'];

    public function warning(){
        return $this->belongsTo(Warning::class);
    }
}
