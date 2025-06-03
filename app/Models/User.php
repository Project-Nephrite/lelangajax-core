<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'first_name',
        'last_name',
        'address',
        'email_alt',
        'phone',
        'profile_url',
        'nik',
        'birth_of_date',
        'home_address',
        'ktp_url',
        'verification_key',
        'remember_token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'ktp_url',
        'verification_key'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }


    /**
     * Fetch all bids made by this user.
     *
     * @return HasMany
     */
    public function bids(): HasMany
    {
        return $this->hasMany(Bid::class, "user_id");
    }

    /**
     * Fetch all purchases made by this user.
     *
     * Return the relation to Transaction.
     * @return HasMany
     */
    public function purchases(): HasMany
    {
        return $this->hasMany(Transaction::class, "buyer_id");
    }

    /**
     * Fetch all sale made by this user.
     *
     * Return the relation to Transaction.
     * @return HasMany
     */
    public function sales(): HasMany
    {
        return $this->hasMany(Transaction::class, "seller_id");
    }

    /**
     * Fetch all dispute open by this user
     *
     * @return HasMany
     */
    public function disputes(): HasMany
    {
        return $this->hasMany(Dispute::class, 'issuer_id');
    }

    /**
     * Fetch all lists of this user
     *
     * @return HasMany
     */
    public function listings(): HasMany
    {
        return $this->hasMany(Listing::class, 'seller_id');
    }

    /**
     * Fetch all deliveries to this user
     *
     * @return HasMany
     */
    public function deliveries(): HasMany
    {
        return $this->hasMany(Delivery::class, 'receiver_id');
    }
}
