<?php

namespace App\Models;

use App\Models\Traits\HasInstance;
use App\Models\Traits\HasSort;
use App\Scopes\UserInstanceScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory, HasSort, HasInstance;

    protected $fillable = [
        'titulo',
        'imagen',
        'description',
        'lat',
        'lng',
        'link',
        'f_inicio',
        'f_fin',
        'instance_id',
        'event_category_id'
    ];

    protected $casts = [
        'lat'=>'double',
        'lng'=>'double'
    ];

    public $allowedSorts = ['id', 'f_inicio', 'f_fin'];

    public function event_category(){
        return $this->belongsTo(EventCategory::class);
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new UserInstanceScope());
    }
}
