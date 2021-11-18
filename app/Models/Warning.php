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
        'warning_state_id',
        'warning_sub_category_id',
        'user_id'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
    ];

    public function warning_sub_category(){
        return $this->belongsTo(WarningSubCategory::class);
    }

    public function user(){
        return $this ->belongsTo(User::class);
    }

    public function warning_state(){
        return $this->belongsTo(WarningState::class);
    }
}
