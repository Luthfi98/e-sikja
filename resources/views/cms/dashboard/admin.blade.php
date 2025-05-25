@extends('layouts.cms')


@section('content')
<div class="container-fluid">
    <!-- Statistics Cards Row -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="dashboard-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Total Pengajuan</h6>
                        <h4 class="mb-0">{{ $totalPengajuan ?? 0 }}</h4>
                    </div>
                    <div class="icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="dashboard-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Total Pengaduan</h6>
                        <h4 class="mb-0">{{ $totalPengaduan ?? 0 }}</h4>
                    </div>
                    <div class="icon">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="dashboard-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Total Pemberitahuan</h6>
                        <h4 class="mb-0">{{ $totalPemberitahuan ?? 0 }}</h4>
                    </div>
                    <div class="icon">
                        <i class="fas fa-bell"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="dashboard-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Total Masyarakat</h6>
                        <h4 class="mb-0">{{ $totalMasyarakat ?? 0 }}</h4>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activities and Quick Actions Row -->
    <div class="row">
        <!-- Recent Activities -->
        <div class="col-xl-8 mb-4">
            <div class="dashboard-card">
                <h5 class="mb-4">Aktivitas Terbaru</h5>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Aktivitas</th>
                                <th>Pengguna</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentActivities ?? [] as $activity)
                            <tr>
                                <td>{{ $activity->created_at->format('d/m/Y H:i') }}</td>
                                <td>{{ $activity->description }}</td>
                                <td>{{ $activity->user->name }}</td>
                                <td>
                                    <span class="badge bg-{{ $activity->status_color }}">
                                        {{ $activity->status }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada aktivitas terbaru</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize any necessary JavaScript components here
    });
</script>
@endpush
