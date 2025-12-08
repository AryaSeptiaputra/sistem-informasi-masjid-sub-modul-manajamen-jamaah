<?php

namespace App\Http\Controllers;

use App\Models\Jamaah;
use App\Models\Kategori;
use App\Services\KategoriService;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function __construct(
        private KategoriService $service
    ) {}

    public function index()
    {
        return response()->json($this->service->getAll());
    }

    public function show(int $id)
    {
        $kategori = $this->service->getById($id);

        if (! $kategori) {
            return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
        }

        return response()->json($kategori);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi'     => 'nullable|string',
        ]);

        $kategori = $this->service->create($data);

        return response()->json($kategori, 201);
    }

    public function update(Request $request, int $id)
    {
        $kategori = $this->service->getById($id);

        if (! $kategori) {
            return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
        }

        $data = $request->validate([
            'nama_kategori' => 'sometimes|string|max:255',
            'deskripsi'     => 'nullable|string',
        ]);

        $updated = $this->service->update($kategori, $data);

        return response()->json($updated);
    }

    public function destroy(int $id)
    {
        $kategori = $this->service->getById($id);

        if (! $kategori) {
            return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
        }

        $this->service->delete($kategori);

        return response()->json(null, 204);
    }

    // Ambil semua jamaah di kategori ini
    public function listJamaah(int $id)
    {
        $kategori = $this->service->getById($id);

        if (! $kategori) {
            return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
        }

        return response()->json($this->service->getJamaah($kategori));
    }

    // Tambah jamaah ke kategori
    public function tambahJamaah(Request $request, int $id)
    {
        $kategori = $this->service->getById($id);
        if (! $kategori) {
            return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
        }

        $data = $request->validate([
            'id_jamaah' => 'required|integer|exists:jamaah,id_jamaah',
            'periode'   => 'nullable|string',
        ]);

        $jamaah = Jamaah::findOrFail($data['id_jamaah']);

        $this->service->tambahJamaah($kategori, $jamaah, $data['periode'] ?? null);

        return response()->json(['message' => 'Jamaah ditambahkan ke kategori']);
    }
}
