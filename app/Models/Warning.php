<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warning extends Model
{
    use HasFactory;

    protected $fillable = [
        'asunto',
        'description',
        'image',
        'lat',
        'lng',
        'estado',
        'warning_sub_category_id',
        'user_id'
    ];

    public function sub_category(){
        return $this->belongsTo(WarningSubCategory::class);
    }

    public function user(){
        return $this ->belongsTo(User::class);
    }
}
