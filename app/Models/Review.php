<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'user_id',
        'item_id',
        'rating',
        'comment',
        'created_at'
    ];

    public function user() {
        return $this->belongsTo("App\Models\User");
    }
}
