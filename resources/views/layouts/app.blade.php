<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Minha Aplicação')</title>
    <!-- Links para os arquivos CSS do Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Link para o seu arquivo CSS personalizado -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    @include('includes._header')

    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- Scripts do Bootstrap e outros -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <!-- Seção de scripts -->
    @yield('scripts')
</body>
</html>
