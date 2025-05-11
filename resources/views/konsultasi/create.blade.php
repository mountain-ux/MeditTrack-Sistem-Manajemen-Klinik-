@extends('layouts.app')

@section('title', 'Buat Konsultasi')

@section('content')
<div class="container">
    <h2>Buat Jadwal Konsultasi</h2>
    <form action="{{ route('konsultasi.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="dokter_id" class="form-label">Pilih Dokter</label>
            <select name="dokter_id" id="dokter_id" class="form-select">
                @foreach ($dokter as $d)
                    <option value="{{ $d->id }}">{{ $d->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal Konsultasi</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="keluhan" class="form-label">Keluhan</label>
            <textarea name="keluhan" id="keluhan" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Buat Konsultasi</button>
    </form>
</div>
@endsection
