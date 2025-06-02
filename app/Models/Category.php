<?php

namespace App\Models;

use Illuminate\Database\Concerns\BuildsQueries;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;


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
