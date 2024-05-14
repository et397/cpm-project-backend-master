<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\IndustryCategories; // Add this line

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            CityDirectorySeeder::class,
            IndustryCategoriesSeeder::class,
            IsBusinessRegisteredSeeder::class,
            ClientConsultationInfoseeder::class,
            InquiryItemsSeeder::class
        ]);
    }
}
