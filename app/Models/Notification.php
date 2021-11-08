<?php

namespace App\Models;

use App\Scopes\UserInstanceScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $fillable =[
        'fecha_publicacion',
        'titulo',
        'description',
        'category_notification_id',
    ];

    /*public function instance(){
        return $this->belongsToThrough(Instance::class, CategoryNotification::class);
    }*/

    public function instance(){
        return $this->hasOneThrough(Instance::class, CategoryNotification::class,
            'instance_id', 'id', 'id','instance_id');
    }

    public function category_notification(){
        return $this->belongsTo(CategoryNotification::class);
    }


    protected static function boot()
    {
        parent::boot();
      //  static::addGlobalScope(new UserInstanceScope());
    }
}
