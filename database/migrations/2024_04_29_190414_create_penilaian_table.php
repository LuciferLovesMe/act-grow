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
        Schema::create('penilaian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_lembaga');
            $table->unsignedBigInteger('id_petani');
            $table->integer('nilai');
            $table->string('komentar_petani')->nullable();
            $table->string('komentar_lembaga')->nullable();
            $table->timestamps();

            $table->foreign('id_lembaga')
                ->references('id')
                ->on('lembaga')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('id_petani')
                ->references('id')
                ->on('petani')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian');
    }
};
