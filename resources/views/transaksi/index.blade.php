@extends('layouts.app')

@section('title', 'Riwayat Transaksi')

@section('content')
<h2 class="mb-4 fw-semibold">Riwayat Transaksi</h2>

<div class="card shadow-sm">
    <div class="card-body table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Tanggal</th>
                    <th>Obat</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transaksi as $t)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($t->created_at)->translatedFormat('d M Y H:i') }}</td>
                    <td>{{ $t->obat->nama ?? '-' }}</td>
                    <td>{{ $t->jumlah }}</td>
                    <td>Rp {{ number_format($t->total, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center">Belum ada transaksi.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
