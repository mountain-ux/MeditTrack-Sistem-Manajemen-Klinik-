@extends('layouts.app')

@section('title', 'Edit Pengguna')

@section('content')
<h2 class="mb-4 fw-semibold">Edit Pengguna</h2>

<div class="card shadow-sm">
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

        <form action="{{ route('pengguna.update', $pengguna->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" value="{{ $pengguna->nama }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $pengguna->email }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Peran</label>
                <select name="peran" class="form-select" required>
                    <option value="Admin" {{ $pengguna->peran === 'Admin' ? 'selected' : '' }}>Admin</option>
                    <option value="Dokter" {{ $pengguna->peran === 'Dokter' ? 'selected' : '' }}>Dokter</option>
                    <option value="Pasien" {{ $pengguna->peran === 'Pasien' ? 'selected' : '' }}>Pasien</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Perbarui</button>
            <a href="{{ route('pengguna.index') }}" class="btn btn-secondary ms-2">Batal</a>
        </form>
    </div>
</div>
@endsection
