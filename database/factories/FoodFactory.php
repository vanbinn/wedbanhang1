<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Food>
 */
class FoodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create();
        return [
            'description' => $faker->name(),
            'name' => $faker->name(),
            'price' => $faker->randomFloat(2, 1, 100),
            'image' => now(),
            'category_id' => rand(1,5),
        ];
    }
    
}
