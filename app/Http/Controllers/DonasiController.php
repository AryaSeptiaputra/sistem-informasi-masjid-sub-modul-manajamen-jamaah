<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use App\Models\Jamaah;
use App\Services\DonasiService;
use Illuminate\Http\Request;

class DonasiController extends Controller
{
    public function __construct(
        private DonasiService $service
    ) {}

    public function index()
    {
        return response()->json($this->service->getAll());
    }

    public function show(int $id)
    {
        $donasi = $this->service->getById($id);

        if (! $donasi) {
            return response()->json(['message' => 'Donasi tidak ditemukan'], 404);
        }

        return response()->json($donasi);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_donasi'    => 'required|string|max:255',
            'tanggal_mulai'  => 'required|date',
            'tanggal_selesai'=> 'nullable|date',
            'deskripsi'      => 'nullable|string',
        ]);

        $donasi = $this->service->create($data);

        return response()->json($donasi, 201);
    }

    public function update(Request $request, int $id)
    {
        $donasi = $this->service->getById($id);

        if (! $donasi) {
            return response()->json(['message' => 'Donasi tidak ditemukan'], 404);
        }

        $data = $request->validate([
            'nama_donasi'    => 'sometimes|string|max:255',
            'tanggal_mulai'  => 'sometimes|date',
            'tanggal_selesai'=> 'nullable|date',
            'deskripsi'      => 'nullable|string',
        ]);

        $updated = $this->service->update($donasi, $data);

        return response()->json($updated);
    }

    public function destroy(int $id)
    {
        $donasi = $this->service->getById($id);

        if (! $donasi) {
            return response()->json(['message' => 'Donasi tidak ditemukan'], 404);
        }

        $this->service->delete($donasi);

        return response()->json(null, 204);
    }

    // List jamaah yang pernah berdonasi
    public function jamaah(int $id)
    {
        $donasi = $this->service->getById($id);

        if (! $donasi) {
            return response()->json(['message' => 'Donasi tidak ditemukan'], 404);
        }

        return response()->json($this->service->getJamaah($donasi));
    }

    // Catat donasi dari seorang jamaah
    public function catatDonasi(Request $request, int $id)
    {
        $donasi = $this->service->getById($id);
        if (! $donasi) {
            return response()->json(['message' => 'Donasi tidak ditemukan'], 404);
        }

        $data = $request->validate([
            'id_jamaah' => 'required|integer|exists:jamaah,id_jamaah',
            'jumlah'    => 'required|numeric|min:0',
            'tanggal'   => 'nullable|date',
        ]);

        $jamaah = Jamaah::findOrFail($data['id_jamaah']);

        $this->service->catatDonasi(
            $donasi,
            $jamaah,
            $data['jumlah'],
            $data['tanggal'] ?? null
        );

        return response()->json(['message' => 'Donasi tercatat']);
    }
}
