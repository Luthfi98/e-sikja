@extends('layouts.cms')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard Operator</h1>
    </div>

    <!-- Statistics Cards Row -->
    <div class="row d-flex justify-content-center">
        <!-- Total Pengajuan Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('data-pengajuan.index') }}" class="text-decoration-none">
                <div class="dashboard-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Total Pengajuan</h6>
                            <h4 class="mb-0">{{ $totalRequest ?? 0 }}</h4>
                        </div>
                        <div class="icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Pengajuan Pending Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('data-pengaduan.index') }}" class="text-decoration-none">
                <div class="dashboard-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Total Pengaduan</h6>
                            <h4 class="mb-0">{{ $totalComplaint ?? 0 }}</h4>
                        </div>
                        <div class="icon">
                            <i class="fas fa-bullhorn"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Pengajuan Disetujui Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('data-masyarakat.index') }}" class="text-decoration-none">
                <div class="dashboard-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Total Masyarakat</h6>
                            <h4 class="mb-0">{{ $totalResident ?? 0 }}</h4>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Pengajuan Ditolak Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('notifikasi.index') }}" class="text-decoration-none">
                <div class="dashboard-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Total Notifikasi</h6>
                            <h4 class="mb-0">{{ $totalNotification ?? 0 }}</h4>
                        </div>
                        <div class="icon">
                            <i class="fas fa-bell"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Pengajuan Terbaru -->
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Pengajuan Terbaru</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentPengajuan ?? [] as $pengajuan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pengajuan->nama }}</td>
                                    <td>{{ $pengajuan->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <span class="badge bg-{{ $pengajuan->status == 'pending' ? 'warning' : ($pengajuan->status == 'approved' ? 'success' : 'danger') }}">
                                            {{ $pengajuan->status == 'pending' ? 'Pending' : ($pengajuan->status == 'approved' ? 'Disetujui' : 'Ditolak') }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('data-pengajuan.show', $pengajuan->id) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada data pengajuan</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Pengaduan Terbaru</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nomor Pengaduan</th>
                                    <th>Judul Pengaduan</th>
                                    <th>Status</th>
                                    <th>Tanggal Pengaduan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($latestComplaints) == 0)
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada pengaudan</td>
                                    </tr>
                                @else
                                    @foreach($latestComplaints as $index => $request)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $request->code }}</td>
                                            <td>{{ $request->title }}</td>
                                            <td>
                                                <span class="badge bg-{{ $request->status == 'Diajukan' ? 'warning' : ($request->status == 'Diproses' ? 'info' : ($request->status == 'Selesai' ? 'success' : 'danger')) }}">
                                                    {{ $request->status }}
                                                </span>
                                            </td>
                                            <td>{{ date('d-m-Y', strtotime($request->created_at)) }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection

@push('styles')
<style>
    .dashboard-card {
        background: #fff;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }

    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    .dashboard-card .icon {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #f8f9fc;
    }

    .dashboard-card .icon i {
        font-size: 24px;
        color: #4e73df;
    }

    .badge {
        padding: 8px 12px;
        font-size: 12px;
        font-weight: 600;
    }

    .bg-warning {
        background-color: #f6c23e !important;
    }

    .bg-success {
        background-color: #1cc88a !important;
    }

    .bg-danger {
        background-color: #e74a3b !important;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize any necessary JavaScript components here
    });
</script>
@endpush