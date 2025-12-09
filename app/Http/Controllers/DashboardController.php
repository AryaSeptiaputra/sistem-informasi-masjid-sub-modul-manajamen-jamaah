<?php

namespace App\Http\Controllers;

use App\Models\Jamaah;

class DashboardController extends Controller
{
    public function index()
    {
        $jamaah = Jamaah::find(session('jamaah_id'));

        return view('dashboard', [
            'riwayat_donasi'   => $jamaah->donasi ?? [],
            'riwayat_kegiatan' => $jamaah->kegiatan ?? [],
        ]);
    }

    public function riwayatDonasi()
    {
        $jamaah = Jamaah::find(session('jamaah_id'));

        return view('riwayat.donasi', [
            'riwayat_donasi' => $jamaah->donasi ?? []
        ]);
    }

    public function riwayatKegiatan()
    {
        $jamaah = Jamaah::find(session('jamaah_id'));

        return view('riwayat.kegiatan', [
            'riwayat_kegiatan' => $jamaah->kegiatan ?? []
        ]);
    }
}
