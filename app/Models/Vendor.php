<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $table = "vendors";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        "name",
        "email",
        "phone",
        "gps",
        "detail",
        "state",
        "created_at",
        "updated_at",
    ];

    public function items() {
        return $this->hasMany("App\\Models\\Item");
    }
}
