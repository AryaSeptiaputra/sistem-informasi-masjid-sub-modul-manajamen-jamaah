@extends('layouts.dashboard')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">

    <h2 class="text-xl font-bold mb-4">Riwayat Donasi</h2>

    @if($riwayat_donasi->count())
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b bg-gray-50">
                    <th class="p-3 font-semibold">Nama Donasi</th>
                    <th class="p-3 font-semibold">Jumlah</th>
                    <th class="p-3 font-semibold">Tanggal Donasi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($riwayat_donasi as $donasi)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3">{{ $donasi->nama_donasi ?? 'Donasi' }}</td>
                        <td class="p-3">Rp {{ number_format($donasi->pivot->besar_donasi, 0, ',', '.') }}</td>
                        <td class="p-3">{{ $donasi->pivot->tanggal_donasi }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-gray-500 text-sm">Belum ada riwayat donasi.</p>
    @endif

</div>
@endsection
