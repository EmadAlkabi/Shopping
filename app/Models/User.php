<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = "users";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        "id",
        "name",
        "phone",
        "image",
        "address_1",
        "address_2",
        "gps",
        "state",
        "created_at",
        "updated_at"
    ];
}
