<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    use HasFactory;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "amount" => fake()->numberBetween(10000, 50000000),
            "payment_method" => "Credit Card",
            "payment_provider" => "Bank Indonesia",
            "provider_ref_id" => fake()->uuid()
        ];
    }
}
