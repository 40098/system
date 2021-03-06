<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class customer extends Model
{
    use HasFactory, Sortable;

    protected $fillable = ['name', 'mobile_phone', 'house_phone', 'email', 'address', 'zip', 'city'];

    public $sortable = ['name', 'city', 'updated_at', 'created_at'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}

