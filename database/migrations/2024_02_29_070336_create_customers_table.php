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
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id_customer');
            $table->string('customer_code')->nullable();
            $table->unsignedBigInteger('group_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->string('name');
            $table->string('identity_card_number')->nullable();
            $table->string('address');
            $table->string('no_telp')->nullable();
            $table->string('location')->nullable();
            $table->string('land_status')->nullable();
            $table->string('land_area')->nullable();
            $table->string('building_area')->nullable();
            $table->string('meter_number')->nullable();
            $table->enum('status', ['isolated', 'avaliable'])->default('avaliable');
            $table->timestamps();

            // Add foreign key constraint
            $table->foreign('company_id')->references('id_company')->on('company')->onDelete('cascade');
            $table->foreign('group_id')->references('id')->on('tariff_categories')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('customers', function (Blueprint $table) {
        //     // Drop foreign key constraint
        //     $table->dropForeign(['group_id']);
        // });
        // Schema::dropIfExists('customers');
    }
};
