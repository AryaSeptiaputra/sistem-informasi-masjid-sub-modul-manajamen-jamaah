@extends('layouts.app-bootstrap')

@section('title', 'Profil Saya')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold text-dark mb-1">Profil Saya</h1>
            <p class="text-muted mb-0">Kelola informasi akun Anda</p>
        </div>
        <button type="button" id="edit-trigger" onclick="toggleEditMode()" class="btn btn-primary">
            <i class="fas fa-edit me-2"></i> Edit Profil
        </button>
    </div>

    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Profile Banner Card -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="position-relative" style="height: 180px; background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);">
                <div class="position-absolute" style="bottom: -60px; left: 32px;">
                    <div class="bg-white rounded-circle p-3 shadow" style="width: 120px; height: 120px;">
                        <div class="w-100 h-100 rounded-circle d-flex align-items-center justify-content-center text-white" style="background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);">
                            <i class="fas {{ $user->jenis_kelamin == 'L' ? 'fa-user' : 'fa-user' }} fa-3x"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body pt-5 mt-4">
                <div class="row align-items-start mb-4">
                    <div class="col-md-8">
                        <h2 class="h3 fw-bold mb-2">{{ $user->nama_lengkap }}</h2>
                        <p class="text-muted mb-2">
                            <i class="fas fa-at me-2"></i> {{ $user->username }}
                        </p>
                        <div class="d-flex flex-wrap gap-2">
                            @forelse($user->kategori as $kat)
                                <span class="badge bg-primary-subtle text-primary fw-semibold px-3 py-2">
                                    <i class="fas fa-tag me-1"></i> {{ $kat->nama_kategori }}
                                </span>
                            @empty
                                <span class="badge bg-secondary-subtle text-secondary fw-semibold px-3 py-2">
                                    <i class="fas fa-user me-1"></i> Jamaah Umum
                                </span>
                            @endforelse
                            @if($user->status_aktif)
                                <span class="badge bg-success-subtle text-success fw-semibold px-3 py-2">
                                    <i class="fas fa-check-circle me-1"></i> Aktif
                                </span>
                            @else
                                <span class="badge bg-danger-subtle text-danger fw-semibold px-3 py-2">
                                    <i class="fas fa-times-circle me-1"></i> Non Aktif
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4 text-md-end mt-3 mt-md-0">
                        <div class="text-muted small">
                            <i class="far fa-calendar-alt me-2"></i> Bergabung sejak
                            <div class="fw-bold text-dark mt-1">{{ $user->created_at ? \Carbon\Carbon::parse($user->created_at)->translatedFormat('d F Y') : '-' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Personal Information -->
        <div class="row g-4 mb-4">
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0 fw-bold">
                            <i class="fas fa-user-circle text-primary me-2"></i> Informasi Personal
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <label class="form-label text-uppercase small text-muted fw-semibold mb-2">Nama Lengkap</label>
                            <div class="view-mode form-control bg-light border-0">{{ $user->nama_lengkap }}</div>
                            <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $user->nama_lengkap) }}" class="edit-mode d-none form-control" placeholder="Masukkan nama lengkap">
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-uppercase small text-muted fw-semibold mb-2">Jenis Kelamin</label>
                            <div class="view-mode form-control bg-light border-0">
                                <i class="fas {{ $user->jenis_kelamin == 'L' ? 'fa-mars text-primary' : 'fa-venus text-danger' }} me-2"></i>
                                {{ $user->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                            </div>
                            <select name="jenis_kelamin" class="edit-mode d-none form-control">
                                <option value="L" {{ $user->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ $user->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>

                        <div class="mb-0">
                            <label class="form-label text-uppercase small text-muted fw-semibold mb-2">Tanggal Lahir</label>
                            <div class="view-mode form-control bg-light border-0">
                                <i class="far fa-calendar-alt text-primary me-2"></i> {{ optional($user->tanggal_lahir)->format('d F Y') ?? 'Belum diisi' }}
                            </div>
                            <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', optional($user->tanggal_lahir)->format('Y-m-d')) }}" class="edit-mode d-none form-control">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0 fw-bold">
                            <i class="fas fa-address-book text-success me-2"></i> Informasi Kontak
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <label class="form-label text-uppercase small text-muted fw-semibold mb-2">Nomor Handphone</label>
                            <div class="view-mode form-control bg-light border-0">
                                <i class="fas fa-phone text-primary me-2"></i> {{ $user->no_handphone ?? 'Belum diisi' }}
                            </div>
                            <input type="text" name="no_handphone" value="{{ old('no_handphone', $user->no_handphone) }}" class="edit-mode d-none form-control" placeholder="Contoh: 081234567890">
                        </div>

                        <div class="mb-0">
                            <label class="form-label text-uppercase small text-muted fw-semibold mb-2">Alamat Lengkap</label>
                            <div class="view-mode form-control bg-light border-0 d-flex align-items-flex-start gap-2" style="min-height: 120px;">
                                <i class="fas fa-map-marker-alt text-primary" style="flex-shrink: 0; margin-top: 0.25rem;"></i>
                                <span>{{ $user->alamat ?? 'Alamat belum diisi' }}</span>
                            </div>
                            <textarea name="alamat" rows="5" class="edit-mode d-none form-control" placeholder="Masukkan alamat lengkap Anda">{{ old('alamat', $user->alamat) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Security Settings -->
        <div class="card border-0 shadow-sm mb-4 edit-mode d-none">
            <div class="card-header bg-white border-0 py-3">
                <h5 class="mb-0 fw-bold">
                    <i class="fas fa-lock text-warning me-2"></i> Keamanan Akun
                </h5>
            </div>
            <div class="card-body">
                <div class="alert alert-info mb-4">
                    <i class="fas fa-info-circle me-2"></i> <strong>Catatan:</strong> Kosongkan field password jika tidak ingin mengubah password Anda.
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label text-uppercase small text-muted fw-semibold mb-2">Password Baru</label>
                        <div class="input-group">
                            <input type="password" name="password" id="password" placeholder="Masukkan password baru" autocomplete="new-password" class="form-control border-end-0">
                            <button type="button" onclick="togglePassword('password', 'eye-pass')" class="btn btn-outline-secondary border-start-0">
                                <i id="eye-pass-show" class="fas fa-eye"></i>
                                <i id="eye-pass-hide" class="fas fa-eye-slash d-none"></i>
                            </button>
                        </div>
                        <small class="text-muted">Minimal 6 karakter</small>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-uppercase small text-muted fw-semibold mb-2">Konfirmasi Password</label>
                        <div class="input-group">
                            <input type="password" name="password_confirmation" id="password_confirm" placeholder="Ulangi password baru" autocomplete="new-password" class="form-control border-end-0">
                            <button type="button" onclick="togglePassword('password_confirm', 'eye-conf')" class="btn btn-outline-secondary border-start-0">
                                <i id="eye-conf-show" class="fas fa-eye"></i>
                                <i id="eye-conf-hide" class="fas fa-eye-slash d-none"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div id="action-buttons" class="d-none">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-muted">
                            <i class="fas fa-info-circle me-2"></i> Pastikan data yang Anda masukkan sudah benar
                        </div>
                        <div class="d-flex gap-2">
                            <button type="button" onclick="toggleEditMode()" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-2"></i> Batal
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-check me-2"></i> Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    function toggleEditMode() {
        const viewElements = document.querySelectorAll('.view-mode');
        const editElements = document.querySelectorAll('.edit-mode');
        const btnEdit = document.getElementById('edit-trigger');
        const actionButtons = document.getElementById('action-buttons');

        viewElements.forEach(el => el.classList.toggle('d-none'));
        editElements.forEach(el => el.classList.toggle('d-none'));
        actionButtons.classList.toggle('d-none');
        btnEdit.classList.toggle('d-none');
    }

    function togglePassword(inputId, eyePrefix) {
        const input = document.getElementById(inputId);
        const hideIcon = document.getElementById(`${eyePrefix}-hide`);
        const showIcon = document.getElementById(`${eyePrefix}-show`);
        const isPassword = input.type === 'password';
        input.type = isPassword ? 'text' : 'password';
        hideIcon.classList.toggle('d-none', !isPassword);
        showIcon.classList.toggle('d-none', isPassword);
    }
</script>
@endsection