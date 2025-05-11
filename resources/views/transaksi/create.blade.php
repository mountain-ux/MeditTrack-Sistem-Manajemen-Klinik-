@extends('layouts.app')

@section('title', 'Tambah Transaksi')

@section('content')
<div class="container">
    <h2>Tambah Transaksi</h2>
    <form action="{{ route('transaksi.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="id_obat" class="form-label">Pilih Obat</label>
            <select name="id_obat" id="id_obat" class="form-select">
                @foreach ($obat as $o)
                    <option value="{{ $o->id }}" data-harga="{{ $o->harga }}">{{ $o->nama }} - Rp {{ number_format($o->harga, 0, ',', '.') }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" name="jumlah" id="jumlah" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="total_harga" class="form-label">Total Harga</label>
            <input type="text" name="total_harga" id="total_harga" class="form-control" readonly>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>

<script>
    document.getElementById('jumlah').addEventListener('input', function() {
        var jumlah = this.value;
        var hargaObat = document.getElementById('id_obat').selectedOptions[0].getAttribute('data-harga');
        document.getElementById('total_harga').value = jumlah * hargaObat;
    });
</script>
@endsection
