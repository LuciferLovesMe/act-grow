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
        Schema::create('template_sertifikasi', function (Blueprint $table) {
            $table->id();
            $table->string('template_sertifikasi')->nullable()->comment('untuk path upload template');
            $table->unsignedBigInteger('id_lembaga');
            $table->string('sertifikasi');
            $table->timestamps();

            $table->foreign('id_lembaga')
                ->references('id')
                ->on('lembaga')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('template_sertifikasi');
    }
};
