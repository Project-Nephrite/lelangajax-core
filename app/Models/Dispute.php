<?php

namespace App\Models;

use App\Shared\Enums\DisputeStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Dispute extends Model
{
    use HasFactory;

    protected $fillable = [
        "status",
        "opened_at",
        "closed_at"
    ];


    protected function casts(): array
    {

        return [
            "status" => DisputeStatusEnum::class
        ];
    }


    /**
     * Fetch associated table "Moderator" to this dispute.
     *
     * Returns class instance of BelongsTo, can be used to iterate or access its attributes
     * @return BelongsTo
     */
    public function moderator(): BelongsTo
    {
        return $this->belongsTo(Dispute::class, "moderator_id");
    }

    /**
     * Fetch user who open this disupute
     * @return BelongsTo
     */
    public function issuer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'issuer_id');
    }
}
