<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Actualizar Tarea</title>
</head>

<body>
    <?php
    //error_reporting(0);
    include('conexion.php');
    $codigo = '';
    $mensaje = '';

    if (isset($_POST['btnBuscar'])) {
        $boton = $_POST['btnBuscar'];
        $codigo = $_POST['txtCodigo'];

        if ($boton == "Buscar") {
            $rs = mysqli_query($cn, "CALL SP_BUSCARTAREA($codigo)");

            $n = mysqli_num_rows($rs);

            if ($n == 0)
                echo "<script>alert('NO EXISTE LA TAREA')</script>";

            $TA = mysqli_fetch_array($rs);
        }

        if ($boton == "Actualizar") {
            $cod = $codigo;
            $user = $_POST['txtUsuario'];
            $tarea = $_POST['txtTarea'];
            $estado = $_POST['txtEstado'];

            $rs = mysqli_query($cn, "UPDATE TAREAS
                SET ID_USER= $user ,TAREA = '$tarea', Estado= '$estado'
                WHERE ID_TAREA= $cod");

            if ($rs) {
                echo "<script>alert('Producto ACTUALIZADO');
                    location.href='ToDoList.php'</script>";
            } else {
                echo "ERROR: No se ejecuto " . mysqli_error($cn);
            }
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
                    <td width="150">
                        CODIGO DE TAREA
                    </td>
                    <td width="100">
                        <input type="text" name="txtCodigo" value="<?php echo $TA['id_tarea']; ?>">
                    </td>
                    <td>
                        <input type="submit" value="Buscar" name="btnBuscar" class="btn btn-primary">
                        <?php echo $mensaje; ?>
                    </td>
                </tr>
                <table class="table table-borderless">
                    <tr>
                        <td width="450"></td>
                        <td width="130">USUARIO</td>
                        <td><input type="text" name="txtUsuario" size="40" value="<?php echo $TA['id_user']; ?>">

                    </tr>
                    <tr>
                        <td width="450"></td>
                        <td width="130">TAREA</td>
                        <td><input type="text" name="txtTarea" size="40" value="<?php echo $TA['tarea']; ?>">

                    </tr>
                    <tr>
                        <td width="450"></td>
                        <td>ESTADO</td>
                        <td><input type="text" name="txtEstado" size="40" value="<?php echo $TA['Estado']; ?>">

                    </tr>
                    <tr>
                        <td width="500"></td>
                        <td>
                            <input type="submit" name="btnBuscar" value="Actualizar" class="btn btn-primary">
                            <?php echo $mensaje; ?>
                        </td>
                    </tr>
                </table>
        </form>

    </section>
    <footer>

    </footer>
</body>

</html>