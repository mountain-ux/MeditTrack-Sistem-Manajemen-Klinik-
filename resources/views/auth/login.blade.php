@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="auth-box">
    <h3 class="text-center mb-4">Login ke MediTrack</h3>
    <form action="{{ route('auth.login') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>

    <p class="text-center mt-3">
        Belum punya akun? <a href="{{ route('auth.register') }}">Daftar</a>
    </p>
</div>
@endsection
