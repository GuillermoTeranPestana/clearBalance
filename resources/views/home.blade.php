<!-- resources/views/home.blade.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - ClearBalance</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
        @include('partials.banner')
    <div class="container">
        <h1>Bienvenido, {{ Auth::user()->username }}!</h1>
        <p>Has iniciado sesión correctamente.</p>
        
        <!-- Menú Horizontal -->
        <nav class="menu">
            <a href="{{ route('form.create') }}" class="button">Introducir Datos</a>
            <a href="{{ route('movimientos.index') }}" class="button">Ver Movimientos de Cuentas</a>
        </nav>
    </div>
</body>
</html>
