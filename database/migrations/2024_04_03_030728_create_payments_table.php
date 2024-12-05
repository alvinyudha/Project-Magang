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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->string('customer_code')->nullable();
            $table->string('name')->nullable();
            $table->string('group_name')->nullable();
            $table->unsignedBigInteger('bill_id');
            $table->float('last_meter')->nullable();
            $table->float('current_meter')->nullable();
            $table->string('period')->nullable();
            $table->float('usage_amount')->nullable();
            $table->float('total_bill')->nullable();
            $table->float('retribution')->nullable();
            $table->float('fines')->nullable();
            $table->float('total_payment')->nullable();
            $table->string('status');
            $table->date('payment_date')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('customer_id')->references('id_customer')->on('customers')->onDelete('cascade');
            $table->foreign('bill_id')->references('id')->on('bills')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
