<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Minha Aplicação')</title>
    <!-- Inclua os links para os arquivos CSS do Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        @yield('content')
    </div>
    <!-- Seção de scripts -->
    @yield('scripts')
</body>
</html>
