<?php
    namespace App\Resources;
    use Illuminate\Http\Resources\Json\JsonResource;

    class CustomerInquiryResource extends JsonResource
    {
        public function toArray($city = [], $industry = [], $inquiry = [], $is_business_registered = [])
        {
            return [
                'city' => $city,
                'industry' => $industry,
                'inquiry' => $inquiry,
                'is_business_registered' => $is_business_registered,
            ];
        }
    }