<?php

use App\Enums\RadioStatusEnum;
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
        Schema::create('radios', function (Blueprint $table) {
            $table->id();
            $table->string('identifier')->unique();
            $table->enum('status', RadioStatusEnum::toArray())->default(RadioStatusEnum::AVAILABLE);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('radios');
    }
};
