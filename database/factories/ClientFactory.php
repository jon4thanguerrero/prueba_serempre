<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $cityID = [1, 2, 3];

        return [
            'code' => (string) mt_rand(pow(10, 0), pow(10, 9) - 1),
            'name' => fake()->name(),
            'city_id' => Arr::random($cityID),
        ];
    }
}
