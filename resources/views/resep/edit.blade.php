@extends('layouts.app')

@section('title', 'Edit Resep')

@section('content')
<h2 class="mb-4 fw-semibold">Edit Resep</h2>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('resep.update', $resep->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Jumlah</label>
                <input type="number" name="jumlah" value="{{ $resep->jumlah }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Keterangan</label>
                <textarea name="keterangan" class="form-control" rows="3">{{ $resep->keterangan }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Perbarui</button>
            <a href="{{ route('resep.index') }}" class="btn btn-secondary ms-2">Batal</a>
        </form>
    </div>
</div>
@endsection
