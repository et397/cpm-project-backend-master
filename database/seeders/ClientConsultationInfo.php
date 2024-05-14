<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientConsultationInfo extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        \App\Models\ClientConsultationInfo::factory(10)->create();

        \App\Models\ClientConsultationInfo::create([
            'company_name' => '長榮航空股份有限公司',
            'contact_person' => '黃某某',
            'contact_email' => 'example@gmail.com',
            'contact_phone' => 0912345678,
            'company_location' => '桃園市',
            'business_registration' => true,
            'industry_category' => '運輸物流業',
            'consultation_item' => '報價',
            'number_of_users' => 1,
            'notes' => '備註',
        ]);
    }
}
