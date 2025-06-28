@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<h2 class="mb-4 fw-semibold">Dashboard Admin</h2>

{{-- Ringkasan --}}
<div class="row">
    <div class="col-md-4">
        <div class="card border-0 bg-success text-white shadow-sm">
            <div class="card-body text-center">
                <h5 class="fw-normal">Total Pengguna</h5>
                <h2 class="fw-bold">{{ $totalPengguna }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 bg-primary text-white shadow-sm">
            <div class="card-body text-center">
                <h5 class="fw-normal">Total Dokter</h5>
                <h2 class="fw-bold">{{ $totalDokter }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 bg-danger text-white shadow-sm">
            <div class="card-body text-center">
                <h5 class="fw-normal">Total Konsultasi</h5>
                <h2 class="fw-bold">{{ $totalKonsultasi }}</h2>
            </div>
        </div>
    </div>
</div>

<hr class="my-4">

{{-- Form Tambah Dokter --}}
<div class="card mb-4 shadow-sm">
    <div class="card-header bg-light">
        <h5 class="mb-0">Tambah Dokter Baru</h5>
    </div>
    <div class="card-body">
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
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Spesialisasi</label>
                    <input type="text" name="spesialisasi" class="form-control" value="{{ old('spesialisasi') }}" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">No. Telepon</label>
                    <input type="text" name="telepon" class="form-control" value="{{ old('telepon') }}" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Jadwal Praktik</label>
                    <input type="text" name="jadwal_praktik" class="form-control" value="{{ old('jadwal_praktik') }}" required>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
</div>

{{-- Tabel Pengguna --}}
<div class="card shadow-sm">
    <div class="card-header bg-light">
        <h5 class="mb-0">Data Pengguna</h5>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered align-middle table-hover">
            <thead class="table-light">
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Peran</th>
                    <th style="width: 160px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pengguna as $user)
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
                        @if($user->peran === 'Dokter')
                            <form action="{{ route('dokter.hapus', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin ingin menghapus dokter ini?')" type="submit" class="btn btn-sm btn-danger">
                                    Hapus
                                </button>
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
</div>
@endsection
