<?php

namespace App\Models;

use App\Enum\MediaItemType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Item extends Model
{
    protected $table = "items";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        "vendor_id",
        "offline_id",
        "name",
        "public_name",
        "company",
        "tags",
        "details",
        "barcode",
        "code",
        "currency",
        "category_id",
        "deleted",
        "created_at",
        "updated_at"
    ];

    public function vendor()
    {
        return $this->belongsTo('App\Models\Vendor');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function orders()
    {
        return $this->hasMany("App\\Models\\OrderItem")
            ->where("cart", "=", 0);
    }
    public function reviews()
    {
        return $this->hasMany("App\\Models\\Review")
            ->latest();
    }

    public function rating()
    {
        return round($this->reviews()->avg("rate"), 2);
    }

    public function units()
    {
        return $this->hasMany("App\\Models\\Unit");
    }

    public function mainUnit()
    {
        return $this->units()
            ->where("main","=", 1)
            ->first();
    }








    public function images() {
        return $this->hasMany("App\Models\MediaItem")
            ->where("type", MediaItemType::IMAGE)
            ->orderBy("main", "DESC")
            ->orderBy("id", "ASC");
    }

    public function videos() {
        return $this->hasMany("App\Models\MediaItem")
            ->where("type", MediaItemType::VIDEO)
            ->orderBy("main", "DESC")
            ->orderBy("id", "ASC");
    }

    public function mainImage() {
        $image = $this->images()->where("main","=", 1)->first();
        return is_null($image) ? $this->images()->first() : $image;
    }






    public function discountRate() {

        return 0;



        $offers = OfferUnit::where('item_id', $this->id)
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
