<?php

namespace App\Services;

use App\Models\Donasi;
use App\Models\Jamaah;
use Illuminate\Database\Eloquent\Collection;

class DonasiService
{
    public function getAll(): Collection
    {
        return Donasi::all();
    }

    public function getById(int $id): ?Donasi
    {
        return Donasi::find($id);
    }

    public function create(array $data): Donasi
    {
        return Donasi::create($data);
    }

    public function update(Donasi $donasi, array $data): Donasi
    {
        $donasi->update($data);
        return $donasi;
    }

    public function delete(Donasi $donasi): void
    {
        $donasi->delete();
    }

    /* =========================
     *  LOGIC RELASI DONASI
     * ========================= */

    /**
     * Ambil semua jamaah yang pernah berdonasi di campaign ini
     */
    public function getJamaah(Donasi $donasi): Collection
    {
        return $donasi->jamaah()->get();
    }

    /**
     * Catat donasi dari jamaah tertentu
     */
    public function catatDonasi(
        Donasi $donasi,
        Jamaah $jamaah,
        float $jumlah,
        ?string $tanggal = null
    ): void {
        $donasi->jamaah()->attach($jamaah->id_jamaah, [
            'besar_donasi'   => $jumlah,
            'tanggal_donasi' => $tanggal ?? now()->toDateString(),
        ]);
    }
}
