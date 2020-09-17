<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        "name",
        "image",
        "parent_id",
        "main_show",
        "created_at",
        "updated_at"
    ];

    public function parent()
    {
        return Category::where("id", $this->parent_id)->first();
    }
}
