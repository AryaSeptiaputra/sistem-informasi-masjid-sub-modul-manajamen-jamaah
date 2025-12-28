@extends('layouts.app-bootstrap')

@section('title', 'Manajemen Donasi')

@section('content')
<div class="container-fluid"
    x-data="{
        tab: 'master',
        openModal: false,
        editMode: false,
        formAction: '',
        formData: { nama:'', tgl:'', tglSelesai:'', desc:'' },
        searchProgram: '',
        searchTransaksi: '',
        filterMin: '',
        filterMax: ''
    }"
>
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Program Donasi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $masterDonasi->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-hand-holding-heart fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Sedang Berjalan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $masterDonasi->filter(fn($d) => !$d->tanggal_selesai || !$d->tanggal_selesai->isPast())->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-spinner fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Selesai</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $masterDonasi->filter(fn($d) => $d->tanggal_selesai && $d->tanggal_selesai->isPast())->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Donasi Masuk</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($riwayatTransaksi->sum('besar_donasi'), 0, ',', '.') }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <ul class="nav nav-pills mb-3">
        <li class="nav-item"><button class="nav-link" :class="tab==='master' ? 'active' : ''" @click="tab='master'">Program Donasi</button></li>
        <li class="nav-item"><button class="nav-link" :class="tab==='riwayat' ? 'active' : ''" @click="tab='riwayat'">Riwayat Transaksi</button></li>
    </ul>

    <div x-show="tab==='master'" x-transition>
        <div class="card shadow-sm mb-3">
            <div class="card-body d-flex flex-column flex-md-row gap-3 align-items-md-center justify-content-between toolbar-control">
                <div>
                    <h3 class="h5 mb-1">Daftar Program</h3>
                    <small class="text-muted">Kelola program donasi masjid yang tersedia.</small>
                </div>
                <div class="d-flex flex-column flex-sm-row gap-3 w-100 w-md-auto">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search text-muted"></i></span>
                        <input x-model="searchProgram" type="text" class="form-control" placeholder="Cari program donasi...">
                    </div>
                    <button class="btn btn-success" @click="openModal=true; editMode=false; formAction='{{ route('donasi.store') }}'; formData={ nama:'', tgl:'', tglSelesai:'', desc:'' }">
                        <i class="fas fa-plus me-1"></i>Buat Program
                    </button>
                </div>
            </div>
        </div>

        <div class="row g-5 card-grid-container" style="max-height:65vh; overflow-y:auto;">
            @foreach($masterDonasi as $d)
            <div class="col-12 col-md-6 col-lg-4 col-xl-3" x-show="('{{ $d->nama_donasi }} {{ $d->deskripsi }}'.toLowerCase().includes(searchProgram.toLowerCase()))" x-transition>
                <div class="card h-100 shadow-sm">
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="rounded-3 bg-success-subtle text-success d-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                                <i class="fas fa-hand-holding-heart"></i>
                            </div>
                            <span class="badge {{ ($d->tanggal_selesai && $d->tanggal_selesai->isPast()) ? 'text-bg-secondary' : 'text-bg-primary' }} text-uppercase fw-semibold">
                                {{ ($d->tanggal_selesai && $d->tanggal_selesai->isPast()) ? 'Selesai' : 'Berjalan' }}
                            </span>
                        </div>
                        <h5 class="card-title">{{ $d->nama_donasi }}</h5>
                        <p class="card-text small text-muted flex-grow-1">{{ $d->deskripsi ?? 'Tidak ada deskripsi untuk program ini.' }}</p>
                        <div class="mb-3">
                            <div class="small text-primary"><i class="far fa-calendar me-1"></i>Mulai: {{ $d->tanggal_mulai ? $d->tanggal_mulai->format('d M Y') : '-' }}</div>
                            <div class="small text-muted"><i class="far fa-flag me-1"></i>Selesai: {{ $d->tanggal_selesai ? $d->tanggal_selesai->format('d M Y') : '—' }}</div>
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <button class="btn btn-outline-primary btn-sm" @click="openModal=true; editMode=true; formAction='/donasi/{{ $d->id_donasi }}'; formData={ nama:'{{ $d->nama_donasi }}', tgl:'{{ $d->tanggal_mulai?->format('Y-m-d') }}', tglSelesai:'{{ $d->tanggal_selesai?->format('Y-m-d') }}', desc:'{{ $d->deskripsi }}' }"><i class="fas fa-edit"></i></button>
                            <form action="{{ route('donasi.destroy', $d->id_donasi) }}" method="POST" onsubmit="return confirm('Hapus program ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div x-show="tab==='riwayat'" x-transition>
        <div class="card shadow-sm mb-3">
            <div class="card-body d-flex flex-column flex-xl-row gap-3 align-items-xl-center justify-content-between toolbar-control">
                <div>
                    <h3 class="h5 mb-1">Riwayat Transaksi</h3>
                    <small class="text-muted">Monitoring seluruh donasi masuk.</small>
                </div>
                <div class="d-flex flex-column flex-sm-row gap-3 w-100 w-xl-auto">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search text-muted"></i></span>
                        <input x-model="searchTransaksi" type="text" class="form-control" placeholder="Cari jamaah / program...">
                    </div>
                    <div class="d-flex gap-2 align-items-center">
                        <div class="input-group" style="min-width: 200px;">
                            <span class="input-group-text" style="font-size: 0.85rem;">Min</span>
                            <input type="number" x-model="filterMin" class="form-control" placeholder="0" style="font-size: 0.85rem;">
                        </div>
                        <span class="text-muted fw-bold">-</span>
                        <div class="input-group" style="min-width: 200px;">
                            <span class="input-group-text" style="font-size: 0.85rem;">Max</span>
                            <input type="number" x-model="filterMax" class="form-control" placeholder="999999999" style="font-size: 0.85rem;">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="table-responsive" style="max-height:65vh; overflow-y:auto;">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Jamaah</th>
                            <th>Program</th>
                            <th>Tanggal</th>
                            <th class="text-end">Nominal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($riwayatTransaksi as $r)
                        <tr x-show="('{{ $r->jamaah->nama_lengkap ?? '' }} {{ $r->donasi->nama_donasi ?? '' }}'.toLowerCase().includes(searchTransaksi.toLowerCase())) && (filterMin === '' || {{ $r->besar_donasi }} >= filterMin) && (filterMax === '' || {{ $r->besar_donasi }} <= filterMax)">
                            <td>
                                <div class="fw-semibold">{{ $r->jamaah->nama_lengkap ?? 'Hamba Allah' }}</div>
                                <small class="text-muted">{{ $r->jamaah->username ?? '-' }}</small>
                            </td>
                            <td><span class="badge text-bg-info">{{ $r->donasi->nama_donasi ?? 'Donasi Umum' }}</span></td>
                            <td class="text-muted small">{{ $r->tanggal_donasi?->format('d M Y') ?? '-' }}</td>
                            <td class="text-end fw-bold text-success">Rp {{ number_format($r->besar_donasi, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" style="display:none;" x-cloak x-show="openModal" @keydown.escape.window="openModal=false">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" x-text="editMode ? 'Edit Program Donasi' : 'Buat Program Baru'"></h5>
                    <button type="button" class="btn-close" @click="openModal=false"></button>
                </div>
                <div class="modal-body">
                    <form :action="formAction" method="POST" id="programForm" class="row g-3">
                        @csrf
                        <input type="hidden" name="_method" :value="editMode ? 'PUT' : 'POST'">
                        <div class="col-12">
                            <label class="form-label">Nama Program</label>
                            <input type="text" name="nama_donasi" x-model="formData.nama" class="form-control" placeholder="Contoh: Renovasi Tempat Wudhu">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai" x-model="formData.tgl" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Selesai</label>
                            <input type="date" name="tanggal_selesai" x-model="formData.tglSelesai" class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Deskripsi Singkat</label>
                            <textarea name="deskripsi" x-model="formData.desc" rows="4" class="form-control" placeholder="Jelaskan tujuan dan detail program donasi ini..."></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="openModal=false">Batal</button>
                    <button type="submit" form="programForm" class="btn btn-success">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection