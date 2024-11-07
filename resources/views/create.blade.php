<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Crear Cuenta</title>
    <link rel="stylesheet" href="{{ asset('css/mix.css') }}">
</head>
<body>

     @include('partials.banner')
    <div class="container">
        <h1>Crear Cuenta</h1>

        <!-- Mostrar los mensajes de error de validación -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Si hay un mensaje de éxito o error general -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Formulario de creación de cuenta -->
        <form action="{{ route('cuentas.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="Nombre">Nombre de la Cuenta</label>
                <input type="text" name="Nombre" id="Nombre" class="form-control" value="{{ old('Nombre') }}" required>
            </div>

            <div class="form-group">
                <label for="TipoCuenta">Tipo de Cuenta</label>
                <select name="TipoCuenta" id="TipoCuenta" class="form-control">
                    <option value="ahorros" {{ old('TipoCuenta') == 'ahorros' ? 'selected' : '' }}>Ahorros</option>
                    <option value="corriente" {{ old('TipoCuenta') == 'corriente' ? 'selected' : '' }}>Corriente</option>
                    <option value="tarjeta de crédito" {{ old('TipoCuenta') == 'tarjeta de crédito' ? 'selected' : '' }}>Tarjeta de Crédito</option>
                    <option value="otro" {{ old('TipoCuenta') == 'otro' ? 'selected' : '' }}>Otro</option>
                </select>
            </div>

            <div class="form-group">
                <label for="Saldo">Saldo Inicial</label>
                <input type="number" name="Saldo" id="Saldo" class="form-control" value="{{ old('Saldo') }}" required>
            </div>

            <button type="submit" class="button">Crear Cuenta</button>
        </form>

         

    </div>
    <div class="container">
        <!-- Formulario para transacciones -->
        <h1>Registrar Transacción</h1>

            <!-- Mostrar los mensajes de error de validación para transacciones -->
        @if ($errors->has('CuentaID') || $errors->has('CategoriaID') || $errors->has('TipoTransaccion') || $errors->has('Monto'))
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    

         <!-- Formulario de creación de transacción -->
         <form action="{{ route('transacciones.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="CuentaID">Cuenta ID</label>
                <input type="text" name="CuentaID" id="CuentaID" class="form-control" value="{{ old('CuentaID') }}" required>
            </div>

            <div class="form-group">
                <label for="CategoriaID">Categoría de la Transacción</label>
                <input type="text" name="CategoriaID" id="CategoriaID" class="form-control" value="{{ old('CategoriaID') }}" required>
            </div>

            <div class="form-group">
                <label for="TipoTransaccion">Tipo de Transacción</label>
                <select name="TipoTransaccion" id="TipoTransaccion" class="form-control">
                    <option value="ingreso" {{ old('TipoTransaccion') == 'ingreso' ? 'selected' : '' }}>Ingreso</option>
                    <option value="gasto" {{ old('TipoTransaccion') == 'gasto' ? 'selected' : '' }}>Gasto</option>
                </select>
            </div>

            <div class="form-group">
                <label for="Monto">Monto</label>
                <input type="number" name="Monto" id="Monto" class="form-control" value="{{ old('Monto') }}" required>
            </div>

            <div class="form-group">
                <label for="Descripcion">Descripción</label>
                <input type="text" name="Descripcion" id="Descripcion" class="form-control" value="{{ old('Descripcion') }}">
            </div>

            <button type="submit" class="button">Registrar Transacción</button>
        </form>

    </div>
</body>
</html>