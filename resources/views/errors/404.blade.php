@extends('layouts.app')

@section('title', 'Halaman Tidak Ditemukan')

@section('content')
<h2>Error 404 - Halaman Tidak Ditemukan</h2>
<p>Oops! Halaman yang kamu cari tidak tersedia.</p>
<a href="{{ url('/') }}">Kembali ke Beranda</a>
@endsection
