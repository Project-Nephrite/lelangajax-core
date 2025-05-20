<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{


    protected $table = "categories";

    protected $fillable = [
        'name',
        'description'
    ];


    /**
     * Fetch all listings under this category
     *
     * @return HasMany
     */
    public function listings(): HasMany
    {
        return $this->hasMany(Listing::class, "category_id");
    }
}
