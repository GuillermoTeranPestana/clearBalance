<!-- resources/views/movimientos/index.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movimientos de Cuentas - ClearBalance</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body>
    <div class="container">
        <h2>Movimientos de Cuentas</h2>
        
        <!-- Aquí es donde cargarás los gráficos -->
        <div class="chart-container">
            <!-- Reemplaza este comentario con el código para gráficos -->
            <p>Aquí se mostrarán los gráficos de movimientos.</p>
        </div>

        <!-- Enlace de regreso a la página principal -->
        <a href="{{ route('home') }}" class="button">Volver a la página principal</a>
    </div>
</body>
</html>