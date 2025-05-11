@php
    use Illuminate\Support\Facades\Auth;
    $user = Auth::user(); // Tetap menggunakan Auth untuk mendapatkan data pengguna yang login.
@endphp

<div class="vh-100 p-3" style="width: 250px; background-color: #f8f9fa; border-right: 1px solid #ddd;">
    <h5 class="text-dark">Menu</h5>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link text-dark" href="{{ route('dashboard') }}">Dashboard</a>
        </li>

        {{-- Pasien & Dokter dapat akses Konsultasi --}}
        @if(in_array($user->peran, ['Pasien', 'Dokter']))
        <li class="nav-item">
            <a class="nav-link text-dark" href="{{ route('konsultasi.index') }}">Konsultasi</a>
        </li>
        @endif

        {{-- Pasien saja: Transaksi --}}
        @if($user->peran === 'Pasien')
        <li class="nav-item">
            <a class="nav-link text-dark" href="{{ route('transaksi.index') }}">Transaksi</a>
        </li>
        @endif

        {{-- Dokter saja: Resep --}}
        @if($user->peran === 'Dokter')
        <li class="nav-item">
            <a class="nav-link text-dark" href="{{ route('resep.index') }}">Resep</a>
        </li>
        @endif

        {{-- Admin: Manajemen Pengguna, Obat, Dokter --}}
        @if($user->peran === 'Admin')
        <li class="nav-item">
            <a class="nav-link text-dark" href="{{ route('pengguna.index') }}">Pengguna</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-dark" href="{{ route('obat.index') }}">Obat</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-dark" href="{{ route('resep.index') }}">Data Resep</a>
        </li>
        @endif
    </ul>
</div>
