<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión - ClearBalance</title>
    <link rel="stylesheet" href="{{ asset('css/registro.css') }}">
</head>
<body>
    <div class="container">
        <h1 class="title">Iniciar Sesión</h1>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulario de inicio de sesión -->
        <form action="{{ route('login.submit') }}" method="POST" class="login-form">
            @csrf 
            <div class="form-group">
                <label for="username">Nombre de usuario</label>
                <input type="text" id="username" name="username" placeholder="Introduce tu usuario" required>
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" placeholder="Introduce tu contraseña" required>
            </div>

            <button type="submit" class="button">Iniciar sesión</button>
        </form>

        <p class="register-link">¿No tienes cuenta? <a href="{{ route('register.create') }}">Regístrate aquí</a></p>
        <p class="register-link"><a href="{{ url('/') }}" class="button">Página Principal</a></p>
    </div>

</body>
</html>