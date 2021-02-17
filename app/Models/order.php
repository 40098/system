<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class order extends Model
{
    use HasFactory, Sortable;

    protected $fillable = ['user_id', 'customer_id', 'order_nr', 'status', 'handed', 'problem', 'description', 'password'];

    public $sortable = ['user_id', 'customer_id', 'order_nr', 'status', 'problem', 'description', 'updated_at', 'created_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function getOrderNumber()
{
    return str_pad($this->id, 8, "0", STR_PAD_LEFT);
}

}



