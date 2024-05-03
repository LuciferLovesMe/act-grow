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
        Schema::table('sertifikasi', function (Blueprint $table) {
            $table->dropForeign(['id_sertifikasi']);
            $table->dropColumn('id_sertifikasi');

            $table->unsignedBigInteger('id_template_sertifikasi')->after('id_petani');
            $table->foreign('id_template_sertifikasi')
                ->references('id')
                ->on('template_sertifikasi')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sertifikasi', function (Blueprint $table) {
            //
        });
    }
};
