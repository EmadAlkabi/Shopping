<?php

namespace App\Models;

use App\Enum\MediaItemType;
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
        'company_name',
        'tags',
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

    public function images() {
        return $this->hasMany("App\Models\MediaItem")
            ->where("type", MediaItemType::IMAGE)
            ->oldest("id");
    }

    public function videos() {
        return $this->hasMany("App\Models\MediaItem")
            ->where("type", MediaItemType::VIDEO)
            ->oldest("id");
    }

    public function reviews() {
        return $this->hasMany('App\Models\Review')
            ->latest();
    }

    public function orders() {
        return $this->hasMany('App\Models\OrderItem')
            ->where('cart', '=', '0');
    }

    public function rating() {
        $rating = Review::select('rating')
            ->where('item_id', $this->id)
            ->avg('rating');

        return round($rating, 2);
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

        return $availableOffer->first()->discount_rate ?? 0;
    }
}
