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
        Schema::table('template_sertifikasi', function (Blueprint $table) {
            $table->integer('masa_berlaku')->nullable()->after('sertifikasi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('template_sertifikasi', function (Blueprint $table) {
            //
        });
    }
};
