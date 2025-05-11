@extends('layouts.app')

@section('title', 'Dashboard Dokter')

@section('content')
<div class="container">
    <h2>Dashboard Dokter</h2>

    <h4>Jadwal Konsultasi</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Pasien</th>
                <th>Tanggal Konsultasi</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Jane Doe</td>
                <td>10 Mei 2025</td>
                <td>Dikonfirmasi</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
