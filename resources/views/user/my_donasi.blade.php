@extends('layouts.app-bootstrap')

@section('title', 'Riwayat Donasi Saya')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="mb-4">
        <h1 class="h3 fw-bold text-dark">Riwayat Donasi Saya</h1>
        <p class="text-muted mb-0">Kelola dan pantau semua donasi Anda di sini</p>
    </div>

    <!-- Stat Cards -->
    <div class="row g-4 mb-5">
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                <div class="card-body text-white">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <p class="text-white-50 text-uppercase fw-semibold small mb-2">Total Donasi</p>
                            <h3 class="fw-bold mb-0">Rp {{ number_format($riwayat->sum('besar_donasi'), 0, ',', '.') }}</h3>
                        </div>
                        <div style="width: 48px; height: 48px; border-radius: 0.75rem; background-color: rgba(255,255,255,0.2); display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-hand-holding-heart text-white fa-lg"></i>
                        </div>
                    </div>
                    <p class="text-white-75 small mb-0">Kontribusi Anda untuk kemakmuran masjid</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);">
                <div class="card-body text-white">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <p class="text-white-50 text-uppercase fw-semibold small mb-2">Jumlah Transaksi</p>
                            <h3 class="fw-bold mb-0">{{ $riwayat->count() }}</h3>
                        </div>
                        <div style="width: 48px; height: 48px; border-radius: 0.75rem; background-color: rgba(255,255,255,0.2); display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-receipt text-white fa-lg"></i>
                        </div>
                    </div>
                    <p class="text-white-75 small mb-0">Total transaksi donasi Anda</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                <div class="card-body text-white">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <p class="text-white-50 text-uppercase fw-semibold small mb-2">Rata-rata Donasi</p>
                            <h3 class="fw-bold mb-0">Rp {{ number_format($riwayat->count() > 0 ? $riwayat->sum('besar_donasi') / $riwayat->count() : 0, 0, ',', '.') }}</h3>
                        </div>
                        <div style="width: 48px; height: 48px; border-radius: 0.75rem; background-color: rgba(255,255,255,0.2); display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-chart-line text-white fa-lg"></i>
                        </div>
                    </div>
                    <p class="text-white-75 small mb-0">Rata-rata per transaksi</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Toolbar -->
    <div class="row g-4 mb-5">
        <div class="col-12">
            <form action="{{ route('user.donasi') }}" method="GET">
                <div class="card border-0 shadow-sm">
                    <div class="card-body d-flex flex-column flex-xl-row gap-3 align-items-xl-center justify-content-between toolbar-control">
                        <div>
                            <h3 class="h5 mb-1">Catatan Transaksi</h3>
                            <small class="text-muted">Total {{ $riwayat->count() }} transaksi donasi Anda.</small>
                        </div>
                        <div class="d-flex flex-column flex-sm-row gap-3 w-100 w-xl-auto">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-search text-muted"></i></span>
                                <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Cari program donasi...">
                            </div>
                            <div class="input-group" style="max-width: 180px;">
                                <span class="input-group-text"><i class="fas fa-calendar text-muted"></i></span>
                                <input type="date" name="start_date" value="{{ request('start_date') }}" class="form-control">
                            </div>
                            <div class="input-group" style="max-width: 180px;">
                                <span class="input-group-text"><i class="fas fa-calendar text-muted"></i></span>
                                <input type="date" name="end_date" value="{{ request('end_date') }}" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-filter me-1"></i> Filter
                            </button>
                            @if(request()->has('q') || request()->has('start_date') || request()->has('end_date'))
                                <a href="{{ route('user.donasi') }}" class="btn btn-outline-secondary">Reset</a>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Transaction List -->
    <div class="row g-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0">Daftar Transaksi Donasi</h5>
                <span class="badge bg-secondary-subtle text-secondary fw-semibold">{{ $riwayat->count() }} Transaksi</span>
            </div>

            @forelse($riwayat as $r)
                @if($loop->first)
                <div class="row g-4" style="row-gap: 2.5rem;">
                @endif
                    <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                        <div class="card border-0 shadow-sm h-100" style="overflow: hidden;">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div style="width: 48px; height: 48px; border-radius: 0.75rem; background: linear-gradient(135deg, #10b981, #059669); display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-hand-holding-heart text-white"></i>
                                    </div>
                                    <span class="badge bg-success-subtle text-success fw-semibold small">Tercatat</span>
                                </div>
                                <h6 class="fw-bold text-dark mb-2">{{ $r->donasi->nama_donasi ?? 'Donasi Umum' }}</h6>
                                <p class="text-muted small mb-3">{{ Str::limit($r->donasi->deskripsi ?? '', 60) }}</p>
                                
                                <div class="d-flex flex-column gap-2 mb-3">
                                    <div class="d-flex align-items-center text-muted small">
                                        <i class="fas fa-calendar text-primary me-2" style="width: 16px;"></i>
                                        <span>{{ \Carbon\Carbon::parse($r->tanggal_donasi)->translatedFormat('d F Y') }}</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                                    <span class="text-muted small">Total</span>
                                    <span class="fw-bold text-success">Rp {{ number_format($r->besar_donasi, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @if($loop->last)
                </div>
                @endif
            @empty
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body py-5">
                            <div class="d-flex flex-column align-items-center text-center">
                                <i class="fas fa-inbox fa-3x text-muted mb-3 opacity-50"></i>
                                <h6 class="text-muted fw-semibold mb-1">Tidak ada donasi</h6>
                                <p class="text-muted small mb-0">Belum ada transaksi donasi yang sesuai dengan filter Anda.</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection