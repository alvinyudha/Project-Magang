<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('record_meters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_customer')->nullable();
            $table->foreign('id_customer')->references('id_customer')->on('customers')->onDelete('cascade');
            $table->date('date');
            $table->float('last_meter');
            $table->float('current_meter');
            $table->string('meter_photos')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('record_meters');
    }
};
