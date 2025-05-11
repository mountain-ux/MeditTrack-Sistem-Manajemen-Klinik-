@extends('layouts.app')

@section('title', 'Detail Konsultasi')

@section('content')
<h2>Detail Konsultasi</h2>

<p><strong>Dokter:</strong> {{ $konsultasi->dokter->nama }}</p>
<p><strong>Pasien:</strong> {{ $konsultasi->pasien->nama }}</p>
<p><strong>Tanggal:</strong> {{ $konsultasi->tanggal }}</p>
<p><strong>Waktu:</strong> {{ $konsultasi->waktu }}</p>
<p><strong>Catatan Dokter:</strong> {{ $konsultasi->catatan }}</p>

<a href="{{ route('konsultasi.index') }}">Kembali ke Jadwal</a>
@endsection
