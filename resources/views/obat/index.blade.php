@extends('layouts.app')

@section('title', 'Daftar Obat')

@section('content')
<div class="container">
    <h2>Daftar Obat</h2>

    @if(Auth::user()->peran === 'Admin')
        <a href="{{ route('obat.create') }}" class="btn btn-success mb-3">Tambah Obat</a>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Stok</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($obat as $o)
            <tr>
                <td>{{ $o->nama }}</td>
                <td>{{ $o->deskripsi }}</td>
                <td>{{ $o->stok }}</td>
                <td>Rp {{ number_format($o->harga, 0, ',', '.') }}</td>
                <td>
                    <a href="{{ route('obat.edit', $o->id) }}" class="btn btn-warning">Ubah</a>
                    @if(Auth::user()->peran === 'Admin')
                        <form action="{{ route('obat.delete', $o->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
