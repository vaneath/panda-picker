<?php

namespace Database\Factories;

use App\Enums\OrderStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_number' => $this->faker->words(3, true),
            'order_status' => $this->faker->randomElement([OrderStatusEnum::WAITING, OrderStatusEnum::PREPARING, OrderStatusEnum::DONE]),
            'customer_name' => $this->faker->name(),
            'customer_phone_number' => $this->faker->phoneNumber(),
            'floor' => $this->faker->randomDigit(),
        ];
    }
}
