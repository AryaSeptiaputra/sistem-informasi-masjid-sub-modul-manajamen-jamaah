@extends('layouts.dashboard')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">

    <h2 class="text-xl font-bold mb-4">Riwayat Kegiatan</h2>

    @if($riwayat_kegiatan->count())
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b bg-gray-50">
                    <th class="p-3 font-semibold">Nama Kegiatan</th>
                    <th class="p-3 font-semibold">Status Kehadiran</th>
                    <th class="p-3 font-semibold">Tanggal Daftar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($riwayat_kegiatan as $kegiatan)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3">{{ $kegiatan->nama_kegiatan }}</td>
                        <td class="p-3 capitalize">
                            <span class="px-2 py-1 rounded text-white
                                {{ $kegiatan->pivot->status_kehadiran == 'hadir' ? 'bg-green-500' : 'bg-yellow-500' }}">
                                {{ $kegiatan->pivot->status_kehadiran }}
                            </span>
                        </td>
                        <td class="p-3">{{ $kegiatan->pivot->tanggal_daftar }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-gray-500 text-sm">Belum ada riwayat kegiatan.</p>
    @endif

</div>
@endsection
