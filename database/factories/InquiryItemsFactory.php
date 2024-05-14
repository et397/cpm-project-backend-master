<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\InquiryItems;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InquiryItems>
 */
class InquiryItemsFactory extends Factory
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
            'item' => $this->faker->randomElement(InquiryItems::description()['item']),
        ];
    }
}
