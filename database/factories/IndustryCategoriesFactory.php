<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\IndustryCategories;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\IndustryCategories>
 */
class IndustryCategoriesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'category_name' => $this->faker->randomElement(IndustryCategories::description()['category_name']),
        ];
    }
}
