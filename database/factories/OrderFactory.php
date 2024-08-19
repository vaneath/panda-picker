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
            'order_number' => '#' . $this->faker->unique()->regexify('[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{4}'),
            'order_status' => $this->faker->randomElement([OrderStatusEnum::WAITING, OrderStatusEnum::PREPARING, OrderStatusEnum::DONE]),
            'customer_name' => $this->faker->name(),
            'customer_phone_number' => $this->faker->regexify('0[0-9]{2} [0-9]{3} [0-9]{3}'),
            'floor' => $this->faker->numberBetween(1, 50),
        ];
    }
}
