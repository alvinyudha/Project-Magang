<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('tariff_levels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('group_id'); // Menggunakan unsignedBigInteger untuk kunci asing$table->string('level');
            $table->string('level');
            $table->integer('tariff');
            $table->timestamps();

            // Menambahkan kunci asing untuk group_id yang merujuk ke id di tabel group_tariffs
            $table->foreign('group_id')->references('id')->on('tariff_groups')->onDelete('cascade');
        });
    }

    public function down()
    {
        // Schema::dropIfExists('tariff_levels');
    }
};
