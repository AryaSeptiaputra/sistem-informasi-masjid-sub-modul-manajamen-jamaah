@extends('layouts.app-bootstrap')

@section('title', 'Kegiatan Saya')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="mb-4">
        <h1 class="h3 fw-bold text-dark">Kegiatan Saya</h1>
        <p class="text-muted mb-0">Kelola dan pantau semua kegiatan yang Anda ikuti</p>
    </div>

    <!-- Stat Cards -->
    <div class="row g-4 mb-5">
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);">
                <div class="card-body text-white">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <p class="text-white-50 text-uppercase fw-semibold small mb-2">Total Kegiatan</p>
                            <h3 class="fw-bold mb-0">{{ $kegiatan->count() }}</h3>
                        </div>
                        <div style="width: 48px; height: 48px; border-radius: 0.75rem; background-color: rgba(255,255,255,0.2); display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-calendar text-white fa-lg"></i>
                        </div>
                    </div>
                    <p class="text-white-75 small mb-0">Kegiatan yang Anda ikuti</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                <div class="card-body text-white">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <p class="text-white-50 text-uppercase fw-semibold small mb-2">Akan Datang</p>
                            <h3 class="fw-bold mb-0">{{ $kegiatan->where('status_kegiatan', 'aktif')->count() }}</h3>
                        </div>
                        <div style="width: 48px; height: 48px; border-radius: 0.75rem; background-color: rgba(255,255,255,0.2); display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-clock text-white fa-lg"></i>
                        </div>
                    </div>
                    <p class="text-white-75 small mb-0">Kegiatan mendatang</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%);">
                <div class="card-body text-white">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <p class="text-white-50 text-uppercase fw-semibold small mb-2">Kehadiran</p>
                            <h3 class="fw-bold mb-0">{{ $kegiatan->where('pivot.status_kehadiran', 'hadir')->count() }}</h3>
                        </div>
                        <div style="width: 48px; height: 48px; border-radius: 0.75rem; background-color: rgba(255,255,255,0.2); display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-check-circle text-white fa-lg"></i>
                        </div>
                    </div>
                    <p class="text-white-75 small mb-0">Kegiatan yang dihadiri</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Toolbar -->
    <div class="row g-4 mb-5">
        <div class="col-12">
            <form action="{{ route('user.kegiatan') }}" method="GET">
                <div class="card border-0 shadow-sm">
                    <div class="card-body d-flex flex-column flex-xl-row gap-3 align-items-xl-center justify-content-between toolbar-control">
                        <div>
                            <h3 class="h5 mb-1">Daftar Kegiatan</h3>
                            <small class="text-muted">Total {{ $kegiatan->count() }} kegiatan yang Anda ikuti.</small>
                        </div>
                        <div class="d-flex flex-column flex-sm-row gap-3 w-100 w-xl-auto">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-search text-muted"></i></span>
                                <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Cari kegiatan atau lokasi...">
                            </div>
                            <select name="status" class="form-select">
                                <option value="">Semua Status</option>
                                <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Akan Datang</option>
                                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="batal" {{ request('status') == 'batal' ? 'selected' : '' }}>Dibatalkan</option>
                            </select>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-filter me-1"></i> Filter
                            </button>
                            @if(request()->has('q') || request()->has('status'))
                                <a href="{{ route('user.kegiatan') }}" class="btn btn-outline-secondary">Reset</a>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Activity List -->
    <div class="row g-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0">Daftar Kegiatan Saya</h5>
                <span class="badge bg-secondary-subtle text-secondary fw-semibold">{{ $kegiatan->count() }} Kegiatan</span>
            </div>

            @forelse($kegiatan as $k)
                @if($loop->first)
                <div class="row g-4" style="row-gap: 2.5rem;">
                @endif
                    <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                        <div class="card border-0 shadow-sm h-100" style="overflow: hidden;">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div style="width: 48px; height: 48px; border-radius: 0.75rem; background: linear-gradient(135deg, #3b82f6, #1d4ed8); display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-calendar text-white"></i>
                                    </div>
                                    @if($k->status_kegiatan == 'aktif')
                                        <span class="badge bg-success-subtle text-success fw-semibold small">Akan Datang</span>
                                    @elseif($k->status_kegiatan == 'selesai')
                                        <span class="badge bg-secondary-subtle text-secondary fw-semibold small">Selesai</span>
                                    @elseif($k->status_kegiatan == 'batal')
                                        <span class="badge bg-danger-subtle text-danger fw-semibold small">Dibatalkan</span>
                                    @endif
                                </div>
                                <h6 class="fw-bold text-dark mb-2">{{ $k->nama_kegiatan }}</h6>
                                <p class="text-muted small mb-3">{{ Str::limit($k->deskripsi ?? '', 60) }}</p>
                                
                                <div class="d-flex flex-column gap-2 mb-3">
                                    <div class="d-flex align-items-center text-muted small">
                                        <i class="fas fa-calendar-alt text-primary me-2" style="width: 16px;"></i>
                                        <span>{{ \Carbon\Carbon::parse($k->tanggal)->translatedFormat('d F Y') }}</span>
                                    </div>
                                    <div class="d-flex align-items-center text-muted small">
                                        <i class="fas fa-map-marker-alt text-primary me-2" style="width: 16px;"></i>
                                        <span>{{ $k->lokasi ?? 'Masjid Utama' }}</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                                    <span class="text-muted small">Kehadiran</span>
                                    @if($k->pivot->status_kehadiran == 'hadir')
                                        <span class="badge bg-success-subtle text-success fw-semibold small">Hadir</span>
                                    @elseif($k->pivot->status_kehadiran == 'izin')
                                        <span class="badge bg-warning-subtle text-warning fw-semibold small">Izin</span>
                                    @else
                                        <span class="badge bg-secondary-subtle text-secondary fw-semibold small">Belum Hadir</span>
                                    @endif
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
                                <i class="fas fa-calendar-times fa-3x text-muted mb-3 opacity-50"></i>
                                <h6 class="text-muted fw-semibold mb-1">Tidak ada kegiatan</h6>
                                <p class="text-muted small mb-0">Belum ada kegiatan yang sesuai dengan filter Anda.</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
</div>
@endsection