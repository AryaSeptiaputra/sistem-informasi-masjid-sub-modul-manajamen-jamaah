@extends('layouts.app-bootstrap')

@section('title', 'Dashboard')

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

<!-- Content Row - Stats -->
<div class="row">

    <!-- Total Jamaah Card -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Jamaah
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($stats['total_jamaah'] ?? 0) }}</div>
                        <div class="text-xs text-muted mt-1">Terdaftar dalam sistem</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Donasi Card -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total Infaq/Donasi
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            Rp {{ number_format(($stats['total_donasi'] ?? 0) / 1000000, 1, ',', '.') }} Jt
                        </div>
                        <div class="text-xs text-muted mt-1">Total pemasukan tercatat</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-hand-holding-usd fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kegiatan Aktif Card -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Kegiatan Aktif
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['kegiatan_aktif'] ?? 0 }}</div>
                        <div class="text-xs text-muted mt-1">Acara bulan ini</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar-alt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Quick Access -->
<div class="card shadow mb-4 bg-gradient-dark text-white">
    <div class="card-body">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h5 class="font-weight-bold mb-1">Akses Cepat Admin</h5>
                <p class="mb-0 small">Kelola data masjid dengan cepat.</p>
            </div>
            <div class="col-md-4 text-md-right mt-3 mt-md-0">
                <a href="{{ route('jamaah.create') }}" class="btn btn-light btn-sm mr-2">
                    <i class="fas fa-plus"></i> Jamaah
                </a>
                <a href="{{ route('donasi.index') }}" class="btn btn-success btn-sm">
                    <i class="fas fa-plus"></i> Program Donasi
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->
<div class="row">

    <!-- Donasi Terbaru -->
    <div class="col-lg-8 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Donasi Masuk Terbaru</h6>
                <a href="{{ route('donasi.index') }}" class="btn btn-sm btn-primary">Lihat Semua</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Donatur</th>
                                <th>Program</th>
                                <th class="text-right">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($terbaruDonasi as $d)
                            <tr>
                                <td class="font-weight-bold">{{ $d->jamaah->nama_lengkap ?? 'Hamba Allah' }}</td>
                                <td class="text-muted">{{ Str::limit($d->donasi->nama_donasi, 20) }}</td>
                                <td class="text-right font-weight-bold text-success">
                                    Rp {{ number_format($d->besar_donasi, 0, ',', '.') }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted">
                                    Belum ada data terbaru.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Kegiatan Terdekat -->
    <div class="col-lg-4 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Kegiatan Terdekat</h6>
            </div>
            <div class="card-body">
                @forelse($kegiatanTerdekat as $k)
                <div class="d-flex align-items-start mb-3 pb-3 border-bottom">
                    <div class="text-center mr-3" style="min-width: 50px;">
                        <div class="badge badge-primary p-2">
                            <div class="small">{{ $k->tanggal?->format('M') }}</div>
                            <div class="h5 mb-0">{{ $k->tanggal?->format('d') }}</div>
                        </div>
                    </div>
                    <div>
                        <h6 class="font-weight-bold mb-1">{{ $k->nama_kegiatan }}</h6>
                        <p class="text-muted small mb-1">
                            <i class="fas fa-map-marker-alt"></i> {{ $k->lokasi }}
                        </p>
                        <span class="badge badge-secondary">{{ ucfirst($k->status_kegiatan) }}</span>
                    </div>
                </div>
                @empty
                <p class="text-center text-muted small">Tidak ada kegiatan terdekat.</p>
                @endforelse

                <a href="{{ route('kegiatan.index') }}" class="btn btn-block btn-outline-primary btn-sm mt-3">
                    Kelola Jadwal
                </a>
            </div>
        </div>
    </div>

</div>

@endsection
