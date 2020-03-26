<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table = 'offers';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'vendor_id',
        'title',
        'description',
        'image',
        'start_date',
        'end_date',
        'created_at'
    ];

    public function vendor() {
        return $this->belongsTo("App\Models\Vendor");
    }

    public function offerItems() {
        return $this->hasMany("App\Models\OfferItem");
    }
}
