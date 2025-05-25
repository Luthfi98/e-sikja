@extends('layouts.landing')

@section('content')
<!-- Hero Section -->
    <section class="hero-section" id="beranda">
        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://images.unsplash.com/photo-1581578731548-c64695cc6952?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80" alt="Desa Sukamaju">
                    <div class="carousel-caption">
                        <h1>Selamat Datang di Desa Sukamaju</h1>
                        <p>Sistem Layanan Surat Menyurat Desa yang Modern dan Efisien</p>
                        <a href="{{ route('register') }}" class="btn btn-hero text-white">
                            <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                        </a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://images.unsplash.com/photo-1521791136064-7986c2920216?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80" alt="Layanan Desa">
                    <div class="carousel-caption">
                        <h1>Layanan Terpadu</h1>
                        <p>Pengajuan surat dan pengaduan dapat dilakukan secara online</p>
                        <a href="{{ route('register') }}" class="btn btn-hero text-white">
                            <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                        </a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://images.unsplash.com/photo-1500382017468-9049fed747ef?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80" alt="Potensi Desa">
                    <div class="carousel-caption">
                        <h1>Desa yang Maju</h1>
                        <p>Mengembangkan potensi desa untuk kesejahteraan masyarakat</p>
                        <a href="{{ route('register') }}" class="btn btn-hero text-white">
                            <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                        </a>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <!-- Pengajuan Section -->
    <section class="py-5" id="pengajuan">
        <div class="container">
            <h2 class="section-title">Cara Pengajuan Surat</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="info-card">
                        <i class="fas fa-user-plus"></i>
                        <h3>1. Daftar Akun</h3>
                        <p>Buat akun baru melalui tombol daftar di atas. Isi data diri dengan lengkap dan valid.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-card">
                        <i class="fas fa-file-alt"></i>
                        <h3>2. Pilih Jenis Surat</h3>
                        <p>Login ke akun Anda dan pilih jenis surat yang ingin diajukan dari menu pengajuan.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-card">
                        <i class="fas fa-check-circle"></i>
                        <h3>3. Proses Verifikasi</h3>
                        <p>Tim desa akan memverifikasi pengajuan Anda. Status dapat dicek melalui dashboard.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pengaduan Section -->
    <section class="py-5 bg-light" id="pengaduan">
        <div class="container">
            <h2 class="section-title">Cara Pengaduan</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="info-card">
                        <i class="fas fa-sign-in-alt"></i>
                        <h3>1. Login</h3>
                        <p>Login ke akun Anda untuk mengakses fitur pengaduan.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-card">
                        <i class="fas fa-comment-alt"></i>
                        <h3>2. Buat Pengaduan</h3>
                        <p>Isi form pengaduan dengan detail permasalahan yang Anda hadapi.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-card">
                        <i class="fas fa-history"></i>
                        <h3>3. Pantau Status</h3>
                        <p>Pantau status pengaduan Anda melalui dashboard pengaduan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Informasi Desa Section -->
    <section class="py-5" id="informasi">
        <div class="container">
            <h2 class="section-title">Informasi Desa</h2>
            <div class="info-scroll-container">
                <div class="info-scroll-wrapper">
                @foreach ($informations as $information)
                    <div class="info-article-card">
                        <img src="{{ asset('storage/'.$information->image) }}" alt="{{ $information->title }}">
                        <div class="card-content">
                            <h3>{{ $information->title }}</h3>
                            <p>{!! Str::limit($information->description, 250) !!}</p>
                            <a href="{{ route('informasi.show', $information->id.'-'. $information->slug) }}" class="btn btn-sm btn-primary">Lihat Selengkapnya</a>
                        </div>
                    </div>
                @endforeach

                    <div class="info-article-card">
                        <img src="https://images.unsplash.com/photo-1581578731548-c64695cc6952?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Sejarah Desa">
                        <div class="card-content">
                            <h3>Sejarah Desa Sukamaju</h3>
                            <p>Desa Sukamaju adalah sebuah desa yang kaya akan sejarah dan budaya. Berdiri sejak tahun 1950, desa ini telah mengalami berbagai perkembangan dan perubahan yang signifikan. Masyarakat Desa Sukamaju dikenal dengan semangat gotong royongnya yang tinggi dan komitmennya dalam menjaga nilai-nilai tradisional.</p>
                        </div>
                    </div>
                    
                    <div class="info-article-card">
                        <img src="https://images.unsplash.com/photo-1521791136064-7986c2920216?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Visi & Misi">
                        <div class="card-content">
                            <h3>Visi & Misi</h3>
                            <p>Visi kami adalah menjadikan Desa Sukamaju sebagai desa yang mandiri, maju, dan sejahtera dengan mengedepankan nilai-nilai kearifan lokal. Misi kami meliputi pengembangan ekonomi masyarakat, peningkatan kualitas pendidikan, dan pelestarian budaya desa.</p>
                        </div>
                    </div>
                    
                    <div class="info-article-card">
                        <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Program Unggulan">
                        <div class="card-content">
                            <h3>Program Unggulan</h3>
                            <p>Desa Sukamaju memiliki beberapa program unggulan yang terus dikembangkan:</p>
                            <ul>
                                <li>Program Pemberdayaan Ekonomi Masyarakat</li>
                                <li>Pengembangan Wisata Desa</li>
                                <li>Pendidikan Karakter Berbasis Budaya</li>
                                <li>Pengembangan Teknologi Informasi Desa</li>
                            </ul>
                        </div>
                    </div>

                    <div class="info-article-card">
                        <img src="https://images.unsplash.com/photo-1500382017468-9049fed747ef?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Potensi Desa">
                        <div class="card-content">
                            <h3>Potensi Desa</h3>
                            <p>Desa Sukamaju memiliki berbagai potensi yang dapat dikembangkan, mulai dari sektor pertanian, peternakan, hingga wisata alam. Masyarakat desa juga dikenal dengan kerajinan tangan dan produk lokal yang berkualitas.</p>
                        </div>
                    </div>

                    <div class="info-article-card">
                        <img src="https://images.unsplash.com/photo-1511632765486-a01980e01a18?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Budaya & Tradisi">
                        <div class="card-content">
                            <h3>Budaya & Tradisi</h3>
                            <p>Kaya akan warisan budaya, Desa Sukamaju tetap mempertahankan berbagai tradisi dan adat istiadat yang telah turun temurun. Kegiatan budaya rutin diadakan untuk melestarikan nilai-nilai luhur masyarakat.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection