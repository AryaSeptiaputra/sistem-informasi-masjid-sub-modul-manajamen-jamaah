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
        Schema::create('riwayat_donasi', function (Blueprint $table) {
    $table->id('id_riwayat');
    $table->unsignedBigInteger('id_jamaah');
    $table->unsignedBigInteger('id_donasi');
    $table->decimal('jumlah', 12, 2);
    $table->date('tanggal_donasi')->nullable();
    $table->timestamps();

    $table->foreign('id_jamaah')
          ->references('id_jamaah')
          ->on('jamaah')
          ->onDelete('cascade');

    $table->foreign('id_donasi')
          ->references('id_donasi')
          ->on('donasi')
          ->onDelete('cascade');
});


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_donasi');
    }
};
