<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuctionScheme extends Model
{
    protected $table = "auction_schemes";

    protected $fillable = [
            "name",
            "config",
            "description"
        ];
}
