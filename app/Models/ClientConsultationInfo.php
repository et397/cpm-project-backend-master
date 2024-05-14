<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientConsultationInfo extends Model
{
    protected $table = "ClientConsultationInfo";
    protected $fillable = [
        "company_name",
        "contact_person",
        "contact_email",
        "contact_phone",
        "company_location",
        "business_registration",
        "industry_category",
        "consultation_item",
        "number_of_users",
        "notes",
    ];

    use HasFactory;
}
