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
        Schema::create('employee', function (Blueprint $table) {
            $table->bigIncrements('id_employee');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('nip');
            $table->string('email')->unique();
            $table->string('role')->nullable();
            $table->string('password');
            $table->string('no_telp');
            $table->string('address');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee');
    }
};
