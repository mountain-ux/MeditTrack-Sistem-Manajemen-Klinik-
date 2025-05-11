@extends('layouts.app')

@section('title', 'Daftar Transaksi')

@section('content')
<div class="container">
    <h2>Daftar Transaksi</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Pasien</th>
                <th>Obat</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksi as $t)
            <tr>
                <td>{{ $t->pasien->nama }}</td>
                <td>{{ $t->obat->nama }}</td>
                <td>{{ $t->jumlah }}</td>
                <td>Rp {{ number_format($t->total_harga, 0, ',', '.') }}</td>
                <td>{{ $t->tanggal_transaksi }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
