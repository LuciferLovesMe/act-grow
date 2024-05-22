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
        Schema::create('arsip_sertifikat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_petani');
            $table->unsignedBigInteger('id_template_sertifikasi');
            $table->string('tahun', 4);
            $table->string('file');
            
            $table->foreign('id_petani')
                ->references('id')
                ->on('petani')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            
            $table->foreign('id_template_sertifikasi')
                ->references('id')
                ->on('template_sertifikasi')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arsip_sertifikat');
    }
};
