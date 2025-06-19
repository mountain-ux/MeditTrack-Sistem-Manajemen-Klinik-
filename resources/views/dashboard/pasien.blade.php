@extends('layouts.app')

@section('title', 'Dashboard Pasien')

@section('content')
    <h2 class="mb-4 fw-semibold">Dashboard Pasien</h2>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Riwayat Konsultasi</h5>
        @if (Auth::user()->peran === 'Pasien')
            <a href="{{ route('konsultasi.create') }}" class="btn btn-sm btn-success">Ajukan Konsultasi</a>
        @endif

    </div>

    @if ($konsultasi->isEmpty())
        <div class="alert alert-info">Belum ada riwayat konsultasi.</div>
    @else
        <div class="card shadow-sm">
            <div class="card-body table-responsive">
                <table class="table table-bordered align-middle table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Dokter</th>
                            <th>Tanggal</th>
                            <th>Keluhan</th>
                            <th>Status</th>
                            <th>Catatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($konsultasi as $item)
                            <tr>
                                <td>{{ $item->dokter->nama ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal_konsultasi)->translatedFormat('d F Y, H:i') }}
                                </td>
                                <td>{{ $item->keluhan }}</td>
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

                                        @case('Batal')
                                            <span class="badge bg-danger">Batal</span>
                                        @break

                                        @default
                                            <span class="badge bg-secondary">Menunggu</span>
                                    @endswitch
                                </td>
                                <td>
                                    @if ($item->status === 'Selesai')
                                        <span
                                            class="text-muted small">{{ \Illuminate\Support\Str::limit($item->catatan, 40) }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('konsultasi.detail', $item->id) }}"
                                        class="btn btn-sm btn-outline-primary">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection
