<!DOCTYPE html> 
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Actualizar Tarea</title>
    <style>
        .success-message {
            color: green;
            margin-top: 10px;
            /* Espaciado arriba del mensaje */
        }
    </style>
</head>

<body>
    <?php
    include('conexion.php');

    $codigo = '';
    $mensaje = '';
    $TA = null; // Inicializa la variable para la tarea
    $mensajeExito = ''; // Variable para el mensaje de éxito

    // Verifica si el ID de la tarea fue pasado en la URL
    if (isset($_GET['id'])) {
        $codigo = $_GET['id']; // Obtiene el ID de la tarea

        // Llama al procedimiento almacenado para buscar la tarea
        $rs = mysqli_query($cn, "CALL SP_BUSCARTAREA($codigo)");

        if ($rs) {
            $n = mysqli_num_rows($rs);

            if ($n == 0) {
                echo "<script>alert('NO EXISTE LA TAREA')</script>";
            } else {
                $TA = mysqli_fetch_array($rs);
            }

            // Limpia resultados anteriores
            while (mysqli_next_result($cn)) {;
            } // Esto vacía los resultados pendientes
        } else {
            echo "Error al ejecutar la consulta: " . mysqli_error($cn);
        }
    }

    // Maneja la actualización de la tarea
    if (isset($_POST['btnActualizar'])) {
        $user = $_POST['txtUsuario'];
        $tarea = $_POST['txtTarea'];
        $estado = $_POST['txtEstado'];
        $fecha = $_POST['txtFecha']; // Nueva variable para la fecha

        // Actualiza la tarea, incluyendo la fecha, junto a los demás campos
        $rs = mysqli_query($cn, "UPDATE TAREAS SET ID_USER= $user, TAREA = '$tarea', Estado= '$estado', FECHA = '$fecha' WHERE ID_TAREA= $codigo");

        if ($rs) {
            $mensajeExito = 'TAREA ACTUALIZADA'; // Mensaje de éxito
        } else {
            echo "ERROR: No se ejecutó " . mysqli_error($cn);
        }
    }
    ?>

    <header>
        <center>
            <h1>Editar Tarea</h1>
        </center>
    </header>
    <section>
        <form action="" method="POST">
            <table class="table table-borderless">
                <tr>
                    <td width="450"></td>
                    <td width="150">CODIGO DE TAREA</td>
                    <td width="100">
                        <input type="text" name="txtCodigo" value="<?php echo $codigo; ?>" readonly>
                    </td>
                    <td>
                        <input type="submit" value="Buscar" name="btnBuscar" class="btn btn-primary">
                    </td>
                </tr>
            </table>
            <table class="table table-borderless">
                <tr>
                    <td width="450"></td>
                    <td width="130">USUARIO</td>
                    <td><input type="text" name="txtUsuario" size="40" value="<?php echo isset($TA['id_user']) ? $TA['id_user'] : ''; ?>"></td>
                </tr>
                <tr>
                    <td width="450"></td>
                    <td width="130">TAREA</td>
                    <td><input type="text" name="txtTarea" size="40" value="<?php echo isset($TA['tarea']) ? $TA['tarea'] : ''; ?>"></td>
                </tr>
                <tr>
                    <td width="450"></td>
                    <td>ESTADO</td>
                    <td>
                        <!-- Cambiado a un menú desplegable -->
                        <select name="txtEstado" class="form-select-sm">
                            <option value="Pendiente" <?php echo isset($TA['Estado']) && $TA['Estado'] == 'Pendiente' ? 'selected' : ''; ?>>Pendiente</option>
                            <option value="En Proceso" <?php echo isset($TA['Estado']) && $TA['Estado'] == 'En Proceso' ? 'selected' : ''; ?>>En Proceso</option>
                            <option value="Completada" <?php echo isset($TA['Estado']) && $TA['Estado'] == 'Completada' ? 'selected' : ''; ?>>Completada</option>
                        </select>
                    </td>
                </tr>
                <!-- Nueva fila para FECHA -->
                <tr>
                    <td width="450"></td>
                    <td>FECHA</td>
                    <td><input type="date" name="txtFecha" size="40" value="<?php echo isset($TA['fecha']) ? $TA['fecha'] : ''; ?>"></td>
                </tr>
                <tr>
                    <td width="500"></td>
                    <td>
                        <input type="submit" name="btnActualizar" value="Actualizar" class="btn btn-primary">
                    </td>
                    <td>
                        <a href="listado.php" class="btn btn-dark" style="margin-left: 70px;">
                            <span>Salir</span>
                        </a>
                    </td>
                </tr>
            </table>
        </form>
        <!-- Mostrar mensajes de éxito o error -->
        <center>
            <?php if (!empty($mensajeExito)): ?>
                <div class="alert alert-success mt-3"><?php echo $mensajeExito; ?></div>
            <?php endif; ?>
        </center>
    </section>
    <center>
    <footer>
        <h5>Derechos Reservados @Juarez Sandoval - 2024</h5>
    </footer>
    </center>
</body>

</html>
