@extends('layouts.app')

@section('title', 'Data Konsultasi')

@section('content')
<h2 class="mb-4 fw-semibold">Data Konsultasi</h2>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card shadow-sm">
    <div class="card-body table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Pasien</th>
                    <th>Dokter</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th style="width: 120px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($konsultasi as $item)
                <tr>
                    <td>{{ $item->pasien->pengguna->nama ?? '-' }}</td>
                    <td>{{ $item->dokter->pengguna->nama ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_konsultasi)->translatedFormat('d F Y, H:i') }}</td>
                    <td>
                        @switch($item->status)
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
                        <a href="{{ route('konsultasi.detail', $item->id) }}" class="btn btn-sm btn-primary">Detail</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada data konsultasi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
