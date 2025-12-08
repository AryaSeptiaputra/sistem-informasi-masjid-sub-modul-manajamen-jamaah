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
            $table->foreignId('id_jamaah')->constrained('jamaah')->cascadeOnDelete();
            $table->foreignId('id_kegiatan')->constrained('kegiatan')->cascadeOnDelete();
            $table->date('tanggal_daftar')->nullable();
            $table->string('status_kehadiran')->default('belum');

            $table->primary(['id_jamaah','id_kegiatan']);
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
