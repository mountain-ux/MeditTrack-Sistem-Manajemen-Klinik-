@extends('layouts.app')

@section('title', 'Dashboard Dokter')

@section('content')
<h2 class="mb-4 fw-semibold">Dashboard Dokter</h2>

<h5 class="mb-3">Jadwal Konsultasi</h5>

@if($konsultasi->count())
<div class="card shadow-sm">
    <div class="card-body table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Pasien</th>
                    <th>Tanggal Konsultasi</th>
                    <th>Status</th>
                    <th style="width: 100px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($konsultasi as $konsultasi)
                <tr>
                    <td>{{ $konsultasi->pasien->pengguna->nama ?? 'N/A' }}</td>
                    <td>{{ \Carbon\Carbon::parse($konsultasi->tanggal_konsultasi)->translatedFormat('d F Y, H:i') }}</td>
                    <td>
                        @switch($konsultasi->status)
                            @case('Dijadwalkan')
                                <span class="badge bg-warning text-dark">Dijadwalkan</span>
                                @break
                            @case('Dikonfirmasi')
                                <span class="badge bg-info text-dark">Dikonfirmasi</span>
                                @break
                            @case('Selesai')
                                <span class="badge bg-success">Selesai</span>
                                @break
                            @default
                                <span class="badge bg-secondary">Menunggu</span>
                        @endswitch
                    </td>
                    <td>
                        <a href="{{ route('konsultasi.detail', $konsultasi->id) }}" class="btn btn-sm btn-primary">Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@else
    <div class="alert alert-info">Belum ada jadwal konsultasi.</div>
@endif
@endsection
