<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movimientos</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container">
        <h2>Movimientos del Usuario</h2>

        <!-- Gráfico de Cuentas por Usuario -->
        <h3>Número de Cuentas del Usuario</h3>
        <canvas id="cuentasPorUsuarioChart" width="400" height="200"></canvas>

        <hr>

        <!-- Desplegable para seleccionar una cuenta -->
        <h3>Seleccionar Cuenta</h3>
        <select id="cuentaSelect">
            <!-- Aquí se llenarán las opciones con las cuentas del usuario -->
            <option value="">Seleccionar Cuenta</option>
        </select>

        <!-- Gráfico de Transacciones de la Cuenta Seleccionada -->
        <h3>Transacciones de la Cuenta</h3>
        <canvas id="transaccionesChart" width="400" height="200"></canvas>

        <hr>

        <!-- Tercer Gráfico -->
        <h3>Otro Gráfico</h3>
        <canvas id="tercerGrafico" width="400" height="200"></canvas>

    </div>

    <script>
        // Obtener datos de cuentas por usuario
        async function obtenerDatosCuentasPorUsuario() {
            try {
                // Solicitar datos JSON de la API
                const response = await fetch('/cuentas/por-usuario');
                const data = await response.json();

                // Extraer los nombres de usuarios y totales de cuentas
                const nombresUsuarios = data.map(d => d.nombreUsuario);
                const totalesCuentas = data.map(d => d.totalCuentas);

                // Crear el gráfico de barras
                const ctx = document.getElementById('cuentasPorUsuarioChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',  // Tipo de gráfico de barras
                    data: {
                        labels: nombresUsuarios,  // Etiquetas de los usuarios
                        datasets: [{
                            label: 'Total de Cuentas',
                            data: totalesCuentas,  // Datos de las cuentas
                            backgroundColor: 'rgba(75, 192, 192, 0.5)',  // Color de las barras
                            borderColor: 'rgba(75, 192, 192, 1)',  // Color del borde de las barras
                            borderWidth: 1  // Ancho del borde de las barras
                        }]
                    },
                    options: {
                        responsive: true,  // Hacer el gráfico responsivo
                        plugins: {
                            legend: {
                                position: 'top',  // Posición de la leyenda
                            },
                            title: {
                                display: true,
                                text: 'Número de Cuentas por Usuario'  // Título del gráfico
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true  // Asegura que el gráfico comience desde 0 en el eje Y
                            }
                        }
                    }
                });
            } catch (error) {
                console.error('Error al obtener los datos de cuentas por usuario:', error);
            }
        }

        // Obtener las cuentas del usuario logueado para el desplegable
        async function obtenerCuentas() {
            try {
                const response = await fetch('/api/usuario/cuentas');
                const cuentas = await response.json();

                const selectElement = document.getElementById('cuentaSelect');
                cuentas.forEach(cuenta => {
                    const option = document.createElement('option');
                    option.value = cuenta.id;
                    option.textContent = cuenta.nombre;
                    selectElement.appendChild(option);
                });
            } catch (error) {
                console.error('Error al obtener las cuentas del usuario:', error);
            }
        }

        // Obtener transacciones de la cuenta seleccionada
        async function obtenerTransacciones(cuentaId) {
            try {
                if (!cuentaId) return;  // No mostrar gráfico si no hay cuenta seleccionada

                const response = await fetch(`/cuentas/${cuentaId}/transacciones`);
                const data = await response.json();

                const ctx = document.getElementById('transaccionesChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: data.data.map(t => t.fecha),
                        datasets: [{
                            label: 'Saldo Acumulado',
                            data: data.data.map(t => t.saldo),
                            backgroundColor: 'rgba(54, 162, 235, 0.5)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: { position: 'top' },
                            title: { display: true, text: 'Transacciones de la Cuenta' }
                        }
                    }
                });
            } catch (error) {
                console.error('Error al obtener las transacciones de la cuenta:', error);
            }
        }

        // Obtener los datos del tercer gráfico
        async function obtenerTercerGrafico() {
            try {
                const response = await fetch('/grafico-tercero');
                const data = await response.json();

                const ctx = document.getElementById('tercerGrafico').getContext('2d');
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: data.labels,
                        datasets: [{
                            label: 'Valores',
                            data: data.data,
                            backgroundColor: 'rgba(255, 99, 132, 0.5)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: { position: 'top' },
                            title: { display: true, text: 'Gráfico Tercer Tipo' }
                        }
                    }
                });
            } catch (error) {
                console.error('Error al obtener los datos del tercer gráfico:', error);
            }
        }

        // Manejar el cambio de selección en el desplegable
        document.getElementById('cuentaSelect').addEventListener('change', (event) => {
            obtenerTransacciones(event.target.value);
        });

        // Inicializar la página
        document.addEventListener('DOMContentLoaded', () => {
            obtenerDatosCuentasPorUsuario();
            obtenerCuentas();
            obtenerTercerGrafico();
        });
    </script>
</body>
</html>