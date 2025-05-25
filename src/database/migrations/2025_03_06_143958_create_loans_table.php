<?php

use App\Enums\LoanStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->timestamp('loan_date');
            $table->enum('status', LoanStatusEnum::toArray())->default(LoanStatusEnum::ACTIVE);
            $table->string('identifier')->nullable();
            $table->date('return_date')->nullable();
            $table->date('returned_at')->nullable();
            $table->string('pdf_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
