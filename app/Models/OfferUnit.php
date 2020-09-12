<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfferUnit extends Model
{
    protected $table = 'offer_unit';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'offer_id',
        'item_id',
        'discount_rate',
        'created_at'
    ];

    public function item() {
        return $this->belongsTo("App\Models\Item");
    }
}
