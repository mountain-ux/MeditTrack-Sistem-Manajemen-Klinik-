@php
    use Illuminate\Support\Facades\Auth;
    $user = Auth::user();
@endphp

<aside class="left-sidebar">
    <div>
        <div class="scroll-sidebar">
            <nav class="sidebar-nav">
                <ul id="sidebarnav" class="pt-3">
                    {{-- Menu Utama --}}
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('dashboard') }}">
                            <i class="ti ti-layout-dashboard"></i>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>

                    {{-- Pasien & Dokter --}}
                    @if(in_array($user->peran, ['Pasien', 'Dokter']))
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('konsultasi.index') }}">
                            <i class="ti ti-stethoscope"></i>
                            <span class="hide-menu">Konsultasi</span>
                        </a>
                    </li>
                    @endif

                    {{-- Pasien --}}
                    @if($user->peran === 'Pasien')
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('transaksi.index') }}">
                            <i class="ti ti-credit-card"></i>
                            <span class="hide-menu">Transaksi</span>
                        </a>
                    </li>
                    @endif

                    {{-- Dokter --}}
                    @if($user->peran === 'Dokter')
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('resep.index') }}">
                            <i class="ti ti-notes"></i>
                            <span class="hide-menu">Resep</span>
                        </a>
                    </li>
                    @endif

                    {{-- Admin --}}
                    @if($user->peran === 'Admin')
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('pengguna.index') }}">
                            <i class="ti ti-users"></i>
                            <span class="hide-menu">Pengguna</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('obat.index') }}">
                            <i class="ti ti-capsule"></i>
                            <span class="hide-menu">Obat</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('resep.index') }}">
                            <i class="ti ti-file-description"></i>
                            <span class="hide-menu">Data Resep</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
</aside>
