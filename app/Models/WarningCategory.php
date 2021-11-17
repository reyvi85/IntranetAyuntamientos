<?php

namespace App\Models;

use App\Scopes\UserInstanceScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarningCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'instance_id'
    ];

    public function instance(){
        return $this->belongsTo(Instance::class);
    }

    public function sub_categories(){
        return $this->hasMany(WarningSubCategory::class);
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new UserInstanceScope());
    }
}
