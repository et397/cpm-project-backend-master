<?php
    namespace App\Resources;
    use Illuminate\Http\Resources\Json\JsonResource;

    class InquiryResource extends JsonResource
    {
        public function toArray($Inquirys)
        {
            return [
                'company_name' => $Inquirys->company_name,
                'contact_person' => $Inquirys->contact_person,
                'contact_email' => $Inquirys->contact_email,
                'contact_phone' => $Inquirys->contact_phone,
                'company_location' => $Inquirys->company_location,
                'business_registration' => $Inquirys->business_registration,
                'industry_category'  => $Inquirys->industry_category,
                'consultation_item' => $Inquirys->consultation_item,
                'number_of_users' => $Inquirys->number_of_users,
                'notes' => $Inquirys->notes,
            ];
        }
    }