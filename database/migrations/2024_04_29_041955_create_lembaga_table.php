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
        Schema::create('lembaga', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lembaga')->nullable();
            $table->string('tahun_berdiri', 4)->nullable();
            $table->text('sertifikasi')->nullable();
            $table->string('bukti_akreditasi')->nullable();
            $table->boolean('status_verifikasi')->nullable();
            $table->text('alamat_lembaga')->nullable();
            $table->string('no_hp_lembaga')->nullable();
            $table->string('foto_lembaga')->nullable();
            $table->text('deskripsi_lembaga')->nullable();
            $table->unsignedBigInteger('id_user');
            $table->timestamps();

            $table->foreign('id_user')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lembaga');
    }
};
