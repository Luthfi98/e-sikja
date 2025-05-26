<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Beranda' ?> - Sistem Layanan Surat Menyurat Desa</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/landing.css') }}">

    <style>
        
    </style>
</head>
<body>
    <!-- Add Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-envelope-open-text"></i>
                <span>Desa Sukamaju</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('/') ? 'active' : '' }}" href="{{ route('/') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('profil*') ? 'active' : '' }}" href="#profil">Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('pengajuan*') ? 'active' : '' }}" href="{{ route('pengajuan.index') }}">Pengajuan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('pengaduan*') ? 'active' : '' }}" href="{{ route('pengaduan.index') }}">Pengaduan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('informasi*') ? 'active' : '' }}" href="{{ route('informasi.index') }}">Informasi</a>
                    </li>
                    <li class="nav-item ms-2">
                        <a class="btn btn-login text-white" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt me-2"></i>Login
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-3 mb-md-0">
                    <h5>Desa Sukamaju</h5>
                    <p>Sistem Layanan Surat Menyurat Desa yang Modern dan Efisien</p>
                    <p><i class="fas fa-map-marker-alt me-2"></i>Kecamatan Sukamaju, Kabupaten Sukamaju</p>
                    <p><i class="fas fa-clock me-2"></i>Senin - Jumat: 08:00 - 16:00 | Sabtu: 08:00 - 12:00</p>
                </div>
                <div class="col-lg-4 col-md-6 mb-3 mb-md-0">
                    <h5>Kontak</h5>
                    <p><i class="fas fa-phone me-2"></i>(021) 1234-5678</p>
                    <p><i class="fas fa-envelope me-2"></i>info@desasukamaju.id</p>
                </div>
                <div class="col-lg-4 col-md-12">
                    <h5>Ikuti Kami</h5>
                    <div class="social-links mb-2">
                        <a href="#" class="text-dark"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-dark"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-dark"><i class="fab fa-youtube"></i></a>
                        <a href="#" class="text-dark"><i class="fab fa-twitter"></i></a>
                    </div>
                    <p class="small">Dapatkan informasi terbaru melalui media sosial kami</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p class="mb-0">&copy; 2024 Desa Sukamaju. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
