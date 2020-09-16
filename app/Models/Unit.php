<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = "units";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        "id",
        "item_id",
        "offline_id",
        "name",
        "quantity",
        "price",
        "main",
        "content",
        "child_id",
        "created_at",
        "updated_at"
    ];

    public function child()
    {
        return Unit::where("id", $this->child_id)
            ->first();
    }
}
