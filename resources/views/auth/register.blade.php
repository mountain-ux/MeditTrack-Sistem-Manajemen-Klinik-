@extends('layouts.auth')

@section('title', 'Register')

@section('content')
<div class="auth-box">
    <h3 class="text-center mb-4">Buat Akun Baru</h3>
    <form action="{{ route('auth.register') }}" method="POST">
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

        <button type="submit" class="btn btn-success w-100">Daftar</button>
    </form>

    <p class="text-center mt-3">
        Sudah punya akun? <a href="{{ route('auth.login') }}">Login</a>
    </p>
</div>
@endsection
