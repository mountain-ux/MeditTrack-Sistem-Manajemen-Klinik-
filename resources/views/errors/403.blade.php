@extends('layouts.app')

@section('title', 'Akses Ditolak')

@section('content')
<h2>Error 403 - Akses Ditolak</h2>
<p>Maaf, kamu tidak memiliki akses ke halaman ini.</p>
<a href="{{ url('/') }}">Kembali ke Beranda</a>
@endsection
