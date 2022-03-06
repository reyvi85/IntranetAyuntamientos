<?php

namespace App\Models;

use App\Models\Traits\HasInstance;
use App\Models\Traits\HasSort;

use App\Scopes\UserInstanceScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Busine extends Model
{
    use HasFactory, HasSort, HasInstance;

    protected $fillable = [
        'name',
        'direccion',
        'telefono',
        'email',
        'logo',
        'description',
        'url_web',
        'slug',
        'category_busine_id',
        'instance_id'
    ];

    public $allowedSorts=['id','name'];

    protected $hidden = [
        'category_busine_id',
        'instance_id',
    ];

    public function category_busine(){
        return $this->belongsTo(CategoryBusine::class);
    }

    public function instance(){
        return $this->belongsTo(Instance::class);
    }

    /**
     * SCOPE
    **/


    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new UserInstanceScope());
    }
}
