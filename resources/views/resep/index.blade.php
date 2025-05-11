@extends('layouts.app')

@section('title', 'Daftar Resep Obat')

@section('content')
<div class="container">
    <h2>Daftar Resep Obat</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Pasien</th>
                <th>Dokter</th>
                <th>Detail Obat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($resep as $r)
            <tr>
                <td>{{ $r->pasien->nama }}</td>
                <td>{{ $r->dokter->nama }}</td>
                <td>{{ $r->detail_obat }}</td>
                <td>
                    @if(Auth::user()->peran === 'Dokter')
                        <a href="{{ route('resep.edit', $r->id) }}" class="btn btn-warning">Ubah</a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
