@extends('layouts.app')

@section('title', 'Data Pengguna')

@section('content')
<h2 class="mb-4 fw-semibold">Data Pengguna</h2>

<a href="{{ route('pengguna.create') }}" class="btn btn-success mb-3">+ Tambah Pengguna</a>

<div class="card shadow-sm">
    <div class="card-body table-responsive">
        <table class="table table-bordered align-middle table-hover">
            <thead class="table-light">
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Peran</th>
                    <th style="width: 140px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengguna as $user)
                <tr>
                    <td>{{ $user->nama }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <span class="badge bg-{{ $user->peran === 'Admin' ? 'secondary' : ($user->peran === 'Dokter' ? 'info text-dark' : 'warning text-dark') }}">
                            {{ $user->peran }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('pengguna.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('pengguna.destroy', $user->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Yakin hapus?')" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center">Belum ada pengguna.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
