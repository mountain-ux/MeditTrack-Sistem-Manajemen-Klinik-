@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container">
    <h2 class="mb-4">Dashboard Admin</h2>

    {{-- Ringkasan --}}
    <div class="row">
        <div class="col-md-4">
            <div class="card bg-success text-white text-center p-3">
                <h5>Total Pengguna</h5>
                <h3>{{ $totalPengguna }}</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-primary text-white text-center p-3">
                <h5>Total Dokter</h5>
                <h3>{{ $totalDokter }}</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-danger text-white text-center p-3">
                <h5>Total Konsultasi</h5>
                <h3>{{ $totalKonsultasi }}</h3>
            </div>
        </div>
    </div>

    <hr>

    {{-- Form Tambah Dokter --}}
    <h3 class="mt-4">Tambah Dokter Baru</h3>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('dokter.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Lengkap</label>
            <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama') }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>

    <hr>

    {{-- Tabel Pengguna --}}
    <h3 class="mt-4">Data Pengguna</h3>
    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Peran</th>
                <th width="160">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pengguna as $user)
            <tr>
                <td>{{ $user->nama }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if($user->peran === 'Admin')
                        <span class="badge bg-secondary">Admin</span>
                    @elseif($user->peran === 'Dokter')
                        <span class="badge bg-info text-dark">Dokter</span>
                    @else
                        <span class="badge bg-warning text-dark">Pasien</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('pengguna.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    @if($user->peran === 'Dokter')
                        <form action="{{ route('dokter.hapus', $user->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin ingin menghapus dokter ini?')" type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">Belum ada data pengguna.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
