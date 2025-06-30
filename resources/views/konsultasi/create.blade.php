@extends('layouts.app')

@section('title', 'Ajukan Konsultasi')

@section('content')
<h2 class="mb-4 fw-semibold">Ajukan Konsultasi</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('konsultasi.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Pilih Dokter</label>
                <select name="id_dokter" class="form-select" required>
                    <option value="">-- Pilih Dokter --</option>
                    @foreach ($dokter as $d)
                        <option value="{{ $d->id }}">{{ $d->pengguna->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal & Waktu Konsultasi</label>
                <input type="datetime-local" name="tanggal_konsultasi" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Keluhan</label>
                <textarea name="keluhan" rows="4" class="form-control" required></textarea>
            </div>

            <button type="submit" class="btn btn-success">Ajuka</button>
            <a href="{{ route('konsultasi.index') }}" class="btn btn-secondary ms-2">Batal</a>
        </form>
    </div>
</div>
@endsection
