@extends('layouts.app')

@section('title', 'Daftar Konsultasi')

@section('content')
<div class="container">
    <h2>Jadwal Konsultasi</h2>

    @if(Auth::user()->peran === 'Pasien')
        <a href="{{ route('konsultasi.create') }}" class="btn btn-success mb-3">Buat Konsultasi Baru</a>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Dokter</th>
                <th>Pasien</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($konsultasi as $k)
            <tr>
                <td>{{ $k->dokter->nama }}</td>
                <td>{{ $k->pasien->nama }}</td>
                <td>{{ $k->tanggal }}</td>
                <td>{{ $k->status }}</td>
                <td>
                    <a href="{{ route('konsultasi.detail', $k->id) }}" class="btn btn-info">Detail</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
