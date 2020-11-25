<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'customer_id', 'status', 'handed', 'description'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\product')->withPivot('price','amount')->withTimestamps();
    }
}



