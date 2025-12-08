<?php

namespace App\Http\Controllers;

use App\Models\Jamaah;
use App\Models\Kegiatan;
use App\Models\Donasi;
use App\Services\JamaahService;
use Illuminate\Http\Request;

class JamaahController extends Controller
{
    public function __construct(
        private JamaahService $service
    ) {}

    public function index()
    {
        return response()->json($this->service->getAll());
    }

    public function show(int $id)
    {
        $jamaah = $this->service->getById($id);

        if (! $jamaah) {
            return response()->json(['message' => 'Jamaah tidak ditemukan'], 404);
        }

        return response()->json($jamaah);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'username'          => 'required|string|max:255|unique:jamaah,username',
            'nama_lengkap'      => 'required|string|max:255',
            'kata_sandi'        => 'required|string|min:6',
            'tanggal_lahir'     => 'nullable|date',
            'jenis_kelamin'     => 'required|in:L,P',
            'alamat'            => 'nullable|string',
            'no_handphone'      => 'nullable|string|max:20',
            'tanggal_bergabung' => 'nullable|date',
            'status_aktif'      => 'boolean',
        ]);

        $jamaah = $this->service->create($data);

        return response()->json($jamaah, 201);
    }

    public function update(Request $request, int $id)
    {
        $jamaah = $this->service->getById($id);

        if (! $jamaah) {
            return response()->json(['message' => 'Jamaah tidak ditemukan'], 404);
        }

        $data = $request->validate([
            'username'          => 'sometimes|string|max:255|unique:jamaah,username,' . $id . ',id_jamaah',
            'nama_lengkap'      => 'sometimes|string|max:255',
            'kata_sandi'        => 'sometimes|string|min:6',
            'tanggal_lahir'     => 'nullable|date',
            'jenis_kelamin'     => 'sometimes|in:L,P',
            'alamat'            => 'nullable|string',
            'no_handphone'      => 'nullable|string|max:20',
            'tanggal_bergabung' => 'nullable|date',
            'status_aktif'      => 'boolean',
        ]);

        $updated = $this->service->update($jamaah, $data);

        return response()->json($updated);
    }

    public function destroy(int $id)
    {
        $jamaah = $this->service->getById($id);

        if (! $jamaah) {
            return response()->json(['message' => 'Jamaah tidak ditemukan'], 404);
        }

        $this->service->delete($jamaah);

        return response()->json(null, 204);
    }

    /*
     * ====== ENDPOINT RELASI TAMBAHAN ======
     */

    // Sinkronisasi kategori jamaah
    public function syncKategori(Request $request, int $id)
    {
        $jamaah = $this->service->getById($id);
        if (! $jamaah) {
            return response()->json(['message' => 'Jamaah tidak ditemukan'], 404);
        }

        $data = $request->validate([
            'kategori_ids' => 'required|array',
            'kategori_ids.*' => 'integer|exists:kategori,id_kategori',
            'periode' => 'nullable|string',
        ]);

        $this->service->syncKategori($jamaah, $data['kategori_ids'], $data['periode'] ?? null);

        return response()->json(['message' => 'Kategori jamaah diperbarui']);
    }

    // Daftar ke kegiatan
    public function daftarKegiatan(Request $request, int $id)
    {
        $jamaah = $this->service->getById($id);
        if (! $jamaah) {
            return response()->json(['message' => 'Jamaah tidak ditemukan'], 404);
        }

        $data = $request->validate([
            'id_kegiatan'   => 'required|integer|exists:kegiatan,id_kegiatan',
            'tanggal_daftar'=> 'nullable|date',
        ]);

        $kegiatan = Kegiatan::findOrFail($data['id_kegiatan']);

        $this->service->daftarKegiatan($jamaah, $kegiatan, $data['tanggal_daftar'] ?? null);

        return response()->json(['message' => 'Jamaah didaftarkan ke kegiatan']);
    }

    // Ubah status kehadiran di kegiatan
    public function updateKehadiran(Request $request, int $id)
    {
        $jamaah = $this->service->getById($id);
        if (! $jamaah) {
            return response()->json(['message' => 'Jamaah tidak ditemukan'], 404);
        }

        $data = $request->validate([
            'id_kegiatan' => 'required|integer|exists:kegiatan,id_kegiatan',
            'status'      => 'required|string',
        ]);

        $kegiatan = Kegiatan::findOrFail($data['id_kegiatan']);

        $this->service->updateKehadiran($jamaah, $kegiatan, $data['status']);

        return response()->json(['message' => 'Status kehadiran diperbarui']);
    }

    // Catat donasi jamaah
    public function catatDonasi(Request $request, int $id)
    {
        $jamaah = $this->service->getById($id);
        if (! $jamaah) {
            return response()->json(['message' => 'Jamaah tidak ditemukan'], 404);
        }

        $data = $request->validate([
            'id_donasi' => 'required|integer|exists:donasi,id_donasi',
            'jumlah'    => 'required|numeric|min:0',
            'tanggal'   => 'nullable|date',
        ]);

        $donasi = Donasi::findOrFail($data['id_donasi']);

        $this->service->catatDonasi(
            $jamaah,
            $donasi,
            $data['jumlah'],
            $data['tanggal'] ?? null
        );

        return response()->json(['message' => 'Donasi tercatat']);
    }
}
