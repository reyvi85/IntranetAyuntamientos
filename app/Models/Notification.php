<?php

namespace App\Models;

use App\Scopes\UserInstanceScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
   // use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $fillable =[
        'fecha_publicacion',
        'titulo',
        'description',
        'instance_id',
        'category_notification_id',
    ];

    public function instance(){
        return $this->belongsTo(Instance::class);
    }

    public function category_notification(){
        return $this->belongsTo(CategoryNotification::class);
    }

    public function scopePublishUpDate($query){
        $today = Carbon::now();
        return $query->whereDate('created_at', '<=', $today);
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new UserInstanceScope());
    }
}
