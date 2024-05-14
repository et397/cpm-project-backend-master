<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\IsBusinessRegistered;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\IsBusinessRegistered>
 */
class IsBusinessRegisteredFactory extends Factory
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
            "status" => $this->faker->randomElement(IsBusinessRegistered::description()['status']),
        ];
    }
}
