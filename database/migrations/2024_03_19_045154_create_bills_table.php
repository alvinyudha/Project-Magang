<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('record_meter_id');
            $table->double('usage_amount');
            $table->string('total_bill');
            $table->enum('status', ['unpaid', 'paid'])->default('unpaid');
            $table->float('last_meter');
            $table->float('current_meter');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamp('created_at')->useCurrent()->timezone('Asia/Jakarta')->change();
            $table->timestamp('updated_at')->useCurrent()->timezone('Asia/Jakarta')->change()->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id_customer')->on('customers')->onDelete('cascade');
            $table->foreign('record_meter_id')->references('id')->on('record_meters')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('bills');
    }
}
