<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\IsBusinessRegistered;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClientConsultationInfo>
 */
class ClientConsultationInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = ClientConsultationInfo::class;

    public function definition(): array
    {
        return [
            //
            'company_name' => $this->faker->company,
            'contact_person' => $this->faker->name,
            'contact_email' => $this->faker->safeEmail,
            'contact_phone' => $this->faker->phoneNumber,
            //到時從縣市model裡拿資料
            'company_location' => $this->faker->address,
            //到時從營業登記表裡model裡拿資料
            'business_registration' => $this->faker->randomElement(IsBusinessRegistered::description()['status']),
            //到時從產業類別model裡拿資料
            'industry_category' => $this->faker->word,
            //到時從諮詢項目model裡拿資料
            'consultation_item' => $this->faker->word,
            'number_of_users' => ("consultation_item" == "報價") ? $this->faker->numberBetween(1, 100) : null,
            'notes' => $this->faker->sentence,
        ];
    }
}
