<nav class="navbar navbar-expand-lg" style="background-color: #007bff;">
    <div class="container-fluid">
        <a class="navbar-brand text-white" href="{{ route('dashboard') }}">MediTrack</a>

        <div class="dropdown ms-auto">
            <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                <img src="{{ asset('img/user.png') }}" alt="User" width="30" class="rounded-circle">
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="{{ route('pengguna.edit', Auth::id()) }}">Informasi Akun</a></li>
                <li>
                    <form action="{{ route('auth.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
