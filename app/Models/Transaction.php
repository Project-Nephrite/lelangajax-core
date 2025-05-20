<?php

namespace App\Models;

use App\Shared\Enums\TransactionStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{

    protected $table = "transactions";

    protected $fillable = [
        "amount",
        "status",
        "payment_method",
        "payment_provider",
        "metadata",
        "provider_ref_id"
    ];

    protected function casts(): array
    {
        return [
            "status" => TransactionStatusEnum::class
        ];
    }

    /**
     * Get the total nominal of this transaction formatted with currency
     *
     * @return string
     */
    public function getAmountTag(): string
    {
        return "Rp. " . $this->amount;
    }

    /**
     * Fetch the associated listing of this transactions.
     *
     * @return BelongsTo
     */
    public function listing(): BelongsTo
    {
        return $this->belongsTo(Listing::class, 'listing_id');
    }


    /**
     * Fetch the seller data.
     *
     * Return relation to user related to this transcation as the seller
     * @return BelongsTo
     */
    public function seller(): BelongsTo
    {
        return $this->belongsTo(User::class, "seller_id");
    }


    /**
     * Fetch the buyer data.
     *
     * Return relation to user related to this transaction as the buyer
     * @return BelongsTo
     */
    public function buyer(): BelongsTo
    {
        return $this->belongsTo(User::class, "buyer_id");
    }
}
