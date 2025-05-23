@extends('layouts.cms')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title"></h3>
                    <a href="{{ route('pengajuan-saya.index') }}" class="btn btn-sm btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    @if($requestLetter)
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <h5>Informasi Pengajuan</h5>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th width="200">Nomor Pengajuan</th>
                                            <td>{{ $requestLetter->code }}</td>
                                        </tr>
                                        <tr>
                                            <th>Jenis Pengajuan</th>
                                            <td>{{ $requestLetter->requestType->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>
                                                <span class="badge bg-{{ $requestLetter->status == 'Diajukan' ? 'warning' : ($requestLetter->status == 'Diproses' ? 'info' : ($requestLetter->status == 'Selesai' ? 'success' : 'danger')) }}">
                                                    {{ $requestLetter->status }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Pengajuan</th>
                                            <td>{{ date('d-m-Y H:i', strtotime($requestLetter->created_at)) }}</td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="mb-4">
                                    <h5>Data Pemohon</h5>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th width="200">Nama</th>
                                            <td>{{ $requestLetter->user->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>NIK</th>
                                            <td>{{ $requestLetter->user->resident->nik }}</td>
                                        </tr>
                                        <tr>
                                            <th>Alamat</th>
                                            <td>{{ $requestLetter->user->resident->address }}</td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="mb-4">
                                    <h5>Data Pengajuan</h5>
                                    <table class="table table-bordered">
                                        @php
                                            $exclude = ['request_type_id', 'village_head', 'village_head_position'];
                                        @endphp
                                        @foreach(json_decode($requestLetter->data) as $key => $value)
                                            @if(!in_array($key, $exclude))
                                                <tr>
                                                    <th width="200">{{ __('request-letter.' . $key) }}</th>
                                                    <td>{{ $value }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </table>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-4">
                                    <h5>Dokumen Lampiran</h5>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Dokumen</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($requestLetter->documentRequestLetters as $index => $document)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $document->name }}</td>
                                                    <td>
                                                        <a href="{{ asset('storage/' . $document->url) }}" target="_blank" class="btn btn-sm btn-info">
                                                            <i class="fas fa-eye"></i> Lihat
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h5>Riwayat Status</h5>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Tanggal</th>
                                                    <th>Status</th>
                                                    <th>Catatan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($requestLetter->historyRequestLetters as $history)
                                                <tr>
                                                    <td>{{ date('d-m-Y H:i', strtotime($history->created_at)) }}</td>
                                                    <td>
                                                        <span class="badge bg-{{ $history->status == 'Diajukan' ? 'warning' : ($history->status == 'Diproses' ? 'info' : ($history->status == 'Selesai' ? 'success' : 'danger')) }}">
                                                            {{ $history->status }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $history->notes ?? '-' }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                @if($requestLetter->status == 'Diajukan')
                                <div class="mb-4">
                                    <h5>Verifikasi Pengajuan</h5>
                                    <form action="{{ route('verifikasi-operator.update', $requestLetter->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group mb-3">
                                            <label for="status">Status</label>
                                            <select name="status" id="status" class="form-control" required>
                                                <option value="Diproses">Diproses</option>
                                                <option value="Ditolak">Ditolak</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="notes">Catatan</label>
                                            <textarea name="notes" id="notes" class="form-control" rows="3"></textarea>
                                        </div>
                                        <div class="form-group text-end">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="alert alert-danger">
                            Data pengajuan tidak ditemukan
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection