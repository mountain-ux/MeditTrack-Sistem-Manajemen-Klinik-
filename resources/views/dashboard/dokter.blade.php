@extends('layouts.app')

@section('title', 'Dashboard Dokter')

@section('content')
<div class="container">
    <h2 class="mb-4">Dashboard Dokter</h2>

    <h4>Jadwal Konsultasi</h4>
    @if($jadwalKonsultasi->count())
    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>Pasien</th>
                <th>Tanggal Konsultasi</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jadwalKonsultasi as $konsultasi)
            <tr>
                <td>{{ $konsultasi->pasien->nama ?? 'N/A' }}</td>
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
    @else
        <div class="alert alert-info">Belum ada jadwal konsultasi.</div>
    @endif
</div>
@endsection
