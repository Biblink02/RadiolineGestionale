<?php

use App\Enums\LoanRadioStateEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('loan_radio', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loan_id')->constrained('loans')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('radio_id')->constrained('radios')->cascadeOnDelete()->cascadeOnUpdate();
            $table->enum('state', LoanRadioStateEnum::toArray())->default(LoanRadioStateEnum::LOANED);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_radio');
    }
};
