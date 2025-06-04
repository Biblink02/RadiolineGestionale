<?php

use App\Enums\ClientProfileTypeEnum;
use App\Enums\LoanStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();

            $table->enum('status', LoanStatusEnum::toArray())->default(LoanStatusEnum::ACTIVE);
            $table->date('date')->default(Carbon::now())->nullable();
            $table->enum('booking_type', ClientProfileTypeEnum::toArray())->nullable();
            $table->string('customer_code')->nullable();
            $table->string('email')->nullable();
            $table->string('channel')->nullable();
            $table->string('mobile_phone')->nullable();
            $table->string('accommodation')->nullable();
            $table->date('delivery_date')->nullable();
            $table->date('radio_return_date')->nullable();
            $table->unsignedInteger('rental_days')->nullable();
            $table->unsignedInteger('power_bank')->nullable();
            $table->unsignedInteger('spare_batteries')->nullable();
            $table->string('reference')->nullable();
            $table->string('pdf_url')->nullable();

            $table->timestamps();
        });

        DB::statement('ALTER TABLE loans AUTO_INCREMENT = 1000');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
