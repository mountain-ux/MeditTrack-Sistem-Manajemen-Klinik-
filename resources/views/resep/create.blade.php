@extends('layouts.app')

@section('title', 'Buat Resep Obat')

@section('content')
<h2 class="mb-4 fw-semibold">Buat Resep Obat</h2>

<div class="card shadow-sm">
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif

        <form action="{{ route('resep.store') }}" method="POST">
            @csrf

            {{-- Jadwal Konsultasi --}}
            <div class="mb-3">
                <label class="form-label">Jadwal Konsultasi</label>
                <select name="id_jadwal_konsultasi" class="form-select" required>
                    <option value="">-- Pilih Jadwal --</option>
                    @foreach ($jadwal as $j)
                        <option value="{{ $j->id }}">
                            {{ $j->pasien->nama ?? 'Pasien' }} - {{ \Carbon\Carbon::parse($j->tanggal_konsultasi)->translatedFormat('d F Y H:i') }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Pilih Pasien --}}
            <div class="mb-3">
                <label class="form-label">Pasien</label>
                <select name="id_pasien" class="form-select" required>
                    <option value="">-- Pilih Pasien --</option>
                    @foreach ($pasien as $p)
                        <option value="{{ $p->id }}">{{ $p->nama }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Pilih Obat --}}
            <div class="mb-3">
                <label class="form-label">Obat</label>
                <select name="detail_obat" class="form-select" required>
                    <option value="">-- Pilih Obat --</option>
                    @foreach ($obat as $o)
                        <option value="{{ $o->nama }}">{{ $o->nama }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('resep.index') }}" class="btn btn-secondary ms-2">Batal</a>
        </form>
    </div>
</div>
@endsection
