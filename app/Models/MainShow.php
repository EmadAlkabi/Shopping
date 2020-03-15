<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MainShow extends Model
{
    protected $table = "main_show";
    protected $primaryKey = "id";
    public $timestamps = false;

    protected $fillable = [
        'id',
        'target_id',
        'type',
        'created_at'
    ];
}
