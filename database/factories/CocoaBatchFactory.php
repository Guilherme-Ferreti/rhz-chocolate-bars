<?php

namespace Database\Factories;

use App\Models\CocoaBatch;
use Illuminate\Database\Eloquent\Factories\Factory;

class CocoaBatchFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CocoaBatch::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'description' => $this->faker->unique()->words(8, true),
            'provider' => CocoaBatch::PROVIDERS[array_rand(CocoaBatch::PROVIDERS)],
            'origin' => CocoaBatch::ORIGINS[array_rand(CocoaBatch::ORIGINS)],
        ];
    }
}
