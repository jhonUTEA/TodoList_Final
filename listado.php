<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Listado de Tareas</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: '¿Estás seguro de eliminar?',
                text: "¡Esta acción no se puede deshacer!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirigir a eliminar.php para borrar la tarea
                    window.location.href = 'eliminar.php?id=' + id;
                }
            });
        }
    </script>
    <style>
        .action-column {
            width: 150px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <header class="text-center mb-4">
            <h1>Listado de Tareas</h1>
            <hr>
        </header>

        <section>
            <button onclick="window.location.href='agregar.php'" class="btn btn-success mb-3">
                Ingresar Tarea Nueva
            </button>
            <button onclick="window.location.href='imprimir.php'" class="btn btn-info mb-3">
                Imprimir
            </button>
            <button onclick="window.location.href='calendario.php'" class="btn btn-warning mb-3">
                Calendario
            </button>
            <button onclick="window.location.href='index.php'" class="btn btn-secondary mb-3">
                Salir
            </button>
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Nro.</th>
                        <th>Tarea</th>
                        <th>Estado</th>
                        <th>Fecha</th> <!-- Nueva columna para la fecha -->
                        <th class="action-column">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include("conexion.php");
                    $rs = mysqli_query($cn, "CALL sp_ListaTareas");
                    foreach ($rs as $r) { ?>
                        <tr>
                            <td><?php echo $r['ID']; ?></td>
                            <td><?php echo $r['TA']; ?></td>
                            <td><?php echo $r['ES']; ?></td>
                            <td><?php echo $r['FECHA']; ?></td> <!-- Muestra la fecha -->
                            <td class="action-column">
                                <a href="actualizar.php?id=<?php echo $r['ID']; ?>" class="btn btn-primary btn-sm">
                                    Editar
                                </a>
                                <button onclick="confirmDelete(<?php echo $r['ID']; ?>)" class="btn btn-danger btn-sm">
                                    Borrar
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </section>
    </div>
    <center>
        <footer>
            <h5>Derechos Reservados @Juarez Sandoval - 2024</h5>
        </footer>
    </center>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybF71wLlG6d3r3Zxj7dD7/8CROF+n+/4FqNE1y+cvXW+QZ9Cg" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-w9KMRQ6QQ+5N5RVV7Rz3ucTt/0CV4WGG1zQXEfA2U7INfu1x+h+Z61B8Y2w34EVU" crossorigin="anonymous"></script>
</body>

</html>