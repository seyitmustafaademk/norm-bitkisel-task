<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = Category::all()->pluck('id')->toArray();
        return [
            'category_id' => $this->faker->randomElement($categories),
            'name' => $this->faker->sentence(2),
            'description' => $this->faker->sentence(10),
            'stock' => $this->faker->numberBetween(1, 100),
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'image' => $this->faker->imageUrl(),
            'status' => $this->faker->boolean(75),
            'slug' => $this->faker->slug(),
        ];
    }
}
