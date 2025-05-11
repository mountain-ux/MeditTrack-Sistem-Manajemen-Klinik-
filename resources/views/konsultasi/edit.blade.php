@extends('layouts.app')

@section('title', 'Edit Jadwal Konsultasi')

@section('content')
<h2>Edit Jadwal Konsultasi</h2>

<form action="{{ route('konsultasi.update', $konsultasi->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Dokter:</label>
    <select name="dokter_id">
        @foreach($dokter as $d)
            <option value="{{ $d->id }}" {{ $konsultasi->dokter_id == $d->id ? 'selected' : '' }}>{{ $d->nama }}</option>
        @endforeach
    </select>

    <label>Pasien:</label>
    <select name="pasien_id">
        @foreach($pasien as $p)
            <option value="{{ $p->id }}" {{ $konsultasi->pasien_id == $p->id ? 'selected' : '' }}>{{ $p->nama }}</option>
        @endforeach
    </select>

    <label>Tanggal:</label>
    <input type="date" name="tanggal" value="{{ $konsultasi->tanggal }}" required>

    <label>Waktu:</label>
    <input type="time" name="waktu" value="{{ $konsultasi->waktu }}" required>

    <button type="submit">Simpan Perubahan</button>
</form>
@endsection
