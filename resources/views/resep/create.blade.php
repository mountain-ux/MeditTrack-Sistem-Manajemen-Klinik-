@extends('layouts.app')

@section('title', 'Tambah Resep Obat')

@section('content')
<div class="container">
    <h2>Tambah Resep Obat</h2>
    <form action="{{ route('resep.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="id_pasien" class="form-label">Pilih Pasien</label>
            <select name="id_pasien" id="id_pasien" class="form-select">
                @foreach ($pasien as $p)
                    <option value="{{ $p->id }}">{{ $p->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="id_jadwal_konsultasi" class="form-label">Pilih Jadwal Konsultasi</label>
            <select name="id_jadwal_konsultasi" id="id_jadwal_konsultasi" class="form-select">
                @foreach ($jadwal as $j)
                    <option value="{{ $j->id }}"> {{ $j->tanggal_konsultasi }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="detail_obat" class="form-label">Detail Obat</label>
            <textarea name="detail_obat" id="detail_obat" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
