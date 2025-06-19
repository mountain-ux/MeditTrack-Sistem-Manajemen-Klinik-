@extends('layouts.app')

@section('title', 'Buat Transaksi')

@section('content')
<h2 class="mb-4 fw-semibold">Buat Transaksi Obat</h2>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('transaksi.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Obat</label>
                <select name="obat_id" class="form-select" required>
                    <option value="">-- Pilih Obat --</option>
                    @foreach ($obat as $o)
                        <option value="{{ $o->id }}">{{ $o->nama }} (Stok: {{ $o->stok }})</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Jumlah</label>
                <input type="number" name="jumlah" class="form-control" min="1" required>
            </div>
            <button type="submit" class="btn btn-success">Bayar</button>
            <a href="{{ route('transaksi.index') }}" class="btn btn-secondary ms-2">Batal</a>
        </form>
    </div>
</div>
@endsection
