@extends('layouts.landing')

@section('content')
<div class="container py-5 mt-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <!-- Back Button -->
            <div class="mb-4">
                <a href="{{ route('informasi.index') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar Informasi
                </a>
            </div>

            <!-- Information Detail Card -->
            <div class="info-card">
                @if($information->image)
                    <img src="{{ asset('storage/' . $information->image) }}" 
                         alt="{{ $information->title }}" 
                         class="img-fluid rounded mb-4 w-100"
                         style="max-height: 400px; object-fit: cover;">
                @endif

                <h1 class="mb-3">{{ $information->title }}</h1>
                
                <div class="d-flex align-items-center text-muted mb-4">
                    <i class="fas fa-calendar-alt me-2" style="font-size: 0.9rem;"></i>
                    <span>{{ \Carbon\Carbon::parse($information->created_at)->locale('id')->isoFormat('D MMMM Y') }}</span>
                    <span class="mx-2">|</span>
                    <i class="fas fa-user me-2" style="font-size: 0.9rem;"></i>
                    <span>{{ $information->user->name }}</span>
                </div>

                <div class="content">
                    {!! $information->description !!}
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .content {
        line-height: 1.8;
        color: #2c3e50;
    }
    .content p {
        margin-bottom: 1.5rem;
    }
    .content img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 1rem 0;
    }
</style>
@endsection 