<?php

namespace Database\Factories;

use App\Shared\Enums\DeliveryStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Delivery>
 */
class DeliveryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "status" => DeliveryStatusEnum::Process->value,
            "note_id" => fake()->uuid(),

        ];
    }
}
