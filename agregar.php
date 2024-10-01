<!DOCTYPE html> 
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Agregar Tarea Nueva</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            margin-top: 50px;
            padding: 30px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #343a40;
        }
        footer {
            margin-top: 20px;
            font-size: 12px;
            color: #6c757d;
            text-align: center;
        }
    </style>
</head>

<body>
    <?php
    include("conexion.php");
    session_start();

    // Obtener automáticamente el último ID_TAREA y sumarle 1
    $rs = mysqli_query($cn, "SELECT MAX(id_tarea) AS max_id FROM TAREAS");
    if (!$rs) {
        die("Error en la consulta: " . mysqli_error($cn));
    }
    $row = mysqli_fetch_assoc($rs);
    $nuevoCodigo = $row['max_id'] ? $row['max_id'] + 1 : 1;

    // Obtener el ID del usuario conectado
    $usuarioId = $_SESSION['id_user'];
    ?>
    
    <div class="container">
        <header>
            <h1 class="text-center">Agregar Tarea Nueva</h1>
        </header>
        <hr>
        <section>
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="txtCod" class="form-label">Código</label>
                    <input type="text" name="txtCod" id="txtCod" class="form-control" value="<?php echo $nuevoCodigo; ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="txtUsuario" class="form-label">Usuario</label>
                    <input type="text" name="txtUsuario" id="txtUsuario" class="form-control" value="<?php echo $usuarioId; ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="txtTarea" class="form-label">Nueva Tarea</label>
                    <input type="text" placeholder="TAREA" name="txtTarea" id="txtTarea" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="txtFecha" class="form-label">Fecha</label>
                    <input type="date" name="txtFecha" id="txtFecha" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="txtEstado" class="form-label">Estado</label>
                    <select name="txtEstado" id="txtEstado" class="form-select" required>
                        <option value="">Seleccionar estado</option>
                        <option value="PENDIENTE">PENDIENTE</option>
                        <option value="REALIZADO">REALIZADO</option>
                        <option value="EN PROCESO">EN PROCESO</option>
                    </select>
                </div>
                <button type="submit" name="btnNuevo" class="btn btn-success">Agregar</button>
                <a href="listado.php" class="btn btn-secondary">Salir</a>

                <?php
                if (isset($_POST['btnNuevo'])) {
                    // Sanitizar los datos recibidos
                    $codigo = intval($_POST['txtCod']);
                    $usuario = intval($usuarioId); // Usar el id_user
                    $tarea = mysqli_real_escape_string($cn, $_POST['txtTarea']);
                    $fecha = mysqli_real_escape_string($cn, $_POST['txtFecha']);
                    $estado = mysqli_real_escape_string($cn, $_POST['txtEstado']);

                    // Preparar y ejecutar la consulta
                    $stmt = $cn->prepare("CALL sp_TareaNueva(?, ?, ?, ?, ?)");
                    if (!$stmt) {
                        die("Error en la preparación de la consulta: " . mysqli_error($cn));
                    }

                    // Cambia id_usuario por id_user aquí
                    $stmt->bind_param("iisss", $codigo, $usuario, $tarea, $fecha, $estado);

                    if ($stmt->execute()) {
                        echo "<script>
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Registro de tarea correcto!',
                                    text: 'Se ha agregado la tarea exitosamente.',
                                    confirmButtonText: 'Aceptar'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        location.href='agregar.php';
                                    }
                                });
                              </script>";
                    } else {
                        echo "<script>
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Ocurrió un error',
                                    text: '" . $stmt->error . "',
                                    confirmButtonText: 'Aceptar'
                                });
                              </script>";
                    }
                    $stmt->close();
                }
                ?>
            </form>
        </section>
        <hr>
        <footer>
            <h5>Derechos Reservados @Juarez Sandoval - 2024</h5>
        </footer>
    </div>
    
    <?php
    mysqli_close($cn);
    ?>
</body>

</html>