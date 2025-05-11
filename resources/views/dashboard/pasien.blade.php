@extends('layouts.app')

@section('title', 'Dashboard Pasien')

@section('content')
<div class="container">
    <h2>Dashboard Pasien</h2>

    <h4>Riwayat Konsultasi</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Dokter</th>
                <th>Tanggal Konsultasi</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Dr. Ahmad</td>
                <td>08 Mei 2025</td>
                <td>Selesai</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
