<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Dashboard' }} - Sistem Layanan Surat Menyurat Desa</title>
    <!-- jQuery -->
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fontawesome/css/all.min.css') }}">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/css/dataTables.bootstrap5.min.css') }}">
    <!-- DataTables Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/css/responsive.bootstrap5.min.css') }}">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/sweetalert2/sweetalert2.min.css') }}">
    <!-- Popper.js -->
    <script src="{{ asset('assets/vendor/popper/popper.min.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- Moment.js -->
    <script src="{{ asset('assets/vendor/moment/moment.min.js') }}"></script>
    <!-- DataTables JS -->
    <script src="{{ asset('assets/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/js/dataTables.bootstrap5.min.js') }}"></script>
    <!-- DataTables Responsive JS -->
    <script src="{{ asset('assets/vendor/datatables/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/js/responsive.bootstrap5.min.js') }}"></script>
    <!-- SweetAlert2 JS -->
    <script src="{{ asset('assets/vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <!-- CKEditor -->
    <script src="{{ asset('assets/vendor/ckeditor/ckeditor.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/cms.css') }}">
</head>
<body>
    <!-- Sidebar -->
    <nav class="sidebar">
        <div class="sidebar-header">
            <h3>Sistem Layanan Surat Desa</h3>
            <small>
                {{ Auth::user()->name }}
                @if(Auth::user()->role === 'admin')
                    <span class="role-badge role-admin">Admin</span>
                @elseif(Auth::user()->role === 'operator')
                    <span class="role-badge role-operator">Operator</span>
                @else
                    <span class="role-badge role-resident">Masyarakat</span>
                @endif
            </small>
            <button class="toggle-sidebar" id="toggleSidebar">
                <i class="fas fa-chevron-left"></i>
            </button>
        </div>
        
        <div class="sidebar-menu">
            <a href="{{ URL::to('dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt"></i> <span>Dashboard</span>
            </a>
            @if (Auth::user()?->role === 'masyarakat')
                <div class="menu-section">Menu Masyarakat </div>
                <a href="{{ route('pengajuan-saya.index') }}" class="{{ request()->is('pengajuan-saya*') ? 'active' : '' }}">
                    <i class="fas fa-envelope"></i> <span>Pengajuan Surat</span>
                </a>
                <a href="{{ route('pengaduan-saya.index') }}" class="{{ request()->is('pengaduan-saya*') ? 'active' : '' }}">
                    <i class="fas fa-bullhorn"></i> <span>Pengaduan</span>
                </a>
            @elseif (Auth::user()?->role === 'operator')
                <div class="menu-section">Menu Operator </div>
                <a href="{{ route('data-masyarakat.index') }}" class="{{ request()->is('data-masyarakat*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i> <span>Data Masyarakat</span>
                </a>

                <a href="{{ route('data-pengajuan.index') }}" class="{{ request()->is('data-pengajuan*') ? 'active' : '' }}">
                    <i class="fas fa-inbox"></i> <span>Data Pengajuan</span>
                </a>

            @else
                <div class="menu-section">Menu Administrator </div>
                <a href="{{ URL::to('profil-desa') }}" class="{{ request()->is('profil-desa*') ? 'active' : '' }}">
                    <i class="fas fa-clipboard-list"></i> <span>Profil Desa</span>
                </a>
                
                <a href="{{ route('informasi-desa.index') }}" class="{{ request()->is('informasi-desa*') ? 'active' : '' }}">
                    <i class="fas fa-info"></i> <span>Informasi Desa</span>
                </a>
                <a href="{{ route('data-masyarakat.index') }}" class="{{ request()->is('data-masyarakat*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i> <span>Data Masyarakat</span>
                </a>
                <a href="{{ route('jenis-permohonan.index') }}" class="{{ request()->is('jenis-permohonan*') ? 'active' : '' }}">
                    <i class="fas fa-list"></i> <span>Jenis Permohonan</span>
                </a>
                <a href="{{ route('data-pengajuan.index') }}" class="{{ request()->is('data-pengajuan*') ? 'active' : '' }}">
                    <i class="fas fa-inbox"></i> <span>Data Pengajuan</span>
                </a>

                <a href="{{ URL::to('pengaduan-masyarakat') }}" class="{{ request()->is('pengaduan-masyarakat*') ? 'active' : '' }}">
                    <i class="fas fa-bullhorn"></i> <span>Pengaduan Masyarakat</span>
                </a>

                <a href="{{ URL::to('manajemen-pengguna') }}" class="{{ request()->is('manajemen-pengguna*') ? 'active' : '' }}">
                    <i class="fas fa-user-tie"></i> <span>Manajemen Pengguna</span>
                </a>

            @endif
            
            
            <!-- Menu Umum -->
            <div class="menu-section">SETTINGS</div>

            @if(session()->get('role') === 'admin')
                <a href="{{ URL::to('users') }}" class="{{ request()->is('users') ? 'active' : '' }}">
                    <i class="fas fa-user-tie"></i> <span>Manajemen User</span>
                </a>
                <a href="{{ URL::to('admin/settings') }}" class="{{ request()->is('admin/settings*') ? 'active' : '' }}">
                    <i class="fas fa-cogs"></i> <span>Settings Management</span>
                </a>
            @endif
            
            
            <a href="{{ URL::to('profile') }}" class="{{ request()->is('profile') ? 'active' : '' }}">
                <i class="fas fa-user-circle"></i> <span>My Profile</span>
            </a>
            
            <a href="{{ URL::to('notifikasi') }}" class="{{ request()->is('notifikasi') ? 'active' : '' }}">
                <i class="fas fa-bell"></i> <span>Notifikasi</span>
            </a>
            
            <a href="{{ URL::to('auth/logout') }}">
                <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
            </a>
        </div>
    </nav>

    <!-- Content -->
    <div class="content">
        <nav class="navbar navbar-expand-lg navbar-light mb-4">
            <div class="container-fluid">
                <button id="sidebarToggle" class="btn btn-outline-secondary d-md-none">
                    <i class="fas fa-bars"></i>
                </button>
                <h4 class="mb-0 ms-2">{{ $title ?? 'Dashboard' }}</h4>
                <div class="ms-auto d-flex align-items-center">
                    <div class="dropdown">
                        <button class="btn btn-link nav-link dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="{{ URL::to('profile') }}"><i class="fas fa-user me-2"></i> Profil</a></li>
                            <li><a class="dropdown-item" href="{{ URL::to('notifikasi') }}"><i class="fas fa-bell me-2"></i> Notifikasi</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        
        <!-- Main Content -->
        @yield('content')
    </div>

    <script>
        // Initialize dropdowns
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize all dropdowns
            var dropdownTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="dropdown"]'));
            dropdownTriggerList.map(function(dropdownTriggerEl) {
                return new bootstrap.Dropdown(dropdownTriggerEl);
            });

            // Toggle sidebar for all screen sizes
            document.getElementById('toggleSidebar').addEventListener('click', function() {
                const sidebar = document.querySelector('.sidebar');
                const content = document.querySelector('.content');
                const toggleIcon = this.querySelector('i');
                
                sidebar.classList.toggle('collapsed');
                content.classList.toggle('expanded');
                
                // Change icon direction
                if (sidebar.classList.contains('collapsed')) {
                    toggleIcon.classList.remove('fa-chevron-left');
                    toggleIcon.classList.add('fa-chevron-right');
                } else {
                    toggleIcon.classList.remove('fa-chevron-right');
                    toggleIcon.classList.add('fa-chevron-left');
                }
            });
            
            // Mobile sidebar toggle
            document.getElementById('sidebarToggle').addEventListener('click', function() {
                const sidebar = document.querySelector('.sidebar');
                const content = document.querySelector('.content');
                
                sidebar.classList.toggle('active');
                content.classList.toggle('active');
            });
        });

        const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });
            
    </script>

    @if (session('success'))
        <script>
            Toast.fire({
                icon: 'success',
                title: '{{ session('success') }}'
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            Toast.fire({
                icon: 'error',
                title: '{{ session('error') }}'
            });
        </script>
    @endif
    @stack('scripts')
</body>
</html>

