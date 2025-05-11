@extends('layouts.app')

@section('title', 'Daftar Pengguna')

@section('content')
<div class="container">
    <h2>Daftar Pengguna</h2>
    <a href="{{ route('pengguna.create') }}" class="btn btn-success mb-3">Tambah Dokter</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Peran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengguna as $user)
            <tr>
                <td>{{ $user->nama }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->peran }}</td>
                <td>
                    <a href="{{ route('pengguna.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('pengguna.delete', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
