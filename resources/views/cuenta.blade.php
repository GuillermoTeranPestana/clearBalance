<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráfico de Transacciones</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns"></script> <!-- Adaptador -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/date-fns/2.28.0/date-fns.min.js"></script> <!-- date-fns -->
</head>
<body>
    <h2 id="titulo-cuenta"></h2>
    <canvas id="transaccionesChart" width="400" height="200"></canvas>

    <h2>Número de Cuentas por Usuario</h2>
    <canvas id="cuentasPorUsuarioChart" width="400" height="200"></canvas>

    <script>
        async function obtenerDatosTransacciones() {
            // Obtener el ID de la cuenta
            const cuentaId = {{ $cuentaId }};

            try {
                const response = await fetch(`/cuentas/${cuentaId}/transacciones`);
                const { nombreCuenta, data } = await response.json();

                // Actualizar el título del gráfico
                document.getElementById('titulo-cuenta').innerText = `Transacciones de ${nombreCuenta}`;

                // Extraer datos de fecha y saldo
                const fechas = data.map(d => new Date(d.fecha));
                const saldos = data.map(d => d.saldo);

                // Crear el gráfico
                const ctx = document.getElementById('transaccionesChart').getContext('2d');
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: fechas,
                        datasets: [{
                            label: 'Saldo',
                            data: saldos,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderWidth: 2,
                            fill: true,
                            tension: 0.1 
                        }]
                    },
                    options: {
                        scales: {
                            x: {
                                type: 'time',
                                time: {
                                    unit: 'day', 
                                    tooltipFormat: 'DD MMM YYYY'
                                },
                                title: {
                                    display: true,
                                    text: 'Fecha'
                                }
                            },
                            y: {
                                title: {
                                    display: true,
                                    text: 'Saldo'
                                }
                            }
                        }
                    }
                });
            } catch (error) {
                console.error('Error al obtener los datos de transacciones:', error);
            }
        }
       
    document.addEventListener('DOMContentLoaded', (event) => {
            obtenerDatosTransacciones();
        });

    </script>
</body>
</html>