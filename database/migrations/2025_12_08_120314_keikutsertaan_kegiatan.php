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
        Schema::create('keikutsertaan_kegiatan', function (Blueprint $table) {
    $table->unsignedBigInteger('id_jamaah');
    $table->unsignedBigInteger('id_kegiatan');

    $table->date('tanggal_daftar')->nullable();
    $table->string('status_kehadiran')->default('belum');

    $table->primary(['id_jamaah', 'id_kegiatan']);

    $table->foreign('id_jamaah')
          ->references('id_jamaah')
          ->on('jamaah')
          ->onDelete('cascade');

    $table->foreign('id_kegiatan')
          ->references('id_kegiatan')
          ->on('kegiatan')
          ->onDelete('cascade');
});


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keikutsertaan_kegiatan');
    }
};
