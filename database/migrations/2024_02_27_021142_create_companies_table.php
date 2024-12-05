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
        Schema::create('company', function (Blueprint $table) {
            $table->bigIncrements('id_company');
            $table->string('company_code')->nullable();
            $table->String('name');
            $table->text('address');
            $table->String('email')->unique();
            $table->String('fax');
            $table->String('pict');
            $table->String('no_telp');
            $table->float('retribution')->after('no_telp')->nullable();
            $table->float('fines')->after('retribution')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('company');
    }
};
