<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name', 'price'];

    public function orders()
    {
        return $this->belongsToMany('App\Models\order')->withPivot('price','amount')->withTimestamps();
    }
}

