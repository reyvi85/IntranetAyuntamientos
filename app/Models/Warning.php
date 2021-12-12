<?php

namespace App\Models;

use App\Models\Traits\HasSort;
use App\Scopes\UserInstanceScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warning extends Model
{
    use HasFactory, HasSort;

    protected $fillable = [
        'asunto',
        'description',
        'ubicacion',
        'image',
        'lat',
        'lng',
        'instance_id',
        'warning_state_id',
        'warning_sub_category_id',
        'user_id'
    ];

    public $allowedSorts = ['id', 'asunto', 'created_at'];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
    ];

    public function instance(){
        return $this->belongsTo(Instance::class);
    }

    public function warning_sub_category(){
        return $this->belongsTo(WarningSubCategory::class);
    }

    public function user(){
        return $this ->belongsTo(User::class);
    }

    public function warning_state(){
        return $this->belongsTo(WarningState::class);
    }

    public function warning_answers(){
        return $this->hasMany(WarningAnswer::class);
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new UserInstanceScope());
    }
}
