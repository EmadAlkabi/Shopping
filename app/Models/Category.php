<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        "id",
        "parent_id",
        "name",
        "image",
        "created_at",
        "updated_at"
    ];
}
