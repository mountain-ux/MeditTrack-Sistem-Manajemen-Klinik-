@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container">
    <h2>Dashboard Admin</h2>

    <div class="row mt-4">
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

    <h3>Tambah Dokter Baru</h3>
    <form action="{{ route('dokter.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Lengkap</label>
            <input type="text" name="nama" id="nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>

    <hr>

    <h3>Data Pengguna</h3>
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
                    <a href="#" class="btn btn-warning">Edit</a>
                    @if($user->peran === 'Dokter')
                        <form action="{{ route('dokter.hapus', $user->id) }}" method="POST" style="display:inline;">
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
