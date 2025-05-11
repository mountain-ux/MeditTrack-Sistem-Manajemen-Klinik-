@extends('layouts.app')

@section('title', 'Dashboard Pasien')

@section('content')
<div class="container">
    <h2>Dashboard Pasien</h2>

    <h4 class="mt-4">Riwayat Konsultasi</h4>

    @if($konsultasi->isEmpty())
        <div class="alert alert-info">Belum ada riwayat konsultasi.</div>
    @else
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Dokter</th>
                    <th>Tanggal Konsultasi</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($konsultasi as $item)
                    <tr>
                        <td>{{ $item->dokter->nama ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_konsultasi)->translatedFormat('d F Y') }}</td>
                        <td>
                            @if($item->status === 'Selesai')
                                <span class="badge bg-success">Selesai</span>
                            @elseif($item->status === 'Dikonfirmasi')
                                <span class="badge bg-primary">Dikonfirmasi</span>
                            @else
                                <span class="badge bg-secondary">{{ $item->status ?? 'Menunggu' }}</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
