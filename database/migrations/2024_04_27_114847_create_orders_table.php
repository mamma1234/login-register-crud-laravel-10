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
            $table->boolean('is_mix')->default(0);
            $table->boolean('is_urgent')->default(0);
            $table->boolean('is_round')->default(0);
            $table->string('car_ton', 10)->nullable();
            $table->string('car_type', 10)->nullable();
            $table->string('freight_ton', 10)->nullable();
            $table->string('start_date', 8)->nullable();
            $table->string('end_date', 8)->nullable();
            $table->string('start_work', 30)->nullable();
            $table->string('end_work', 30)->nullable();
            $table->string('freight_desc', 100)->nullable();
            $table->string('fare_pay_type', 30)->nullable();
            $table->integer('fare')->nullable();
            $table->integer('fee')->nullable();
            $table->string('end_phone_number', 30)->nullable();
            $table->string('user_type', 10)->default('01');
            $table->string('shipper_name', 30)->nullable();
            $table->string('shipper_phone_number', 30)->nullable();
            $table->string('shipper_biz_number', 30)->nullable();
            $table->boolean('is_tax_invoice')->default(0);
            $table->string('pay_due_date', 8)->nullable();
            $table->string('twentyfour_id', 10)->nullable();
            $table->string('twentyfour_order_no', 30)->nullable();
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
