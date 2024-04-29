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
        Schema::create('sertifikasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_petani');
            $table->unsignedBigInteger('id_sertifikasi');
            $table->enum('status_sertifikasi', ['dalam proses', 'selesai', 'batal']);
            $table->timestamps();

            $table->foreign('id_petani')
                ->on('petani')
                ->references('id')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('id_sertifikasi')
                ->on('sertifikasi')
                ->references('id')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sertifikasi');
    }
};
