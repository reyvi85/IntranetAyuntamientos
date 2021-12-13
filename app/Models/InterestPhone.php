<?php

namespace App\Models;
use App\Models\Traits\HasSort;
use App\Scopes\UserInstanceScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterestPhone extends Model
{
    use HasFactory, HasSort;

    protected $fillable = [
        'name', 'description', 'phone', 'instance_id'
    ];
    public $allowedSorts = ['id','name', 'phone'];

    public function instance(){
        return $this->belongsTo(Instance::class);
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new UserInstanceScope());
    }
}
