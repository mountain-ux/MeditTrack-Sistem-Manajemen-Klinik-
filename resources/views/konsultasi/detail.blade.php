@extends('layouts.app')

@section('title', 'Detail Konsultasi')

@section('content')
<div class="container">
    <h2>Detail Konsultasi</h2>
    <p><strong>Dokter:</strong> {{ $konsultasi->dokter->nama }}</p>
    <p><strong>Pasien:</strong> {{ $konsultasi->pasien->nama }}</p>
    <p><strong>Tanggal:</strong> {{ $konsultasi->tanggal }}</p>
    <p><strong>Status:</strong> {{ $konsultasi->status }}</p>
    <p><strong>Keluhan:</strong> {{ $konsultasi->keluhan }}</p>

    @if(Auth::user()->peran === 'Dokter' && $konsultasi->status === 'Menunggu')
        <form action="{{ route('konsultasi.update', $konsultasi->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="hasil_pemeriksaan" class="form-label">Hasil Pemeriksaan</label>
                <textarea name="hasil_pemeriksaan" id="hasil_pemeriksaan" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Hasil Konsultasi</button>
        </form>
    @endif
</div>
@endsection
