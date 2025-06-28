@extends('layouts.app')

@section('title', 'Detail Konsultasi')

@section('content')
<h2 class="mb-4 fw-semibold">Detail Konsultasi</h2>

<div class="card shadow-sm">
    <div class="card-body">

        {{-- Informasi Konsultasi --}}
        <div class="mb-3">
            <label class="form-label fw-bold">Pasien:</label>
            <p>{{ $konsultasi->pasien->nama ?? '-' }}</p>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Dokter:</label>
            <p>{{ $konsultasi->dokter->pengguna->nama ?? '-' }}</p>
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
                    @default <span class="badge bg-secondary">{{ $konsultasi->status }}</span>
                @endswitch
            </p>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Keluhan:</label>
            <p>{{ $konsultasi->keluhan }}</p>
        </div>

        {{-- Form Dokter untuk mengubah status --}}
        @if(Auth::user()->peran === 'Dokter' && $konsultasi->status !== 'Selesai')
            <hr>
            <form action="{{ route('konsultasi.update', $konsultasi->id) }}" method="POST" class="mb-4">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Ubah Status Konsultasi</label>
                    <select name="status" class="form-select" required>
                        <option value="Dikonfirmasi" {{ $konsultasi->status == 'Dikonfirmasi' ? 'selected' : '' }}>Dikonfirmasi</option>
                        <option value="Dijadwalkan" {{ $konsultasi->status == 'Dijadwalkan' ? 'selected' : '' }}>Dijadwalkan</option>
                        <option value="Selesai">Selesai</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Update Status</button>
            </form>

            {{-- Jika ingin langsung selesaikan dengan catatan diagnosa --}}
            <form action="{{ route('konsultasi.selesai', $konsultasi->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="catatan" class="form-label">Catatan Diagnosa</label>
                    <textarea name="catatan" id="catatan" rows="4" class="form-control" required>{{ old('catatan') }}</textarea>
                </div>
                <button type="submit" class="btn btn-success">Tandai Selesai</button>
            </form>
        @elseif($konsultasi->status === 'Selesai' && $konsultasi->catatan)
            <div class="mt-4">
                <label class="form-label fw-bold">Catatan Diagnosa:</label>
                <div class="alert alert-secondary">{{ $konsultasi->catatan }}</div>
            </div>
        @endif

        <a href="{{ route('konsultasi.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
</div>
@endsection
