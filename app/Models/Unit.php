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
        'deleted'
    ];
}
