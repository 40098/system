<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'insertion_name', 'last_name', 'company', 'mobile_phone', 'house_phone', 'email', 'address', 'zip', 'city'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}

