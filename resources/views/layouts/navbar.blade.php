@php
    use Illuminate\Support\Facades\Auth;
@endphp

<nav class="navbar navbar-expand-lg bg-white border-bottom shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold text-primary" href="{{ route('dashboard') }}">
            MediTrack
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarContent" aria-controls="navbarContent"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        @auth
        <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown"
                       role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('img/user.png') }}" alt="User" width="30" class="rounded-circle me-2">
                        <span>{{ Auth::user()->nama ?? 'User' }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        {{-- Menu Akun --}}
                        @if(Auth::user()->peran === 'Admin')
                            <li>
                                <a class="dropdown-item" href="{{ route('pengguna.edit', Auth::id()) }}">
                                    Informasi Akun
                                </a>
                            </li>
                        @else
                            <li>
                                <span class="dropdown-item text-muted">Informasi Akun</span>
                            </li>
                        @endif

                        <li><hr class="dropdown-divider"></li>

                        {{-- Logout --}}
                        <li>
                            <form action="{{ route('auth.logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        @endauth
    </div>
</nav>
