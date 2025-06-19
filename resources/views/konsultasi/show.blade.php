@extends('layouts.app')

@section('title', 'Detail Konsultasi')

@section('content')
<h2 class="mb-4 fw-semibold">Detail Konsultasi</h2>

<div class="card shadow-sm">
    <div class="card-body">

        <div class="mb-3">
            <label class="form-label fw-bold">Dokter:</label>
            <p>{{ $konsultasi->dokter->nama ?? '-' }}</p>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Tanggal Konsultasi:</label>
            <p>{{ \Carbon\Carbon::parse($konsultasi->tanggal_konsultasi)->translatedFormat('d F Y, H:i') }}</p>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Status:</label>
            <p>
                @switch($konsultasi->status)
                    @case('Dijadwalkan') <span class="badge bg-warning text-dark">Dijadwalkan</span> @break
                    @case('Dikonfirmasi') <span class="badge bg-info text-dark">Dikonfirmasi</span> @break
                    @case('Selesai') <span class="badge bg-success">Selesai</span> @break
                    @default <span class="badge bg-secondary">-</span>
                @endswitch
            </p>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Keluhan:</label>
            <p>{{ $konsultasi->keluhan }}</p>
        </div>

        @if($konsultasi->catatan)
        <div class="mb-3">
            <label class="form-label fw-bold">Catatan Dokter:</label>
            <div class="alert alert-secondary">{{ $konsultasi->catatan }}</div>
        </div>
        @endif

        <a href="{{ route('konsultasi.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection
