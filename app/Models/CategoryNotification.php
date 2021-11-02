<?php

namespace App\Models;

use App\Scopes\UserInstanceScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryNotification extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'instance_id'];

    public function instance(){
        return $this->belongsTo(Instance::class);
    }

    public function notifications(){
        return $this->hasMany(Notification::class);
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new UserInstanceScope());
    }
}
