@extends('layouts.app-bootstrap')

@section('title', 'Beranda')

@section('content')
<div class="container-fluid">
    <!-- Welcome Banner -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);">
                <div class="card-body py-5 text-white">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <h2 class="h3 mb-2 fw-bold">Assalamu'alaikum, {{ $user->nama_lengkap }}</h2>
                            <p class="mb-3 text-white-75">Selamat datang di Sistem Informasi Masjid. Semoga Allah memudahkan segala urusan Anda hari ini.</p>
                            <div class="d-flex gap-3 flex-wrap">
                                <span class="badge bg-white bg-opacity-25 text-dark px-3 py-2">
                                    <i class="fas fa-user-check me-2"></i> Jamaah Aktif
                                </span>
                                <span class="badge bg-white bg-opacity-25 text-dark px-3 py-2">
                                    <i class="fas fa-calendar-check me-2"></i> {{ now()->translatedFormat('l, d F Y') }}
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-4 text-center mt-4 mt-lg-0">
                            <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-white bg-opacity-10 text-white" style="width: 120px; height: 120px;">
                                <i class="fas fa-mosque fa-4x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="row g-4 mb-4">
        <div class="col-md-6 col-lg-3">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <p class="text-muted text-uppercase small mb-1 fw-semibold">Total Donasi Saya</p>
                            <h3 class="h4 fw-bold mb-0">Rp {{ number_format($totalDonasiKu, 0, ',', '.') }}</h3>
                        </div>
                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-success-subtle text-success" style="width:48px; height:48px;">
                            <i class="fas fa-hand-holding-heart fa-lg"></i>
                        </div>
                    </div>
                    <a href="{{ route('user.donasi') }}" class="text-primary fw-semibold small">Lihat Detail &rarr;</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <p class="text-muted text-uppercase small mb-1 fw-semibold">Kegiatan Diikuti</p>
                            <h3 class="h4 fw-bold mb-0">{{ $kegiatanKu }} Acara</h3>
                        </div>
                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-info-subtle text-info" style="width:48px; height:48px;">
                            <i class="fas fa-calendar-alt fa-lg"></i>
                        </div>
                    </div>
                    <a href="{{ route('user.kegiatan') }}" class="text-primary fw-semibold small">Lihat Jadwal &rarr;</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <p class="text-muted text-uppercase small mb-1 fw-semibold">Kegiatan Mendatang</p>
                            <h3 class="h4 fw-bold mb-0">5 Acara</h3>
                        </div>
                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary-subtle text-primary" style="width:48px; height:48px;">
                            <i class="fas fa-clock fa-lg"></i>
                        </div>
                    </div>
                    <span class="text-muted small">Dalam 30 hari ke depan</span>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <p class="text-muted text-uppercase small mb-1 fw-semibold">Program Donasi</p>
                            <h3 class="h4 fw-bold mb-0">8 Aktif</h3>
                        </div>
                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-warning-subtle text-warning" style="width:48px; height:48px;">
                            <i class="fas fa-donate fa-lg"></i>
                        </div>
                    </div>
                    <span class="text-muted small">Dapat diikuti saat ini</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Kegiatan & Donasi -->
    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">Kegiatan Mendatang</h5>
                    <a href="{{ route('user.kegiatan') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item border-0 px-0 py-3">
                            <div class="d-flex gap-3">
                                <div class="d-flex flex-column align-items-center justify-content-center bg-primary-subtle text-primary rounded" style="width: 60px; height: 60px; flex-shrink: 0;">
                                    <span class="fw-bold" style="font-size: 1.25rem;">15</span>
                                    <span class="text-uppercase small" style="font-size: 0.7rem;">Jan</span>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="fw-bold mb-1">Kajian Rutin Ahad Pagi</h6>
                                    <p class="text-muted small mb-1"><i class="fas fa-map-marker-alt me-1"></i>Aula Masjid</p>
                                    <p class="text-muted small mb-0"><i class="fas fa-clock me-1"></i>07:00 - 09:00 WIB</p>
                                </div>
                                <span class="badge bg-success-subtle text-success align-self-start">Aktif</span>
                            </div>
                        </div>

                        <div class="list-group-item border-0 px-0 py-3">
                            <div class="d-flex gap-3">
                                <div class="d-flex flex-column align-items-center justify-content-center bg-primary-subtle text-primary rounded" style="width: 60px; height: 60px; flex-shrink: 0;">
                                    <span class="fw-bold" style="font-size: 1.25rem;">20</span>
                                    <span class="text-uppercase small" style="font-size: 0.7rem;">Jan</span>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="fw-bold mb-1">Bakti Sosial Ramadhan</h6>
                                    <p class="text-muted small mb-1"><i class="fas fa-map-marker-alt me-1"></i>Sekitar Masjid</p>
                                    <p class="text-muted small mb-0"><i class="fas fa-clock me-1"></i>08:00 - 12:00 WIB</p>
                                </div>
                                <span class="badge bg-success-subtle text-success align-self-start">Aktif</span>
                            </div>
                        </div>

                        <div class="list-group-item border-0 px-0 py-3">
                            <div class="d-flex gap-3">
                                <div class="d-flex flex-column align-items-center justify-content-center bg-primary-subtle text-primary rounded" style="width: 60px; height: 60px; flex-shrink: 0;">
                                    <span class="fw-bold" style="font-size: 1.25rem;">25</span>
                                    <span class="text-uppercase small" style="font-size: 0.7rem;">Jan</span>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="fw-bold mb-1">Pengajian Rutin Malam Jumat</h6>
                                    <p class="text-muted small mb-1"><i class="fas fa-map-marker-alt me-1"></i>Masjid Utama</p>
                                    <p class="text-muted small mb-0"><i class="fas fa-clock me-1"></i>19:30 - 21:00 WIB</p>
                                </div>
                                <span class="badge bg-success-subtle text-success align-self-start">Aktif</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">Program Donasi Aktif</h5>
                    <a href="{{ route('user.donasi') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item border-0 px-0 py-3">
                            <div class="d-flex gap-3">
                                <div class="d-inline-flex align-items-center justify-content-center rounded bg-success-subtle text-success" style="width: 48px; height: 48px; flex-shrink: 0;">
                                    <i class="fas fa-hands-helping fa-lg"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="fw-bold mb-1">Renovasi Ruang Wudhu</h6>
                                    <p class="text-muted small mb-2">Target: Rp 50.000.000</p>
                                    <div class="progress" style="height: 6px;">
                                        <div class="progress-bar bg-success" style="width: 65%"></div>
                                    </div>
                                    <p class="text-muted small mt-1 mb-0">Terkumpul: 65%</p>
                                </div>
                                <span class="badge bg-success-subtle text-success align-self-start">Berjalan</span>
                            </div>
                        </div>

                        <div class="list-group-item border-0 px-0 py-3">
                            <div class="d-flex gap-3">
                                <div class="d-inline-flex align-items-center justify-content-center rounded bg-success-subtle text-success" style="width: 48px; height: 48px; flex-shrink: 0;">
                                    <i class="fas fa-book-quran fa-lg"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="fw-bold mb-1">Wakaf Al-Quran</h6>
                                    <p class="text-muted small mb-2">Target: Rp 20.000.000</p>
                                    <div class="progress" style="height: 6px;">
                                        <div class="progress-bar bg-success" style="width: 42%"></div>
                                    </div>
                                    <p class="text-muted small mt-1 mb-0">Terkumpul: 42%</p>
                                </div>
                                <span class="badge bg-success-subtle text-success align-self-start">Berjalan</span>
                            </div>
                        </div>

                        <div class="list-group-item border-0 px-0 py-3">
                            <div class="d-flex gap-3">
                                <div class="d-inline-flex align-items-center justify-content-center rounded bg-success-subtle text-success" style="width: 48px; height: 48px; flex-shrink: 0;">
                                    <i class="fas fa-mosque fa-lg"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="fw-bold mb-1">Operasional Masjid</h6>
                                    <p class="text-muted small mb-2">Donasi Terbuka</p>
                                    <div class="progress" style="height: 6px;">
                                        <div class="progress-bar bg-success" style="width: 100%"></div>
                                    </div>
                                    <p class="text-muted small mt-1 mb-0">Aktif setiap saat</p>
                                </div>
                                <span class="badge bg-primary-subtle text-primary align-self-start">Rutin</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection