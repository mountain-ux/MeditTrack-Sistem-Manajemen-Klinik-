@extends('layouts.app')

@section('title', 'Edit Resep Obat')

@section('content')
<div class="container">
    <h2>Edit Resep Obat</h2>
    <form action="{{ route('resep.update', $resep->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="detail_obat" class="form-label">Detail Obat</label>
            <textarea name="detail_obat" id="detail_obat" class="form-control" required>{{ $resep->detail_obat }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
@endsection
