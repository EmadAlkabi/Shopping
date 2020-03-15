<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'vendor_id',
        'offline_id',
        'name',
        'details',
        'barcode',
        'code',
        'currency',
        'price',
        'unit',
        'quantity',
        'category_id',
        'deleted',
        'created_at'
    ];

    public function vendor() {
        return $this->belongsTo('App\Models\Vendor');
    }

    public function category() {
        return $this->belongsTo('App\Models\Category');
    }

    public function reviews() {
        return $this->hasMany('App\Models\Review');
    }

    public function orders() {
        return $this->hasMany('App\Models\OrderItem')
            ->where('cart', '=', '0');
    }

    public function rating() {
        return (float)Review::select('rating')
            ->where('item_id', $this->id)
            ->avg('rating');
    }

    public function discountRate() {
        $offers = OfferItem::where('item_id', $this->id)
            ->orderByDesc('discount_rate')
            ->get();

        $availableOffer = $offers->filter(function ($offer) {
            return Offer::where('id', $offer->offer_id)
                ->where('end_date', '>=', date('Y-m-d'))
                ->first();
        });

        return $availableOffer->first()->discount_rate;
    }
}
