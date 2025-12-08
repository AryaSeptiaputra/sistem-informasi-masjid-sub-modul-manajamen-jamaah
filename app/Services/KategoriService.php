<?php

namespace App\Services;

use App\Models\Kategori;
use App\Models\Jamaah;
use Illuminate\Database\Eloquent\Collection;

class KategoriService
{
    public function getAll(): Collection
    {
        return Kategori::all();
    }

    public function getById(int $id): ?Kategori
    {
        return Kategori::find($id);
    }

    public function create(array $data): Kategori
    {
        return Kategori::create($data);
    }

    public function update(Kategori $kategori, array $data): Kategori
    {
        $kategori->update($data);
        return $kategori;
    }

    public function delete(Kategori $kategori): void
    {
        $kategori->delete();
    }

    /**
     * Ambil semua jamaah dalam satu kategori
     */
    public function getJamaah(Kategori $kategori): Collection
    {
        return $kategori->jamaah()->get();
    }

    /**
     * Tambah jamaah ke kategori (tanpa menghapus kategori lain)
     */
    public function tambahJamaah(Kategori $kategori, Jamaah $jamaah, ?string $periode = null): void
    {
        $kategori->jamaah()->attach($jamaah->id_jamaah, [
            'status_aktif' => true,
            'periode'      => $periode,
        ]);
    }

    /**
     * Nonaktifkan kategori untuk seorang jamaah
     */
    public function nonAktifkanUntukJamaah(Kategori $kategori, Jamaah $jamaah): void
    {
        $kategori->jamaah()->updateExistingPivot($jamaah->id_jamaah, [
            'status_aktif' => false,
        ]);
    }
}
