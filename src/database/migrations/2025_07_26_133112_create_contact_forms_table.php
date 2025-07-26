<?php

use App\Enums\ContactFormProfileTypeEnum;
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
        Schema::create('contact_forms', function (Blueprint $table) {
            $table->id();

            $table->string('firstName');
            $table->string('lastName');
            $table->string('phone')->nullable();
            $table->string('email');
            $table->string('country')->nullable();
            $table->enum('profileType', ContactFormProfileTypeEnum::toArray());
            $table->text('message');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_forms');
    }
};
