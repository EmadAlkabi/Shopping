<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        "id",
        "user_id",
        "vendor_id",
        "state",
        "request_at",
        "response_at"
    ];

    public function vendor() {
        return $this->belongsTo("App\\Models\\Vendor");
    }

    public function orderItems() {
        return $this->hasMany("App\\Models\\OrderItem");
    }
}
