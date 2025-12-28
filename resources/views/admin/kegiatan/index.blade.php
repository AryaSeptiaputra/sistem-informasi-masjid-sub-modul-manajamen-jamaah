@extends('layouts.app-bootstrap')

@section('title', 'Manajemen Kegiatan')

@section('content')
<div class="container-fluid"
    x-data="{
        tab: 'acara',
        openModal: false,
        editMode: false,
        formAction: '',
        formData: { nama:'', tgl:'', lok:'', status:'aktif', desc:'' },
        searchAcara: '',
        filterStatusAcara: '',
        searchPeserta: '',
        filterHadir: ''
    }"
>
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Kegiatan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $masterKegiatan->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
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
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Kegiatan Aktif</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $masterKegiatan->where('status_kegiatan', 'aktif')->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-play-circle fa-2x text-gray-300"></i>
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
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $masterKegiatan->where('status_kegiatan', 'selesai')->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Dibatalkan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $masterKegiatan->where('status_kegiatan', 'batal')->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-times-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <ul class="nav nav-pills mb-3">
        <li class="nav-item"><button class="nav-link" :class="tab==='acara' ? 'active' : ''" @click="tab='acara'">Jadwal Kegiatan</button></li>
        <li class="nav-item"><button class="nav-link" :class="tab==='peserta' ? 'active' : ''" @click="tab='peserta'">Data Presensi</button></li>
    </ul>

    <div x-show="tab==='acara'" x-transition>
        <div class="card shadow-sm mb-3">
            <div class="card-body d-flex flex-column flex-xl-row gap-3 align-items-xl-center justify-content-between toolbar-control">
                <div>
                    <h3 class="h5 mb-1">Daftar Kegiatan</h3>
                    <small class="text-muted">Kelola agenda dan acara masjid.</small>
                </div>
                <div class="d-flex flex-column flex-sm-row gap-3 w-100 w-xl-auto">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search text-muted"></i></span>
                        <input x-model="searchAcara" type="text" class="form-control" placeholder="Cari kegiatan / lokasi...">
                    </div>
                    <select x-model="filterStatusAcara" class="form-select w-auto">
                        <option value="">Semua Status</option>
                        <option value="aktif">Aktif</option>
                        <option value="selesai">Selesai</option>
                        <option value="batal">Batal</option>
                    </select>
                    <button class="btn btn-primary" @click="openModal=true; editMode=false; formAction='{{ route('kegiatan.store') }}'; formData={ nama:'', tgl:'', lok:'', status:'aktif', desc:'' }">
                        <i class="fas fa-plus me-1"></i>Buat Acara
                    </button>
                </div>
            </div>
        </div>

        <div class="row g-5 card-grid-container" style="max-height:65vh; overflow-y:auto;">
            @foreach($masterKegiatan as $k)
            <div class="col-12 col-md-6 col-lg-4 col-xl-3" x-show="('{{ $k->nama_kegiatan }} {{ $k->lokasi }}'.toLowerCase().includes(searchAcara.toLowerCase())) && (filterStatusAcara === '' || filterStatusAcara === '{{ $k->status_kegiatan }}')" x-transition>
                <div class="card h-100 shadow-sm">
                    <div class="card-body d-flex flex-column">
                        <!-- Header: Icon & Badge -->
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="rounded-3 bg-primary-subtle text-primary d-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                                <i class="fas fa-calendar"></i>
                            </div>
                            <span class="badge text-uppercase fw-semibold {{ $k->status_kegiatan==='aktif' ? 'text-bg-success' : ($k->status_kegiatan==='selesai' ? 'text-bg-secondary' : 'text-bg-danger') }}">
                                {{ $k->status_kegiatan }}
                            </span>
                        </div>

                        <!-- Title -->
                        <h5 class="card-title">{{ $k->nama_kegiatan }}</h5>

                        <!-- Description -->
                        <p class="card-text small text-muted flex-grow-1">{{ $k->deskripsi ?? 'Belum ada deskripsi untuk kegiatan ini.' }}</p>

                        <!-- Details -->
                        <div class="mb-3">
                            <div class="small text-primary"><i class="far fa-calendar me-1"></i>Tanggal: {{ $k->tanggal ? $k->tanggal->format('d M Y') : '-' }}</div>
                            <div class="small text-muted"><i class="fas fa-map-marker-alt me-1"></i>{{ $k->lokasi ?? 'Lokasi belum diatur' }}</div>
                        </div>

                        <!-- Actions -->
                        <div class="d-flex justify-content-end gap-2">
                            <button class="btn btn-outline-primary btn-sm" @click="openModal=true; editMode=true; formAction='/kegiatan/{{ $k->id_kegiatan }}'; formData={ nama:'{{ $k->nama_kegiatan }}', tgl:'{{ $k->tanggal?->format('Y-m-d') }}', lok:'{{ $k->lokasi }}', status:'{{ $k->status_kegiatan }}', desc:'{{ $k->deskripsi }}' }"><i class="fas fa-edit"></i></button>
                            <form action="{{ route('kegiatan.destroy', $k->id_kegiatan) }}" method="POST" onsubmit="return confirm('Hapus kegiatan ini?')" class="m-0">
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

    <div x-show="tab==='peserta'" x-transition>
        <div class="card shadow-sm mb-3">
            <div class="card-body d-flex flex-column flex-md-row gap-3 align-items-md-center justify-content-between toolbar-control">
                <div>
                    <h3 class="h5 mb-1">Data Presensi</h3>
                    <small class="text-muted">Daftar kehadiran jamaah pada setiap kegiatan.</small>
                </div>
                <div class="d-flex flex-column flex-sm-row gap-3 w-100 w-md-auto">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search text-muted"></i></span>
                        <input x-model="searchPeserta" type="text" class="form-control" placeholder="Cari jamaah / kegiatan...">
                    </div>
                    <select x-model="filterHadir" class="form-select w-auto">
                        <option value="">Semua Status</option>
                        <option value="hadir">Hadir</option>
                        <option value="izin">Izin</option>
                        <option value="belum">Belum</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="table-responsive" style="max-height:65vh; overflow-y:auto;">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Jamaah</th>
                            <th>Kegiatan</th>
                            <th>Tanggal Daftar</th>
                            <th class="text-center">Status Kehadiran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($peserta as $p)
                        <tr x-show="('{{ $p->jamaah->nama_lengkap }} {{ $p->kegiatan->nama_kegiatan }}'.toLowerCase().includes(searchPeserta.toLowerCase())) && (filterHadir === '' || filterHadir === '{{ $p->status_kehadiran }}')">
                            <td>
                                <div class="fw-semibold">{{ $p->jamaah->nama_lengkap }}</div>
                                <small class="text-muted">@ {{ $p->jamaah->username }}</small>
                            </td>
                            <td><span class="badge text-bg-info">{{ $p->kegiatan->nama_kegiatan }}</span></td>
                            <td class="text-muted small">{{ $p->tanggal_daftar ? \Carbon\Carbon::parse($p->tanggal_daftar)->translatedFormat('d M Y') : '-' }}</td>
                            <td class="text-center">
                                <span class="badge {{ $p->status_kehadiran==='hadir' ? 'text-bg-success' : ($p->status_kehadiran==='izin' ? 'text-bg-warning' : 'text-bg-secondary') }}">{{ $p->status_kehadiran }}</span>
                            </td>
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
                    <h5 class="modal-title" x-text="editMode ? 'Edit Kegiatan' : 'Buat Kegiatan Baru'"></h5>
                    <button type="button" class="btn-close" @click="openModal=false"></button>
                </div>
                <div class="modal-body">
                    <form :action="formAction" method="POST" id="formKegiatan" class="row g-3">
                        @csrf
                        <input type="hidden" name="_method" :value="editMode ? 'PUT' : 'POST'">
                        <div class="col-12">
                            <label class="form-label">Nama Kegiatan</label>
                            <input type="text" name="nama_kegiatan" x-model="formData.nama" required class="form-control" placeholder="Contoh: Pengajian Bulanan">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tanggal</label>
                            <input type="date" name="tanggal" x-model="formData.tgl" required class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select name="status_kegiatan" x-model="formData.status" class="form-select">
                                <option value="aktif">Aktif</option>
                                <option value="selesai">Selesai</option>
                                <option value="batal">Batal</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Lokasi</label>
                            <input type="text" name="lokasi" x-model="formData.lok" class="form-control" placeholder="Contoh: Masjid Utama">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" x-model="formData.desc" rows="4" class="form-control" placeholder="Tambahkan detail kegiatan..."></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="openModal=false">Batal</button>
                    <button type="submit" form="formKegiatan" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection