<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_item';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'user_id',
        'item_id',
        'currency',
        'price',
        'quantity',
        'cart',
        'order_id',
        'created_at'
    ];
}
