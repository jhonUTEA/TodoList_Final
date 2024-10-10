<?php 
include("conexion.php");

// Consulta para obtener el listado de tareas
$rs = mysqli_query($cn, "CALL sp_ListaTareas");

// Verificar si la consulta se ejecutó correctamente
if (!$rs) {
    die("Error en la consulta: " . mysqli_error($cn));
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Imprimir Listado de Tareas</title>
    <script>
        function printPage() {
            window.print();
        }
    </script>
</head>

<body onload="printPage()">
    <div class="container mt-5">
        <header class="text-center mb-4">
            <h1>Listado de Tareas</h1>
            <hr>
        </header>
        
        <section>
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Nro.</th>
                        <th>Tarea</th>
                        <th>Estado</th>
                        <th>Fecha</th> <!-- Nueva columna para la fecha -->
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    // Asegurarse de que $rs tiene resultados
                    if (mysqli_num_rows($rs) > 0) {
                        foreach ($rs as $r) { ?>
                            <tr>
                                <td><?php echo $r['ID']; ?></td>
                                <td><?php echo $r['TA']; ?></td>
                                <td><?php echo $r['ES']; ?></td>
                                <td><?php echo $r['FECHA']; ?></td> <!-- Mostrar fecha -->
                            </tr>
                        <?php }
                    } else {
                        echo "<tr><td colspan='4' class='text-center'>No hay tareas disponibles</td></tr>";
                    }
                    ?>
                </tbody>
            </table>

            <div class="text-center">
                <a href="listado.php" class="btn btn-secondary">Volver al Listado</a>
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>

</body>

</html>