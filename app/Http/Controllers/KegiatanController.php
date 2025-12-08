<?php

namespace App\Http\Controllers;

use App\Models\Jamaah;
use App\Models\Kegiatan;
use App\Services\KegiatanService;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function __construct(
        private KegiatanService $service
    ) {}

    public function index()
    {
        return response()->json($this->service->getAll());
    }

    public function show(int $id)
    {
        $kegiatan = $this->service->getById($id);

        if (! $kegiatan) {
            return response()->json(['message' => 'Kegiatan tidak ditemukan'], 404);
        }

        return response()->json($kegiatan);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_kategori'   => 'required|string|max:255',
            'tanggal'         => 'required|date',
            'lokasi'          => 'nullable|string',
            'status_kegiatan' => 'nullable|string',
            'deskripsi'       => 'nullable|string',
        ]);

        $kegiatan = $this->service->create($data);

        return response()->json($kegiatan, 201);
    }

    public function update(Request $request, int $id)
    {
        $kegiatan = $this->service->getById($id);

        if (! $kegiatan) {
            return response()->json(['message' => 'Kegiatan tidak ditemukan'], 404);
        }

        $data = $request->validate([
            'nama_kategori'   => 'sometimes|string|max:255',
            'tanggal'         => 'sometimes|date',
            'lokasi'          => 'nullable|string',
            'status_kegiatan' => 'nullable|string',
            'deskripsi'       => 'nullable|string',
        ]);

        $updated = $this->service->update($kegiatan, $data);

        return response()->json($updated);
    }

    public function destroy(int $id)
    {
        $kegiatan = $this->service->getById($id);

        if (! $kegiatan) {
            return response()->json(['message' => 'Kegiatan tidak ditemukan'], 404);
        }

        $this->service->delete($kegiatan);

        return response()->json(null, 204);
    }

    // List peserta kegiatan
    public function peserta(int $id)
    {
        $kegiatan = $this->service->getById($id);

        if (! $kegiatan) {
            return response()->json(['message' => 'Kegiatan tidak ditemukan'], 404);
        }

        return response()->json($this->service->getPeserta($kegiatan));
    }

    // Tambah peserta
    public function tambahPeserta(Request $request, int $id)
    {
        $kegiatan = $this->service->getById($id);
        if (! $kegiatan) {
            return response()->json(['message' => 'Kegiatan tidak ditemukan'], 404);
        }

        $data = $request->validate([
            'id_jamaah'      => 'required|integer|exists:jamaah,id_jamaah',
            'tanggal_daftar' => 'nullable|date',
        ]);

        $jamaah = Jamaah::findOrFail($data['id_jamaah']);

        $this->service->tambahPeserta(
            $kegiatan,
            $jamaah,
            $data['tanggal_daftar'] ?? null
        );

        return response()->json(['message' => 'Peserta ditambahkan']);
    }

    // Ubah status kehadiran
    public function ubahStatusKehadiran(Request $request, int $id)
    {
        $kegiatan = $this->service->getById($id);
        if (! $kegiatan) {
            return response()->json(['message' => 'Kegiatan tidak ditemukan'], 404);
        }

        $data = $request->validate([
            'id_jamaah' => 'required|integer|exists:jamaah,id_jamaah',
            'status'    => 'required|string',
        ]);

        $jamaah = Jamaah::findOrFail($data['id_jamaah']);

        $this->service->ubahStatusKehadiran(
            $kegiatan,
            $jamaah,
            $data['status']
        );

        return response()->json(['message' => 'Status kehadiran diperbarui']);
    }
}
