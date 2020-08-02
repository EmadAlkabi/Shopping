<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = "units";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'item_id',
        'offline_id',
        'name',
        'quantity',
        'price',
        'main',
        "content",
        "child_id"
    ];

    public function child()
    {
        return Unit::where("item_id", $this->item_id)
            ->where("offline_id", $this->child_id)
            ->first();
    }
}
