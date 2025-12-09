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
        Schema::create('kategori_jamaah', function (Blueprint $table) {
    $table->unsignedBigInteger('id_jamaah');
    $table->unsignedBigInteger('id_kategori');

    $table->boolean('status_aktif')->default(true);
    $table->string('periode')->nullable();

    $table->primary(['id_jamaah', 'id_kategori']);

    $table->foreign('id_jamaah')
          ->references('id_jamaah')
          ->on('jamaah')
          ->onDelete('cascade');

    $table->foreign('id_kategori')
          ->references('id_kategori')
          ->on('kategori')
          ->onDelete('cascade');
    });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_jamaah');
    }
};
