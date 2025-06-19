<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - MEDITRACK</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Flexy Admin CSS -->
    <link rel="stylesheet" href="{{ asset('flexy/assets/css/styles.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    @stack('styles')
</head>

<body>
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">

        @include('layouts.navbar')
        @include('layouts.sidebar')

        <div class="body-wrapper">
            <div class="container-fluid py-4">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @yield('content')
            </div>
            @include('layouts.footer')
        </div>
    </div>

    <!-- Flexy JS -->
    <script src="{{ asset('flexy/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('flexy/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('flexy/assets/js/app.min.js') }}"></script>
    <script src="{{ asset('flexy/assets/js/app.init.js') }}"></script>

    @stack('scripts')
</body>

</html>
