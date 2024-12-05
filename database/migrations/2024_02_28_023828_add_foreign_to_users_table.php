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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable()->after('id');
            $table->foreign('company_id')->references('id_company')->on('company');
            $table->unsignedBigInteger('role')->nullable()->after('email');
            $table->foreign('role')->references('id')->on('roles');
            // $table->foreign('role')->references('role_id')->on('model_has_roles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('users', function (Blueprint $table) {
        //     //
        //     $table->dropForeign(['company_id', 'role']);
        //     $table->dropColumn(['company_id', 'role']);
        // });
    }
};