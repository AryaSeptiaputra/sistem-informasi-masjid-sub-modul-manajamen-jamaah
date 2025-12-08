<?php

namespace App\Services;

use App\Models\Kegiatan;
use App\Models\Jamaah;
use Illuminate\Database\Eloquent\Collection;

class KegiatanService
{
    public function getAll(): Collection
    {
        return Kegiatan::all();
    }

    public function getById(int $id): ?Kegiatan
    {
        return Kegiatan::find($id);
    }

    public function create(array $data): Kegiatan
    {
        return Kegiatan::create($data);
    }

    public function update(Kegiatan $kegiatan, array $data): Kegiatan
    {
        $kegiatan->update($data);
        return $kegiatan;
    }

    public function delete(Kegiatan $kegiatan): void
    {
        $kegiatan->delete();
    }

    /* =========================
     *  LOGIC RELASI KEGIATAN
     * ========================= */

    /**
     * Ambil semua jamaah peserta kegiatan
     */
    public function getPeserta(Kegiatan $kegiatan): Collection
    {
        return $kegiatan->jamaah()->get();
    }

    /**
     * Tambah peserta kegiatan
     */
    public function tambahPeserta(
        Kegiatan $kegiatan,
        Jamaah $jamaah,
        ?string $tanggalDaftar = null
    ): void {
        $kegiatan->jamaah()->attach($jamaah->id_jamaah, [
            'tanggal_daftar'   => $tanggalDaftar ?? now()->toDateString(),
            'status_kehadiran' => 'belum',
        ]);
    }

    /**
     * Ubah status kehadiran seorang jamaah di kegiatan
     */
    public function ubahStatusKehadiran(
        Kegiatan $kegiatan,
        Jamaah $jamaah,
        string $status
    ): void {
        $kegiatan->jamaah()->updateExistingPivot($jamaah->id_jamaah, [
            'status_kehadiran' => $status,
        ]);
    }
}
