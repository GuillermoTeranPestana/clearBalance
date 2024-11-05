<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Número de Cuentas por Usuario</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h2>Número de Cuentas por Usuario</h2>
    <canvas id="cuentasPorUsuarioChart" width="400" height="200"></canvas>

    <script>
        async function obtenerDatosCuentasPorUsuario() {
            try {
                // Solicitar datos JSON de la API
                const response = await fetch('/cuentas/por-usuario');
                const data = await response.json();

                // Extraer nombres de usuarios y totales de cuentas
                const nombresUsuarios = data.map(d => d.nombreUsuario);
                const totalesCuentas = data.map(d => d.totalCuentas);

                // Crear el gráfico de cuentas por usuario
                const ctx = document.getElementById('cuentasPorUsuarioChart').getContext('2d');
                new Chart(ctx, {
                    type: 'polarArea',
                    data: {
                        labels: nombresUsuarios,
                        datasets: [{
                            label: 'Total de Cuentas',
                            data: totalesCuentas,
                            backgroundColor: [
                                'rgba(75, 192, 192, 0.5)',
                                'rgba(255, 99, 132, 0.5)',
                                'rgba(255, 205, 86, 0.5)',
                                'rgba(54, 162, 235, 0.5)',
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: 'Cuentas por Usuario (Área Polar)'
                            }
                        }
                    }
                });
            } catch (error) {
                console.error('Error al obtener los datos de cuentas por usuario:', error);
            }
        }

        // Llamar a la función para obtener datos y renderizar el gráfico al cargar la página
        document.addEventListener('DOMContentLoaded', obtenerDatosCuentasPorUsuario);
    </script>
</body>
</html>