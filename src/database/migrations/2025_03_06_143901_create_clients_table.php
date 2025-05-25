<?php

use App\Enums\ClientProfileTypeEnum;
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
        Schema::create('clients', function (Blueprint $table) {
            $table->id()->primary();
            $table->enum('profile_type', ClientProfileTypeEnum::toArray());
            $table->text('message')->nullable();
            $table->boolean('accept_privacy');

            // AgencyProfile fields
            $table->string('A_name')->nullable();
            $table->string('A_country')->nullable();
            $table->string('A_email')->nullable();
            $table->string('A_ref_name')->nullable();
            $table->string('A_ref_surname')->nullable();
            $table->string('A_mobile')->nullable();

            // GuideProfile fields
            $table->string('G_name')->nullable();
            $table->string('G_surname')->nullable();
            $table->string('G_country')->nullable();
            $table->string('G_email')->nullable();
            $table->string('G_mobile')->nullable();

            // HotelProfile fields
            $table->string('H_name')->nullable();
            $table->string('H_email')->nullable();
            $table->string('H_ref_name')->nullable();
            $table->string('H_ref_surname')->nullable();
            $table->string('H_mobile')->nullable();

            // LaicOrganizerProfile fields
            $table->string('L_name')->nullable();
            $table->string('L_surname')->nullable();
            $table->string('L_country')->nullable();
            $table->string('L_email')->nullable();
            $table->string('L_mobile')->nullable();

            // ReligiousAccompanistProfile fields
            $table->string('R_name')->nullable();
            $table->string('R_surname')->nullable();
            $table->string('R_country')->nullable();
            $table->string('R_email')->nullable();
            $table->string('R_mobile')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
