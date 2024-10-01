<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Eliminar Tarea</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="container mt-5">
        <?php
        include("conexion.php");

        if (isset($_GET['id'])) {
            $codigo = $_GET['id'];
            // Ejecutar el procedimiento almacenado para eliminar la tarea
            $rs = mysqli_query($cn, "CALL sp_BorrarTarea('$codigo')");

            if ($rs) {
                echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: '¡Eliminado!',
                            text: 'La tarea ha sido eliminada.',
                            confirmButtonText: 'Aceptar'
                        }).then(() => {
                            window.location.href='listado.php';
                        });
                      </script>";
            } else {
                echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Ocurrió un error: " . mysqli_error($cn) . "',
                            confirmButtonText: 'Aceptar'
                        }).then(() => {
                            window.location.href='listado.php';
                        });
                      </script>";
            }
        } else {
            echo "<script>
                    Swal.fire({
                        icon: 'warning',
                        title: 'Advertencia',
                        text: 'No se recibió el ID de la tarea.',
                        confirmButtonText: 'Aceptar'
                    }).then(() => {
                        window.location.href='listado.php';
                    });
                  </script>";
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>
</html>