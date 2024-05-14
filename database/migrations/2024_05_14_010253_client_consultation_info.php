<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::create("ClientConsultationInfo", function (Blueprint $table) {
            $table->id();
            $table->string("company_name", 255);
            $table->string("contact_person", 255);
            $table->string("contact_email", 255);
            $table->integer("contact_phone");
            $table->string("company_location", 255);
            $table->boolean("business_registration");
            $table->string("industry_category", 255);
            $table->string("consultation_item", 255);
            $table->integer("number_of_users");
            $table->string("notes", 1024);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists("ClientConsultationInfo");
    }
};
