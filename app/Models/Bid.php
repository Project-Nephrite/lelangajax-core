<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bid extends Model
{
    protected $table = "bids";
    protected $fillable = [
        "timestamp",
        "index"
    ];

    /**
     * Fetch the bidder.
     *
     * Returns BelongsTo instance associated with User class
     * @return BelongsTo
     */
    public function bidder(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id");
    }

    /**
     * Fetch the listing this bid is bidded to
     *
     * @return BelongsTo
     */
    public function listing(): BelongsTo
    {
        return $this->belongsTo(Listing::class, "listing_id");
    }
}
