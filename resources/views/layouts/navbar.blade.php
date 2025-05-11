@php
    use Illuminate\Support\Facades\Auth;
@endphp

<nav class="navbar navbar-expand-lg" style="background-color: #007bff;">
    <div class="container-fluid">
        <a class="navbar-brand text-white" href="{{ route('dashboard') }}">MediTrack</a>

        @auth
        <div class="dropdown ms-auto">
            <button class="btn btn-light dropdown-toggle d-flex align-items-center" type="button" data-bs-toggle="dropdown">
                <img src="{{ asset('img/user.png') }}" alt="User" width="30" class="rounded-circle me-2">
                <span>{{ Auth::user()->name ?? 'User' }}</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                {{-- Menu Akun --}}
                @if(Auth::user()->role === 'Admin')
                    <li><a class="dropdown-item" href="{{ route('pengguna.edit', Auth::id()) }}">Informasi Akun</a></li>
                @else
                    <li><a class="dropdown-item disabled" href="#">Informasi Akun</a></li>
                @endif

                <li><hr class="dropdown-divider"></li>

                {{-- Logout --}}
                <li>
                    <form action="{{ route('auth.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
        @endauth
    </div>
</nav>
