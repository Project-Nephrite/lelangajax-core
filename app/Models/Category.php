<?php

namespace App\Models;

use App\Casts\AzureFileUrlsCast;
use App\Casts\AzureUrlCast;
use App\Services\StoragePathManager;
use App\Services\StorageService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use HasFactory;

    private StorageService $storage;

    protected $table = "categories";

    protected $fillable = [
        'name',
        'description',
        'image_url'
    ];

    protected $casts = [
        'image_url' => AzureUrlCast::class
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
