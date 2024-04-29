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
        Schema::create('report_artikel', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_artikel');
            $table->string('saran_artikel');
            $table->date('tanggal_report');
            $table->timestamps();

            $table->foreign('id_artikel')
                ->references('id')
                ->on('artikel')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_artikel');
    }
};
