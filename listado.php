<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Listado de tareas</title>
</head>

<body>
    <?php
    include("conexion.php"); 
    ?>
    
        <header>
            <center>
            <h1>LISTADO DE TAREAS DE </h1 </header>
            </center>
        <hr>
            <section>
                <table class="table table-hover">
                    <tr>
                        <td width="50"><b>USUARIO</b> </td>
                        <td>
                            <input type="text" name="usu" size="50">
                        </td>
                    </tr>
                </table>
                <table class="table table-hover">
                    <tr>
                        <td><b>Nro.</b></td>
                        <td><b>Tarea</b></td>
                        <td><b>Estado</b></td>
                        <td><b>Accion</b></td>
                    </tr>
                    <?php
                    $rs = mysqli_query($cn, "CALL sp_ListaTareas");
                    foreach ($rs as $r) { ?>
                        <tr>
                            <td id="#USER"><?php echo $r['ID'] ?></td>
                            <td><?php echo $r['TA'] ?></td>
                            <td><?php echo $r['ES'] ?></td>
                            <td>
                                <a href="actualizar.php" class="btn btn-primary">
                                    <span>Editar</span>
                                </a>
                                <a href="eliminar.php" class="btn btn-danger">
                                    <span>Borrar</span>
                                </a>
                            </td>

                        </tr>
                    <?php } ?>
                </table>
                <a href="agregar.php" class="btn btn-primary">
                    <span>Tarea Nueva</span>
                </a>
                <a href="index.php" class="btn btn-dark" >
                    <span>Salir</span>
                </a>

            </section>
            <footer>

            </footer>
   
</body>

</html>