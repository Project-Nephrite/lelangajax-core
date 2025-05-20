<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Listing extends Model
{
    protected $table = "listings";
    protected $fillable = [
        "name",
        "description",
        "value_base",
        "value_current",
        "status",
        "bucket_url"
    ];

    /**
     * Fetch the auction schema this listing is applied to
     * @return BelongsTo
     */
    public function schema(): BelongsTo
    {
        return $this->belongsTo(AuctionScheme::class, "schema_id");
    }

    /**
     * Fetch the seller of this listing
     *
     * Return instance of User class as seller
     *
     * @return BelongsTo
     */
    public function seller(): BelongsTo
    {
        return $this->belongsTo(User::class, "seller_id");
    }

    /**
     * Fetch category of this listing
     *
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, "category_id");
    }


    /**
     * Fetch all bids to this listing
     *
     * @return HasMany
     */
    public function bids(): HasMany
    {
        return $this->hasMany(Bid::class, "listing_id");
    }
    /**
     * Fetch the transaction happening on this listing
     * @return HasOne
     */
    public function transaction(): HasOne
    {
        return $this->hasOne(Transaction::class, "listing_id");
    }

    /**
     * Fetch the dellivery for this listing
     *
     * @return HasOne
     */
    public function delivery(): HasOne
    {
        return $this->hasOne(Delivery::class, 'listing_id');
    }
}
