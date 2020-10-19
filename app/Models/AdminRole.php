<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminRole extends Model
{
    protected $table = "admin_role";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        "admin_id",
        "role_id"
    ];
}
