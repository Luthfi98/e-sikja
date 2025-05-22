<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard' }} - Sistem Layanan Surat Menyurat Desa</title>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <!-- Moment.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root {
            --primary-color: #4a90e2;
            --secondary-color: #357abd;
            --dark-color: #2c3e50;
            --light-color: #f8f9fa;
            --success-color: #28a745;
            --warning-color: #ffc107;
            --danger-color: #dc3545;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }

        .sidebar {
            min-height: 100vh;
            height: 100vh;
            background: linear-gradient(180deg, #2c3e50 0%, #1a252f 100%);
            color: #fff;
            position: fixed;
            width: 280px;
            transition: all 0.3s ease;
            z-index: 1000;
            overflow-y: auto;
            overflow-x: hidden;
            box-shadow: 4px 0 10px rgba(0,0,0,0.1);
        }

        .sidebar.collapsed {
            width: 80px;
        }

        .sidebar-header {
            padding: 25px 20px;
            background: rgba(0,0,0,0.2);
            text-align: center;
            position: relative;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-header h3 {
            margin: 0;
            font-size: 1.3rem;
            font-weight: 600;
            word-wrap: break-word;
            color: #fff;
        }

        .sidebar.collapsed .sidebar-header h3, 
        .sidebar.collapsed .menu-section, 
        .sidebar.collapsed .sidebar-menu a span,
        .sidebar.collapsed small {
            display: none;
        }

        .sidebar-menu {
            padding: 20px 0;
        }

        .sidebar-menu a {
            display: block;
            padding: 12px 25px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
            word-wrap: break-word;
            white-space: normal;
            font-size: 0.95rem;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            color: #fff;
            background: rgba(255,255,255,0.1);
            border-left: 3px solid var(--primary-color);
        }

        .sidebar-menu a i {
            margin-right: 12px;
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
        }

        .sidebar.collapsed .sidebar-menu a {
            padding: 15px 0;
            text-align: center;
        }

        .sidebar.collapsed .sidebar-menu a i {
            margin-right: 0;
            font-size: 1.3rem;
        }

        .toggle-sidebar {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: white;
            cursor: pointer;
            padding: 5px;
            transition: all 0.3s ease;
        }

        .toggle-sidebar:hover {
            color: var(--primary-color);
        }

        .sidebar.collapsed .toggle-sidebar {
            left: 50%;
            transform: translate(-50%, -50%);
            top: 25px;
        }

        .content {
            margin-left: 280px;
            padding: 25px;
            transition: all 0.3s ease;
        }

        .content.expanded {
            margin-left: 80px;
        }

        .navbar {
            background-color: #fff;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
            border-radius: 10px;
            padding: 15px 25px;
            margin-bottom: 25px;
        }

        .navbar-light .navbar-nav .nav-link {
            color: var(--dark-color);
            font-weight: 500;
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: var(--danger-color);
            color: white;
            font-size: 10px;
            padding: 2px 6px;
            border-radius: 50%;
            font-weight: 600;
        }

        .menu-section {
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.75rem;
            text-transform: uppercase;
            padding: 15px 25px 5px;
            margin-top: 10px;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            border-radius: 8px;
            padding: 10px;
        }

        .dropdown-item {
            padding: 8px 15px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .dropdown-item:hover {
            background-color: var(--light-color);
        }

        .dashboard-card {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            padding: 25px;
            margin-bottom: 25px;
            transition: all 0.3s ease;
            border: none;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        .dashboard-card .icon {
            font-size: 48px;
            color: var(--primary-color);
            margin-bottom: 15px;
        }

        .dashboard-card h4 {
            margin-top: 15px;
            font-weight: 600;
            color: var(--dark-color);
        }

        .dashboard-card p {
            color: #6c757d;
            margin-bottom: 0;
        }

        .btn-action {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .btn-action:hover {
            background: linear-gradient(135deg, var(--secondary-color) 0%, var(--primary-color) 100%);
            color: white;
            transform: translateY(-2px);
        }

        .role-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            margin-left: 8px;
        }

        .role-admin {
            background-color: var(--danger-color);
            color: white;
        }

        .role-resident {
            background-color: var(--success-color);
            color: white;
        }

        .role-operator {
            background-color: var(--warning-color);
            color: #212529;
        }

        @media (max-width: 768px) {
            .sidebar {
                margin-left: -280px;
            }
            .sidebar.collapsed {
                margin-left: -80px;
            }
            .content {
                margin-left: 0;
                padding: 15px;
            }
            .sidebar.active {
                margin-left: 0;
            }
            .content.active {
                margin-left: 280px;
            }
            .content.expanded.active {
                margin-left: 80px;
            }
            .navbar {
                padding: 10px 15px;
            }
        }

        /* Custom Scrollbar */
        .sidebar::-webkit-scrollbar {
            width: 5px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(255,255,255,0.1);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.2);
            border-radius: 5px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255,255,255,0.3);
        }
    </style>
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
                    <span class="role-badge role-operator">Staff</span>
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
            @elseif (Auth::user()?->role === 'operator')
                <div class="menu-section">Menu Operator </div>
            @else
                <div class="menu-section">Menu Administrator </div>
                <a href="{{ URL::to('profil-desa') }}" class="{{ request()->is('profil-desa*') ? 'active' : '' }}">
                    <i class="fas fa-clipboard-list"></i> <span>Profil Desa</span>
                </a>
                <a href="{{ URL::to('data-masyarakat') }}" class="{{ request()->is('data-masyarakat*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i> <span>Data Masyarakat</span>
                </a>
                <a href="{{ route('jenis-permohonan.index') }}" class="{{ request()->is('jenis-permohonan*') ? 'active' : '' }}">
                    <i class="fas fa-list"></i> <span>Jenis Permohonan</span>
                </a>
                <a href="{{ URL::to('pengajuan-sk') }}" class="{{ request()->is('pengajuan-sk*') ? 'active' : '' }}">
                    <i class="fas fa-envelope"></i> <span>Pengajuan Surat Keterangan</span>
                </a>

                <a href="{{ URL::to('pengaduan-masyarakat') }}" class="{{ request()->is('pengaduan-masyarakat*') ? 'active' : '' }}">
                    <i class="fas fa-bullhorn"></i> <span>Pengaduan Masyarakat</span>
                </a>

                <a href="{{ URL::to('manajemen-pengguna') }}" class="{{ request()->is('manajemen-pengguna*') ? 'active' : '' }}">
                    <i class="fas fa-user-tie"></i> <span>Manajemen Pengguna</span>
                </a>

            @endif

            @if(session()->get('role') === 'admin' || session()->get('role') === 'operator')
                <!-- Menu Admin -->
                <div class="menu-section">ADMIN MENU</div>
                @if(session()->get('role') === 'admin')
    
                <a href="{{ URL::to('village-profile') }}" class="{{ request()->is('village-profile*') ? 'active' : '' }}">
                    <i class="fas fa-clipboard-list"></i> <span>Profil Desa</span>
                </a>

                <a href="{{ URL::to('news') }}" class="{{ request()->is('news*') ? 'active' : '' }}">
                    <i class="fas fa-newspaper"></i> <span>Berita & Informasi Desa</span>
                </a>
                @endif
                <a href="{{ URL::to('letter-types') }}" class="{{ request()->is('letter-types*') ? 'active' : '' }}">
                    <i class="fas fa-file-alt"></i> <span>Jenis Surat</span>
                </a>

                <a href="{{ URL::to('residents') }}" class="{{ request()->is('residents*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i> <span>Data Penduduk</span>
                </a>
                
                <a href="{{ URL::to('general-request') }}" class="{{ request()->is('general-request*') ? 'active' : '' }}">
                    <i class="fas fa-envelope"></i> <span>Pengajuan Surat Keterangan</span>
                </a>

                <a href="{{ URL::to('domicile-request') }}" class="{{ request()->is('domicile-request*') ? 'active' : '' }}">
                    <i class="fas fa-envelope"></i> <span>Pengajuan SK Domisili</span>
                </a>

                <a href="{{ URL::to('heir-request') }}" class="{{ request()->is('heir-request*') ? 'active' : '' }}">
                    <i class="fas fa-envelope"></i> <span>Pengajuan SK Ahli Waris</span>
                </a>

                <a href="{{ URL::to('relocation-request') }}" class="{{ request()->is('relocation-request*') ? 'active' : '' }}">
                    <i class="fas fa-envelope"></i> <span>Pengajuan SK Pindah</span>
                </a>

                <a href="{{ URL::to('death-certificate-request') }}" class="{{ request()->is('death-certificate-request*') ? 'active' : '' }}">
                    <i class="fas fa-envelope"></i> <span>Pengajuan SK Kematian</span>
                </a>
                
                <a href="{{ URL::to('complaints/admin') }}" class="{{ request()->is('complaints/admin*') ? 'active' : '' }}">
                    <i class="fas fa-bullhorn"></i> <span>Pengaduan Warga</span>
                    @if(isset($pendingPengaduanCount) && $pendingPengaduanCount > 0)
                        <span class="notification-badge">{{ $pendingPengaduanCount }}</span>
                    @endif
                </a>
               
                
            @else
                <!-- Menu Masyarakat -->
                <div class="menu-section">RESIDENT MENU</div>
                <a href="{{ URL::to('general-request/my-request') }}" class="{{ request()->is('general-request/my-request*') ? 'active' : '' }}">
                    <i class="fas fa-envelope"></i> <span>Pengajuan Surat Keterangan</span>
                </a>

                <a href="{{ URL::to('domicile-request/my-request') }}" class="{{ request()->is('domicile-request/my-request*') ? 'active' : '' }}">
                    <i class="fas fa-envelope"></i> <span>Pengajuan SK Domisili</span>
                </a>

                <a href="{{ URL::to('heir-request/my-request') }}" class="{{ request()->is('heir-request/my-request*') ? 'active' : '' }}">
                    <i class="fas fa-envelope"></i> <span>Pengajuan SK Ahli Waris</span>
                </a>

                <a href="{{ URL::to('relocation-request/my-request') }}" class="{{ request()->is('relocation-request/my-request*') ? 'active' : '' }}">
                    <i class="fas fa-envelope"></i> <span>Pengajuan SK Pindah</span>
                </a>

                <a href="{{ URL::to('death-certificate-request/my-request') }}" class="{{ request()->is('death-certificate-request/my-request*') ? 'active' : '' }}">
                    <i class="fas fa-envelope"></i> <span>Pengajuan SK Kematian</span>
                </a>

                
                <a href="{{ URL::to('complaints') }}" class="{{ request()->is('complaints') && !request()->is('complaints/admin*') ? 'active' : '' }}">
                    <i class="fas fa-exclamation-circle"></i> <span>Pengaduan</span>
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

