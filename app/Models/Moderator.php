<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Moderator extends Model
{
    use HasFactory;
    /**
     * @var list<string>
     */
    protected $fillable = ["display_name"];

    /**
     * Name of the table model intended for
     */
    protected $table = "moderators";


    /**
     * Fetch all disputes related to this moderator
     *
     * Return instance of class HasMany.
     * @return HasMany
     */
    public function disputes(): HasMany
    {
        return $this->hasMany(Dispute::class);
    }
}
