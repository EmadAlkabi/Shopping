<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfferItem extends Model
{
    protected $table = 'offer_item';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'offer_id',
        'item_id',
        'discount_rate',
        'created_at'
    ];
}
