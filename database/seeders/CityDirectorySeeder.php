<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CityDirectorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        \App\Models\CityDirectory::create([
            'city' => '臺北市',
        ]);
        
        \App\Models\CityDirectory::factory()->count(10)->create();
    }
}
