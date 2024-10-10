<?php 
include("conexion.php");

// Obtener las tareas
$rs = mysqli_query($cn, "CALL sp_ListaTareas");

// Crear un array para almacenar las tareas
$tareas = [];
while ($r = mysqli_fetch_assoc($rs)) {
    $estado_clase = '';

    // Asignar la clase según el estado
    switch ($r['ES']) {
        case 'Completado':
            $estado_clase = 'completado';
            break;
        case 'En Proceso':
            $estado_clase = 'en-proceso';
            break;
        case 'Pendiente':
            $estado_clase = 'pendiente';
            break;
    }

    $tareas[] = [
        'fecha' => $r['FECHA'],
        'tarea' => $r['TA'],
        'estado' => $estado_clase // Guarda la clase según el estado
    ];
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales/es.js"></script>
    <title>Calendario de Tareas</title>
    <style>
        .pendiente {
            background-color: #FF0000; /* Rojo */
        }
        .en-proceso {
            background-color: #FFC300; /* Amarillo */
        }
        .completado {
            background-color: #008000 !important; /* Verde */
        }
        .fc-daygrid-event {
            color: black; /* Texto negro para eventos */
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <header class="text-center mb-4">
            <h1>Calendario de Tareas</h1>
            <hr>
        </header>

        <!-- Botón de retorno -->
        <div class="text-center mb-3">
            <a href="listado.php" class="btn btn-secondary">Volver al Listado</a>
        </div>

        <div id="calendar"></div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Obtener el elemento del calendario
            var calendarEl = document.getElementById('calendar');

            // Inicializar el calendario con la configuración
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth', // Vista inicial
                locales: ['es'], // Localización en español
                locale: 'es', // Establecer el idioma a español
                events: [
                    <?php foreach ($tareas as $index => $tarea): ?> {
                            title: '<?php echo addslashes($tarea['tarea']); ?>', // Escapar caracteres especiales
                            start: '<?php echo $tarea['fecha']; ?>', // Fecha de inicio
                            classNames: ['<?php echo $tarea['estado']; ?>'] // Agregar clase según el estado
                        }
                        <?php if ($index < count($tareas) - 1) echo ','; ?> // Evitar coma después del último evento
                    <?php endforeach; ?>
                ]
            });

            // Renderizar el calendario en la página
            calendar.render();
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>

</html>
