<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'from' => $this->faker->numberBetween(1, 10),
            'to' => $this->faker->numberBetween(1, 10),
            'content' => $this->faker->sentence,
            'read' => $this->faker->boolean,
            'read_at' => $this->faker->dateTime,
            'sent_at' => $this->faker->dateTime,
        ];
    }
}
