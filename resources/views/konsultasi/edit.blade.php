@extends('layouts.app')

@section('title', 'Edit Konsultasi')

@section('content')
    <h2 class="mb-4 fw-semibold">Edit Konsultasi</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('konsultasi.update', $konsultasi->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Pasien</label>
                    <input type="text" class="form-control" value="{{ $konsultasi->pasien->nama ?? '-' }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="dokter_id" class="form-label">Dokter</label>
                    <select name="dokter_id" id="dokter_id" class="form-select" required>
                        @foreach ($dokter as $d)
                            <option value="{{ $d->id }}" {{ $konsultasi->dokter_id == $d->id ? 'selected' : '' }}>
                                {{ $d->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="tanggal_konsultasi" class="form-label">Tanggal & Waktu</label>
                    <input type="datetime-local" name="tanggal_konsultasi" id="tanggal_konsultasi" class="form-control"
                        value="{{ \Carbon\Carbon::parse($konsultasi->tanggal_konsultasi)->format('Y-m-d\TH:i') }}" required>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="Menunggu" {{ $konsultasi->status === 'Menunggu' ? 'selected' : '' }}>
                            Dijadwalkan</option>
                        <option value="Dikonfirmasi" {{ $konsultasi->status === 'Dikonfirmasi' ? 'selected' : '' }}>
                            Dikonfirmasi</option>
                        <option value="Selesai" {{ $konsultasi->status === 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="keluhan" class="form-label">Keluhan</label>
                    <textarea name="keluhan" id="keluhan" rows="4" class="form-control" required>{{ $konsultasi->keluhan }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Perbarui</button>
                <a href="{{ route('konsultasi.index') }}" class="btn btn-secondary ms-2">Batal</a>
            </form>
        </div>
    </div>
@endsection
