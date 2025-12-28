<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistem Informasi Masjid">
    <meta name="author" content="">
    <title>@yield('title', 'Dashboard Masjid')</title>

    <!-- Custom fonts -->
    <link href="{{ asset('sb-admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles -->
    <link href="{{ asset('sb-admin/sb-admin-2.min.css') }}" rel="stylesheet">
    
    @yield('styles')

    <!-- Minimal utility bridge to keep old Tailwind-markup views readable -->
    <style>
        /* Layout helpers */
        .flex { display: flex; }
        .flex-col { flex-direction: column; }
        .flex-1 { flex: 1 1 0%; }
        .flex-shrink-0 { flex-shrink: 0; }
        .items-center { align-items: center; }
        .items-start { align-items: flex-start; }
        .items-end { align-items: flex-end; }
        .justify-between { justify-content: space-between; }
        .justify-center { justify-content: center; }
        .gap-2 { gap: 0.5rem; }
        .gap-3 { gap: 0.75rem; }
        .gap-4 { gap: 1rem; }
        .gap-5 { gap: 1.25rem; }
        .gap-6 { gap: 1.5rem; }
        .gap-8 { gap: 2rem; }
        .space-y-4 > :not(:last-child) { margin-bottom: 1rem; }
        .space-y-6 > :not(:last-child) { margin-bottom: 1.5rem; }
        .space-y-10 > :not(:last-child) { margin-bottom: 2.5rem; }
        .overflow-hidden { overflow: hidden; }
        .overflow-y-auto { overflow-y: auto; }
        .relative { position: relative; }
        .absolute { position: absolute; }
        .sticky { position: sticky; }
        .top-0 { top: 0; }

        /* Spacing */
        .p-2 { padding: 0.5rem; }
        .p-3 { padding: 0.75rem; }
        .p-4 { padding: 1rem; }
        .p-5 { padding: 1.25rem; }
        .p-6 { padding: 1.5rem; }
        .p-8 { padding: 2rem; }
        .px-4 { padding-left: 1rem; padding-right: 1rem; }
        .px-5 { padding-left: 1.25rem; padding-right: 1.25rem; }
        .px-6 { padding-left: 1.5rem; padding-right: 1.5rem; }
        .px-8 { padding-left: 2rem; padding-right: 2rem; }
        .py-2 { padding-top: 0.5rem; padding-bottom: 0.5rem; }
        .py-2\.5 { padding-top: 0.625rem; padding-bottom: 0.625rem; }
        .py-3 { padding-top: 0.75rem; padding-bottom: 0.75rem; }
        .py-4 { padding-top: 1rem; padding-bottom: 1rem; }
        .py-5 { padding-top: 1.25rem; padding-bottom: 1.25rem; }
        .py-6 { padding-top: 1.5rem; padding-bottom: 1.5rem; }
        .pt-2 { padding-top: 0.5rem; }
        .pt-4 { padding-top: 1rem; }
        .pt-6 { padding-top: 1.5rem; }
        .pt-10 { padding-top: 2.5rem; }
        .pb-4 { padding-bottom: 1rem; }
        .pb-6 { padding-bottom: 1.5rem; }
        .pb-8 { padding-bottom: 2rem; }
        .pb-10 { padding-bottom: 2.5rem; }
        .pl-3 { padding-left: 0.75rem; }
        .pl-6 { padding-left: 1.5rem; }

        /* Sizing */
        .w-full { width: 100%; }
        .h-full { height: 100%; }
        .w-10 { width: 2.5rem; }
        .h-10 { height: 2.5rem; }
        .w-12 { width: 3rem; }
        .h-12 { height: 3rem; }
        .w-16 { width: 4rem; }
        .h-16 { height: 4rem; }
        .w-64 { width: 16rem; }
        .w-fit { width: fit-content; }

        /* Typography */
        .text-xs { font-size: 0.75rem; }
        .text-sm { font-size: 0.875rem; }
        .text-base { font-size: 1rem; }
        .text-lg { font-size: 1.125rem; }
        .text-xl { font-size: 1.25rem; }
        .text-2xl { font-size: 1.5rem; }
        .text-3xl { font-size: 1.875rem; }
        .font-bold { font-weight: 700; }
        .font-medium { font-weight: 500; }
        .uppercase { text-transform: uppercase; }
        .tracking-wide { letter-spacing: 0.05em; }
        .tracking-wider { letter-spacing: 0.08em; }

        /* Colors */
        .text-gray-400 { color: #9ca3af; }
        .text-gray-500 { color: #6b7280; }
        .text-gray-600 { color: #4b5563; }
        .text-gray-700 { color: #374151; }
        .text-gray-800 { color: #1f2937; }
        .text-gray-900 { color: #111827; }
        .text-blue-500 { color: #3b82f6; }
        .text-blue-600 { color: #2563eb; }
        .text-blue-700 { color: #1d4ed8; }
        .text-emerald-600 { color: #059669; }
        .text-emerald-700 { color: #047857; }
        .text-red-600 { color: #dc2626; }

        .bg-white { background-color: #fff; }
        .bg-gray-50 { background-color: #f9fafb; }
        .bg-gray-100 { background-color: #f3f4f6; }
        .bg-gray-200 { background-color: #e5e7eb; }
        .bg-blue-50 { background-color: #eff6ff; }
        .bg-blue-600 { background-color: #2563eb; }
        .bg-emerald-50 { background-color: #ecfdf3; }
        .bg-emerald-100 { background-color: #d1fae5; }
        .bg-red-50 { background-color: #fef2f2; }

        /* Borders & radius */
        .border { border: 1px solid #e5e7eb; }
        .border-0 { border: 0; }
        .border-b { border-bottom: 1px solid #e5e7eb; }
        .border-t { border-top: 1px solid #e5e7eb; }
        .border-l { border-left: 1px solid #e5e7eb; }
        .border-gray-100 { border-color: #f3f4f6; }
        .border-gray-200 { border-color: #e5e7eb; }
        .rounded { border-radius: 0.25rem; }
        .rounded-lg { border-radius: 0.5rem; }
        .rounded-xl { border-radius: 1rem; }
        .rounded-2xl { border-radius: 1.5rem; }
        .rounded-3xl, .rounded-[2rem] { border-radius: 2rem; }
        .rounded-full { border-radius: 9999px; }

        /* Shadows */
        .shadow-sm { box-shadow: 0 1px 2px rgba(0,0,0,0.06); }
        .shadow { box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
        .shadow-lg { box-shadow: 0 10px 15px rgba(0,0,0,0.1); }

        /* Display */
        .hidden { display: none !important; }
        .block { display: block; }

        /* Table helpers */
        .table-auto { width: auto; }
        .divide-y > :not(:last-child) { border-bottom: 1px solid #f3f4f6; }

        /* Misc */
        .uppercase { text-transform: uppercase; }
        .bg-gradient-to-r { background-image: linear-gradient(to right, var(--tw-gradient-from), var(--tw-gradient-to)); }
        .from-blue-600 { --tw-gradient-from: #2563eb; }
        .to-blue-500 { --tw-gradient-to: #3b82f6; }
        .from-emerald-500 { --tw-gradient-from: #10b981; }
        .to-teal-600 { --tw-gradient-to: #0d9488; }
        .text-emerald-100 { color: #d1fae5; }
        .text-white-50 { color: rgba(255,255,255,0.7); }

        /* Hide Alpine targets until ready */
        [x-cloak] { display: none !important; }

        /* Toolbar controls sizing consistency */
        .toolbar-control .input-group,
        .toolbar-control .form-control,
        .toolbar-control .form-select,
        .toolbar-control .input-group-text,
        .toolbar-control .btn {
            min-height: 48px;
            height: 48px;
            border-radius: 0.9rem;
        }
        .toolbar-control .btn {
            box-shadow: none;
            padding: 10px 28px;
            font-size: 0.85rem;
            white-space: nowrap;
        }
        .toolbar-control .btn i {
            margin-right: 8px;
        }
        .toolbar-control .form-select {
            font-size: 0.85rem;
        }
        .toolbar-control .badge {
            font-size: 0.80rem;
        }

        /* Card grid spacing */
        .card-grid-container {
            row-gap: 2.5rem;
        }        .toolbar-control .btn-primary {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            border: none;
            font-weight: 600;
            letter-spacing: 0.3px;
            box-shadow: 0 4px 15px rgba(78,115,223,0.3);
            transition: all 0.3s ease;
        }
        .toolbar-control .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(78,115,223,0.4);
        }
        .toolbar-control .btn-success {
            background: linear-gradient(135deg, #1abc9c 0%, #16a085 100%);
            border: none;
            font-weight: 600;
            letter-spacing: 0.3px;
            box-shadow: 0 4px 15px rgba(26,188,156,0.3);
            transition: all 0.3s ease;
        }
        .toolbar-control .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(26,188,156,0.4);
        }
        .toolbar-control .btn-purple {
            background: linear-gradient(135deg, #6f42c1 0%, #5a32a3 100%);
            border: none;
            color: #fff;
            font-weight: 600;
            letter-spacing: 0.3px;
            box-shadow: 0 4px 15px rgba(111,66,193,0.3);
            transition: all 0.3s ease;
        }
        .toolbar-control .btn-purple:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(111,66,193,0.4);
        }
        .toolbar-control .input-group-text {
            background: #f8fafc;
            border-right: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding-inline: 14px;
            border-radius: 0.9rem 0 0 0.9rem;
        }
        .toolbar-control .form-control {
            padding-inline: 14px;
            border-left: 0;
            border-radius: 0 0.9rem 0.9rem 0;
        }

        /* Tabs refinement - Underline style full width */
        .nav-pills {
            display: flex;
            width: 100%;
            border-bottom: 2px solid #e5e7eb;
        }
        .nav-pills .nav-link {
            border-radius: 0;
            border: none;
            color: #6b7280;
            min-height: 44px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 24px;
            font-weight: 600;
            border-bottom: 3px solid transparent;
            transition: all 0.3s ease;
            margin: 0;
            flex: 1;
            text-align: center;
        }
        .nav-pills .nav-link:hover {
            color: #374151;
            background-color: transparent;
        }
        .nav-pills .nav-link.active {
            background-color: transparent;
            color: #4e73df;
            border-bottom-color: #4e73df;
            box-shadow: none;
        }
    </style>
</head>

<body id="page-top">

    @php(
        $isAdmin = Auth::check() && Auth::user()->isAdmin()
    )
    @php(
        $isAdminRoute = request()->routeIs('dashboard')
            || request()->routeIs('jamaah.*')
            || request()->routeIs('donasi.*')
            || request()->routeIs('kegiatan.*')
            || request()->routeIs('kategori.*')
    )

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ $isAdminRoute ? route('dashboard') : route('home') }}">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-mosque"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Masjid</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            @if($isAdmin && $isAdminRoute)
                <!-- Nav Item - Dashboard -->
                <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('dashboard') }}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Manajemen Data
                </div>

                <li class="nav-item {{ request()->is('jamaah*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('jamaah.index') }}">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Data Jamaah</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('kegiatan*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('kegiatan.index') }}">
                        <i class="fas fa-fw fa-calendar-alt"></i>
                        <span>Kegiatan</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('donasi*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('donasi.index') }}">
                        <i class="fas fa-fw fa-hand-holding-usd"></i>
                        <span>Donasi</span>
                    </a>
                </li>

                <li class="nav-item mt-3 {{ request()->routeIs('home') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="fas fa-fw fa-home"></i>
                        <span>Kembali ke Beranda</span>
                    </a>
                </li>
            @else
                <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="fas fa-fw fa-home"></i>
                        <span>Beranda</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('user.donasi') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('user.donasi') }}">
                        <i class="fas fa-fw fa-donate"></i>
                        <span>Donasi Saya</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('user.kegiatan') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('user.kegiatan') }}">
                        <i class="fas fa-fw fa-calendar-check"></i>
                        <span>Kegiatan Saya</span>
                    </a>
                </li>
                @if($isAdmin)
                <li class="nav-item mt-3 {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('dashboard') }}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard Admin</span>
                    </a>
                </li>
                @endif
            @endif

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    {{ Auth::user()->nama_lengkap ?? 'User' }}
                                </span>
                                <i class="fas fa-user-circle fa-2x text-gray-300"></i>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('user.profile') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    @yield('content')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Sistem Informasi Masjid {{ date('Y') }}</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin Ingin Logout?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih "Logout" di bawah jika Anda siap mengakhiri sesi saat ini.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-primary">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('sb-admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('sb-admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('sb-admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('sb-admin/js/sb-admin-2.min.js') }}"></script>

    <!-- Alpine.js for lightweight interactivity -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    @yield('scripts')

</body>
</html>
