<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'user_id',
        'vendor_id',
        'total_price_dinar',
        'total_price_dollar',
        'state',
        'request_at',
        'response_at'
    ];

    public function vendor() {
        return $this->belongsTo('App\Models\Vendor');
    }

    public function items() {
        return $this->hasMany('App\Models\OrderItem');
    }
}
