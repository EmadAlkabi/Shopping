<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = "admins";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        "vendor_id",
        "name",
        "username",
        "password",
        "state",
        "last_login",
        "token",
        "created_at",
        "updated_at"
    ];

    public function roles()
    {
        return $this->belongsToMany("App\\Models\\Role")
            ->orderBy("id");
    }
}
