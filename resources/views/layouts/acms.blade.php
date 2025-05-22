<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard' }} - Sistem Layanan Surat Menyurat Desa</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
    <!-- Moment.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        .sidebar {
            min-height: 100vh;
            height: 100vh;
            background-color: #343a40;
            color: #fff;
            position: fixed;
            width: 240px;
            transition: all 0.3s;
            z-index: 1000;
            overflow-y: auto;
            overflow-x: hidden;
        }
        .sidebar.collapsed {
            width: 70px;
        }
        .sidebar-header {
            padding: 20px;
            background-color: #212529;
            text-align: center;
            position: relative;
        }
        .sidebar-header h3 {
            margin: 0;
            font-size: 1.2rem;
            font-weight: bold;
            word-wrap: break-word;
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
            padding: 12px 20px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s;
            border-left: 3px solid transparent;
            word-wrap: break-word;
            white-space: normal;
        }
        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            color: #fff;
            background-color: #4a5056;
            border-left: 3px solid #007bff;
        }
        .sidebar-menu a i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        .sidebar.collapsed .sidebar-menu a {
            padding: 12px 20px;
            text-align: center;
        }
        .sidebar.collapsed .sidebar-menu a i {
            margin-right: 0;
            font-size: 1.2rem;
        }
        .toggle-sidebar {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: white;
            cursor: pointer;
        }
        .sidebar.collapsed .toggle-sidebar {
            left: 50%;
            transform: translate(-50%, -50%);
            top: 20px;
        }
        .content {
            margin-left: 240px;
            padding: 20px;
            transition: all 0.3s;
        }
        .content.expanded {
            margin-left: 70px;
        }
        .navbar {
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        .navbar-light .navbar-nav .nav-link {
            color: #495057;
        }
        .notification-badge {
            position: absolute;
            top: 0px;
            right: 5px;
            background-color: #dc3545;
            color: white;
            font-size: 10px;
            padding: 1px 5px;
            border-radius: 50%;
        }
        .menu-section {
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.8rem;
            text-transform: uppercase;
            padding: 10px 20px;
            margin-top: 10px;
            word-wrap: break-word;
        }
        .dropdown-menu {
            border: none;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .dashboard-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
            padding: 20px;
            margin-bottom: 20px;
            transition: all 0.3s;
        }
        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .dashboard-card .icon {
            font-size: 48px;
            color: #007bff;
        }
        .dashboard-card h4 {
            margin-top: 15px;
            font-weight: 600;
        }
        .dashboard-card p {
            color: #6c757d;
        }
        .btn-action {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            transition: all 0.3s;
        }
        .btn-action:hover {
            background-color: #0069d9;
            color: white;
        }
        @media (max-width: 768px) {
            .sidebar {
                margin-left: -240px;
            }
            .sidebar.collapsed {
                margin-left: -70px;
            }
            .content {
                margin-left: 0;
            }
            .sidebar.active {
                margin-left: 0;
            }
            .content.active {
                margin-left: 240px;
            }
            .content.expanded.active {
                margin-left: 70px;
            }
        }
        .role-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 12px;
            margin-left: 5px;
        }
        .role-admin {
            background-color: #dc3545;
            color: white;
        }
        .role-resident {
            background-color: #28a745;
            color: white;
        }
        .role-staff {
            background-color: #ffc107;
            color: #212529;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <nav class="sidebar">
        <div class="sidebar-header">
            <h3>Sistem Layanan Surat Desa</h3>
            <small>
                {{ session()->get('name') }}
                @if(session()->get('role') === 'admin')
                    <span class="role-badge role-admin">Admin</span>
                @elseif(session()->get('role') === 'staff')
                    <span class="role-badge role-staff">Staff</span>
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
            
            @if(session()->get('role') === 'admin' || session()->get('role') === 'staff')
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
            
            <a href="{{ URL::to('notifications') }}" class="{{ request()->is('notifications') ? 'active' : '' }}">
                <i class="fas fa-bell"></i> <span>Notifications</span>
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
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-1"></i> {{ session()->get('name') }}  Masyarakat
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ URL::to('profile') }}"><i class="fas fa-user me-2"></i> Profil</a></li>
                            <li><a class="dropdown-item" href="{{ URL::to('notifications') }}"><i class="fas fa-bell me-2"></i> Notifikasi</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ URL::to('auth/logout') }}"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        
        <!-- Main Content -->
        @yield('content')
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
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
    </script>
</body>
</html>

