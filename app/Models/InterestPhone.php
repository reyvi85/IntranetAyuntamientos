<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterestPhone extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'phone', 'instance_id'
    ];

    public function instance(){
        return $this->belongsTo(Instance::class);
    }
}
