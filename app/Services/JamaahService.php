<?php

namespace App\Services;

use App\Models\Jamaah;
use App\Models\Kategori;
use App\Models\Kegiatan;
use App\Models\Donasi;
use Illuminate\Database\Eloquent\Collection;

class JamaahService
{
    public function getAll(): Collection
    {
        return Jamaah::all();
    }

    public function getById(int $id): ?Jamaah
    {
        return Jamaah::where('id_jamaah', $id)->first();
    }

    public function create(array $data): Jamaah
    {
        if (isset($data['kata_sandi'])) {
            $data['kata_sandi'] = bcrypt($data['kata_sandi']);
        }

        return Jamaah::create($data);
    }

    public function update(Jamaah $jamaah, array $data): Jamaah
    {
        if (isset($data['kata_sandi'])) {
            $data['kata_sandi'] = bcrypt($data['kata_sandi']);
        }

        $jamaah->update($data);
        return $jamaah;
    }

    public function delete(Jamaah $jamaah): void
    {
        $jamaah->delete();
    }


    /* =========================
     *  LOGIC RELASI JAMA'AH
     * ========================= */

    /**
     * Sinkronisasi kategori jamaah.
     */
    public function syncKategori(Jamaah $jamaah, array $kategoriIds, ?string $periode = null): void
    {
        $syncData = [];
        foreach ($kategoriIds as $idKategori) {
            $syncData[$idKategori] = [
                'status_aktif' => true,
                'periode'      => $periode,
            ];
        }

        $jamaah->kategori()->sync($syncData);
    }

    /**
     * Tambah jamaah ke kegiatan tertentu.
     */
    public function daftarKegiatan(Jamaah $jamaah, Kegiatan $kegiatan, ?string $tanggalDaftar = null): void
    {
        $jamaah->kegiatan()->attach($kegiatan->id_kegiatan, [
            'tanggal_daftar'   => $tanggalDaftar ?? now()->toDateString(),
            'status_kehadiran' => 'belum',
        ]);
    }

    /**
     * Update status kehadiran.
     */
    public function updateKehadiran(Jamaah $jamaah, Kegiatan $kegiatan, string $status): void
    {
        $jamaah->kegiatan()->updateExistingPivot($kegiatan->id_kegiatan, [
            'status_kehadiran' => $status,
        ]);
    }

    /**
     * Catat donasi baru.
     */
    public function catatDonasi(
        Jamaah $jamaah,
        Donasi $donasi,
        float $jumlah,
        ?string $tanggal = null
    ): void {
        $jamaah->donasi()->attach($donasi->id_donasi, [
            'besar_donasi'   => $jumlah,
            'tanggal_donasi' => $tanggal ?? now()->toDateString(),
        ]);
    }
}
