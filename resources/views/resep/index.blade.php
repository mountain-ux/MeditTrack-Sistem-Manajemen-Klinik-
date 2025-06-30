@extends('layouts.app')

@section('title', 'Data Resep Obat')

@section('content')
<h2 class="mb-4 fw-semibold">Data Resep Obat</h2>

@auth
    @if (Auth::user()->peran === 'Dokter')
<a href="{{ route('resep.create') }}" class="btn btn-success mb-3">+ Buat Resep</a>
  @endif
@endauth

<div class="card shadow-sm">
    <div class="card-body table-responsive">
        <table class="table table-bordered align-middle table-hover">
            <thead class="table-light">
                <tr>
                    <th>Pasien</th>
                    <th>Obat</th>
                   
                    <th style="width: 120px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($resep as $item)
                <tr>
                    <td>{{ $item->jadwalKonsultasi->pasien->pengguna->nama ?? '-' }}</td>
                    <td>{{ $item->detail_obat }}</td>
                    
                    <td>
                        <a href="{{ route('resep.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center">Belum ada resep.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
