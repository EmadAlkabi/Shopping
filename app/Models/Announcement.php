<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $table = "announcements";
    protected $primaryKey = "id";
    public $timestamps = false;
}
