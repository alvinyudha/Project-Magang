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
        Schema::create('disolirs', function (Blueprint $table) {
            $table->id();
            $table->string('customer_code')->nullable();
            $table->unsignedBigInteger('group_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->string('name');
            $table->string('identity_card_number')->nullable();
            $table->string('address');
            $table->string('no_telp')->nullable();
            $table->string('status');
            $table->timestamps();

            $table->foreign('company_id')->references('id_company')->on('company')->onDelete('cascade');
            $table->foreign('group_id')->references('id')->on('tariff_groups');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disolirs');
    }
};
