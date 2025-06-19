<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - MEDITRACK</title>

    <!-- Flexy CSS -->
    <link rel="stylesheet" href="{{ asset('flexy/assets/css/styles.min.css') }}">
    <style>
        body {
            background-color: #f0f2f5;
        }
        .auth-box {
            width: 100%;
            max-width: 400px;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="d-flex justify-content-center align-items-center vh-100">
        @yield('content')
    </div>

    <!-- Flexy JS -->
    <script src="{{ asset('flexy/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('flexy/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('flexy/assets/js/app.min.js') }}"></script>
</body>
</html>
