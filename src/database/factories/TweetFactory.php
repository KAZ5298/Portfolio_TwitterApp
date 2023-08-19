<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Tweet;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tweet>
 */
class TweetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->numberBetween(1,5),
            'content' => $this->faker->numerify('hogehoge ###'),
            'created_at' => $this->faker->date($format = 'Y-m-d H:i:s', $max = 'now'),
        ];
    }
}
