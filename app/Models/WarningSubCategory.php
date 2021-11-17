<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarningSubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'warning_category_id'
    ];

    public function warning_category(){
        return $this->belongsTo(WarningCategory::class);
    }

    public function warnings(){
        return $this->hasMany(Warning::class);
    }
}
