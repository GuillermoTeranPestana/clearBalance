<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráfico de Transacciones</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1 id="titulo-cuenta">Transacciones</h1>
    <canvas id="pieChart" width="400" height="400"></canvas> <!-- Cambié el ID del canvas -->

    <script>
        async function obtenerDatosTransacciones() {
            // Obtener el ID de la cuenta desde una variable de Blade
            const cuentaId = {{ $cuentaID }}; // Asegúrate de que esta variable está disponible

            try {
                // Hacer la solicitud para obtener los tipos de transacciones
                const response = await fetch(`/cuentas/${cuentaId}/tipo-de-transacciones`);
                const transaccionesData = await response.json();

                // Manejo si no hay datos
                if (!transaccionesData || transaccionesData.length === 0) {
                    document.getElementById('titulo-cuenta').innerText = 'No hay transacciones disponibles';
                    return;
                }

                // Actualizar el título del gráfico
                document.getElementById('titulo-cuenta').innerText = `Transacciones de la Cuenta ${cuentaId}`;

                // Extraer datos para el gráfico de pastel
                const labels = transaccionesData.map(item => item.TipoTransaccion);
                const totals = transaccionesData.map(item => item.total);

                // Obtener el contexto del canvas
                const ctx = document.getElementById('pieChart').getContext('2d');

                // Crear el gráfico de pastel
                const pieChart = new Chart(ctx, {
                    type: 'pie', // Cambiado a tipo 'pie'
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Total de Transacciones',
                            data: totals,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
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
                            tooltip: {
                                callbacks: {
                                    label: function(tooltipItem) {
                                        return `${tooltipItem.label}: ${tooltipItem.raw}`;
                                    }
                                }
                            }
                        }
                    }
                });

            } catch (error) {
                console.error('Error al obtener los datos:', error);
            }
        }

        // Llama a la función cuando se cargue la página
        window.onload = obtenerDatosTransacciones;
    </script>
</body>
</html>