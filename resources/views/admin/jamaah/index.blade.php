@extends('layouts.app-bootstrap')

@section('title', 'Manajemen Jamaah')

@section('content')
<div class="container-fluid"
    x-data="{
        tab: 'jamaah',
        openJamaahModal: false,
        openKategoriModal: false,
        editMode: false,
        formAction: '',
        formDataJamaah: { nama:'', username:'', password:'', hp:'', alamat:'', jk:'L', tglLahir:'', tglGabung:'', status:'1', kategori_ids: [] },
        formDataKategori: { nama:'', deskripsi:'' },
        searchJamaah: '',
        searchKategori: '',
        filterStatus: ''
    }"
>
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Jamaah</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($jamaah->count()) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
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
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jamaah Aktif</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jamaah->where('status_aktif', true)->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-check fa-2x text-gray-300"></i>
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
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Non Aktif</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jamaah->where('status_aktif', false)->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-times fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Kategori</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $allKategori->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-tags fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <ul class="nav nav-pills mb-3">
        <li class="nav-item">
            <button class="nav-link" :class="tab==='jamaah' ? 'active' : ''" @click="tab='jamaah'">Data Jamaah</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" :class="tab==='kategori' ? 'active' : ''" @click="tab='kategori'">Master Kategori</button>
        </li>
    </ul>

    <div x-show="tab==='jamaah'" x-transition>
        <div class="card shadow-sm mb-3">
            <div class="card-body d-flex flex-column flex-xl-row gap-3 align-items-xl-center justify-content-between toolbar-control">
                <div>
                    <h3 class="h5 mb-1">Data Jamaah</h3>
                    <small class="text-muted">Total {{ $jamaah->count() }} jamaah terdaftar di sistem.</small>
                </div>
                <div class="d-flex flex-column flex-sm-row gap-3 w-100 w-xl-auto">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search text-muted"></i></span>
                        <input x-model="searchJamaah" type="text" class="form-control" placeholder="Cari nama / username...">
                    </div>
                    <select x-model="filterStatus" class="form-select w-auto">
                        <option value="">Semua Status</option>
                        <option value="AKTIF">Aktif</option>
                        <option value="NON">Non Aktif</option>
                    </select>
                    <button class="btn btn-primary" @click="openJamaahModal=true; editMode=false; formAction='{{ route('jamaah.store') }}'; formDataJamaah={ nama:'', username:'', password:'', hp:'', alamat:'', jk:'L', tglLahir:'', tglGabung:'', status:'1', kategori_ids: [] }">
                        <i class="fas fa-user-plus me-1"></i> Tambah Jamaah
                    </button>
                </div>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="table-responsive" style="max-height:65vh; overflow-y:auto;">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Informasi Jamaah</th>
                            <th>Kategori</th>
                            <th>Kontak</th>
                            <th class="text-center">Status</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jamaah as $j)
                        <tr x-show="
                                ('{{ $j->nama_lengkap }} {{ $j->username }}'.toLowerCase().includes(searchJamaah.toLowerCase())) &&
                                (filterStatus === '' || (filterStatus === 'AKTIF' && {{ $j->status_aktif ? 'true':'false' }}) || (filterStatus === 'NON' && !{{ $j->status_aktif ? 'true':'false' }}))
                            ">
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="rounded-circle bg-primary-subtle text-primary fw-bold d-flex align-items-center justify-content-center" style="width:40px;height:40px;">
                                        {{ substr($j->nama_lengkap, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="fw-semibold">{{ $j->nama_lengkap }}</div>
                                        <small class="text-muted">@ {{ $j->username }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-wrap gap-1">
                                    @forelse($j->kategori as $kat)
                                        <span class="badge text-bg-light border">{{ $kat->nama_kategori }}</span>
                                    @empty
                                        <small class="text-muted fst-italic">- Tidak ada -</small>
                                    @endforelse
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column small text-muted">
                                    <span><i class="fas fa-phone me-1 text-secondary"></i>{{ $j->no_handphone ?? '-' }}</span>
                                    <span><i class="fas fa-map-marker-alt me-1 text-secondary"></i>{{ $j->alamat ?? 'Alamat kosong' }}</span>
                                    <span><i class="far fa-calendar me-1 text-secondary"></i>Lahir: {{ $j->tanggal_lahir ? $j->tanggal_lahir->format('d M Y') : '-' }}</span>
                                    <span><i class="far fa-clock me-1 text-secondary"></i>Bergabung: {{ $j->tanggal_bergabung ? $j->tanggal_bergabung->format('d M Y') : '-' }}</span>
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="badge {{ $j->status_aktif ? 'text-bg-success' : 'text-bg-danger' }}">
                                    {{ $j->status_aktif ? 'Aktif' : 'Non-Aktif' }}
                                </span>
                            </td>
                            <td class="text-end">
                                <div class="d-flex gap-2 justify-content-end">
                                    <button class="btn btn-outline-primary btn-sm"
                                        @click="openJamaahModal=true; editMode=true; formAction='/jamaah/{{ $j->id_jamaah }}'; formDataJamaah={ nama:'{{ $j->nama_lengkap }}', username:'{{ $j->username }}', password:'', hp:'{{ $j->no_handphone }}', alamat:'{{ $j->alamat }}', jk:'{{ $j->jenis_kelamin }}', tglLahir:'{{ $j->tanggal_lahir?->format('Y-m-d') }}', tglGabung:'{{ $j->tanggal_bergabung?->format('Y-m-d') }}', status:'{{ $j->status_aktif ? '1':'0' }}', kategori_ids: {{ $j->kategori->pluck('id_kategori') }} }">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('jamaah.destroy', $j->id_jamaah) }}" method="POST" onsubmit="return confirm('Hapus jamaah ini?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div x-show="tab==='kategori'" x-transition>
        <div class="card shadow-sm mb-3">
            <div class="card-body d-flex flex-column flex-md-row gap-3 align-items-md-center justify-content-between toolbar-control">
                <div>
                    <h3 class="h5 mb-1">Master Kategori</h3>
                    <small class="text-muted">Kelola label untuk mengelompokkan jamaah.</small>
                </div>
                <div class="d-flex gap-3 w-100 w-md-auto">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search text-muted"></i></span>
                        <input x-model="searchKategori" type="text" class="form-control" placeholder="Cari kategori...">
                    </div>
                    <button class="btn btn-purple text-white" style="background:#6f42c1; border-color:#6f42c1;"
                        @click="openKategoriModal=true; editMode=false; formAction='{{ route('kategori.store') }}'; formDataKategori={ nama:'', deskripsi:'' }">
                        <i class="fas fa-plus me-1"></i> Kategori Baru
                    </button>
                </div>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="table-responsive" style="max-height:65vh; overflow-y:auto;">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Kategori</th>
                            <th class="text-center">Jumlah Anggota</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kategoriList as $k)
                        <tr x-show="'{{ $k->nama_kategori }}'.toLowerCase().includes(searchKategori.toLowerCase())">
                            <td>
                                <div class="fw-semibold">{{ $k->nama_kategori }}</div>
                                @if($k->deskripsi)
                                    <small class="text-muted">{{ $k->deskripsi }}</small>
                                @endif
                            </td>
                            <td class="text-center"><span class="badge text-bg-secondary">{{ $k->jamaah_count }} Jamaah</span></td>
                            <td class="text-end">
                                <div class="d-flex gap-2 justify-content-end">
                                    <button class="btn btn-outline-primary btn-sm"
                                        @click="openKategoriModal=true; editMode=true; formAction='/kategori/{{ $k->id_kategori }}'; formDataKategori={ nama:'{{ $k->nama_kategori }}', deskripsi:'{{ $k->deskripsi }}' }"><i class="fas fa-edit"></i></button>
                                    <form action="{{ route('kategori.destroy', $k->id_kategori) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Modal Jamaah --}}
    <div class="modal fade" tabindex="-1" style="display:none;" x-cloak x-show="openJamaahModal" @keydown.escape.window="openJamaahModal=false">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" x-text="editMode ? 'Edit Data Jamaah' : 'Tambah Jamaah Baru'"></h5>
                    <button type="button" class="btn-close" @click="openJamaahModal=false"></button>
                </div>
                <div class="modal-body">
                    <form :action="formAction" method="POST" id="formJamaah" class="row g-3">
                        @csrf
                        <input type="hidden" name="_method" :value="editMode ? 'PUT' : 'POST'">

                        <div class="col-12">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" x-model="formDataJamaah.nama" required class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" x-model="formDataJamaah.username" required class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Password</label>
                            <input type="password" name="kata_sandi" x-model="formDataJamaah.password" :required="!editMode" class="form-control" placeholder="Minimal 6 karakter">
                            <small class="text-muted" x-show="editMode">Kosongkan jika tidak ingin mengganti password.</small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">No. Handphone</label>
                            <input type="text" name="no_handphone" x-model="formDataJamaah.hp" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin" x-model="formDataJamaah.jk" class="form-select">
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" x-model="formDataJamaah.tglLahir" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Bergabung</label>
                            <input type="date" name="tanggal_bergabung" x-model="formDataJamaah.tglGabung" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Status Aktif</label>
                            <select name="status_aktif" x-model="formDataJamaah.status" class="form-select">
                                <option value="1">Aktif</option>
                                <option value="0">Non Aktif</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Alamat Lengkap</label>
                            <textarea name="alamat" x-model="formDataJamaah.alamat" rows="2" class="form-control"></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Kategori Jamaah</label>
                            <div class="row g-2">
                                @foreach($allKategori as $kat)
                                    <div class="col-6 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="{{ $kat->id_kategori }}" name="kategori_ids[]" x-model="formDataJamaah.kategori_ids" id="kat{{ $kat->id_kategori }}">
                                            <label class="form-check-label" for="kat{{ $kat->id_kategori }}">{{ $kat->nama_kategori }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="openJamaahModal=false">Batal</button>
                    <button type="submit" form="formJamaah" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Kategori --}}
    <div class="modal fade" tabindex="-1" style="display:none;" x-cloak x-show="openKategoriModal" @keydown.escape.window="openKategoriModal=false">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" x-text="editMode ? 'Edit Kategori' : 'Tambah Kategori'"></h5>
                    <button type="button" class="btn-close" @click="openKategoriModal=false"></button>
                </div>
                <div class="modal-body">
                    <form :action="formAction" method="POST" id="formKategori" class="row g-3">
                        @csrf
                        <input type="hidden" name="_method" :value="editMode ? 'PUT' : 'POST'">
                        <div class="col-12">
                            <label class="form-label">Nama Kategori</label>
                            <input type="text" name="nama_kategori" x-model="formDataKategori.nama" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" x-model="formDataKategori.deskripsi" rows="3" class="form-control" placeholder="Opsional"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="openKategoriModal=false">Batal</button>
                    <button type="submit" form="formKategori" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection