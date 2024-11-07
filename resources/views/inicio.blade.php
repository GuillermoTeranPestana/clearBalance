<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClearBalance</title>
    <!-- Enlazamos los estilos -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <!-- Contenedor principal centrado -->
    <div class="container">
        <!-- Logo principal dentro de un contenedor con borde dorado -->
        <div class="logo-container">
            <img src="{{ asset('images/logo.png') }}" alt="logo de ClearBalance" class="logo" />
        </div>
        
        <!-- Descripción breve de la página -->
        <p class="description">
            Simplifica y organiza tus finanzas con ClearBalance, la mejor herramienta de gestión financiera.
        </p>
        <p class="description">
            La solución perfecta para el control y gestión de tus finanzas personales.
        </p>
        
        <!-- Botones para ingresar o registrar -->
        <div class="button-group">
            <button class="button" onclick="window.location.href='/login'">Entrar</button>
            <a href="{{ route('register.create') }}" class="button">Registrarse</a>
        </div>

        <!-- Sección de características -->
        <section class="features">
            <h2>¿Por qué elegir ClearBalance?</h2>
            <div class="feature-item">
                <h3>Gestión de Finanzas Fácil</h3>
                <p>Organiza tus ingresos y gastos con nuestra interfaz intuitiva. Controla todo en un solo lugar.</p>
            </div>
            <div class="feature-item">
                <h3>Seguridad Garantizada</h3>
                <p>Tu información está protegida con los estándares más altos de seguridad. Confianza total.</p>
            </div>
            <div class="feature-item">
                <h3>Acceso desde Cualquier Lugar</h3>
                <p>Accede a tu cuenta desde cualquier dispositivo, ya sea móvil o computadora, en cualquier momento.</p>
            </div>
        </section>

        <!-- Sección de testimonios -->
        <section class="testimonials">
            <h2>Lo que nuestros usuarios dicen</h2>
            <div class="testimonial-item">
                <p>"ClearBalance me ha ayudado a tener un mejor control de mis finanzas, ¡ahora siempre sé dónde está mi dinero!"</p>
                <h4>- Juan Pérez</h4>
            </div>
            <div class="testimonial-item">
                <p>"La interfaz es muy fácil de usar y los reportes financieros me han permitido ahorrar más. ¡Totalmente recomendada!"</p>
                <h4>- María Gómez</h4>
            </div>
        </section>

        <!-- Llamado a la acción -->
        <section class="cta">
            <h2>Comienza a gestionar tus finanzas hoy mismo</h2>
            <a href="{{ route('register.create') }}" class="button">Regístrese ahora</a>
        </section>
    </div>
</body>
</html>