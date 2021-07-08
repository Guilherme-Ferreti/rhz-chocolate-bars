<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\ChocolateBar;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChocolateBarFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ChocolateBar::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'weight' => $this->faker->numberBetween(1, 1000),
            'code' => Str::random(8),
        ];
    }
}
