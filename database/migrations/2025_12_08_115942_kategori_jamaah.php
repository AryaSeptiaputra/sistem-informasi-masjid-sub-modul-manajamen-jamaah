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
            $table->foreignId('id_jamaah')->constrained('jamaah')->cascadeOnDelete();
            $table->foreignId('id_kategori')->constrained('kategori')->cascadeOnDelete();
            $table->boolean('status_aktif')->default(true);
            $table->string('periode')->nullable();

            $table->primary(['id_jamaah','id_kategori']);
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
