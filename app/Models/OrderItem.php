<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = "order_item";
    protected $primaryKey = "id";
    public $timestamps = false;

    protected $fillable = [
        "user_id",
        "item_id",
        "unit_id",
        "price",
        "quantity",
        "cart",
        "order_id",
        "created_at",
        "updated_at"
    ];

    public function item() {
        return $this->belongsTo("App\\Models\\Item");
    }

    public function unit() {
        return $this->belongsTo("App\\Models\\Unit");
    }
}
