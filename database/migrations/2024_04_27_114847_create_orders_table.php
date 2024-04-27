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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('start_address_siNm', 100)->nullable();
            $table->string('start_address_sggNm', 100)->nullable();
            $table->string('start_address_emdNm', 100)->nullable();
            $table->string('start_address_detail', 100)->nullable();
            $table->string('end_address_siNm', 100)->nullable();
            $table->string('end_address_sggNm', 100)->nullable();
            $table->string('end_address_emdNm', 100)->nullable();
            $table->string('end_address_detail', 100)->nullable();
            $table->boolean('is_mix');
            $table->boolean('is_urgent');
            $table->boolean('is_round');
            $table->string('car_ton', 10);
            $table->string('car_type', 10);
            $table->string('freight_ton', 10);

            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
