<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Tarea Nueva</title>
</head>

<body>
    <?php
    include("conexion.php");
    ?>
    <center>
        <header>

            <h1>Agregar Tarea Nueva</h1>

        </header>
        <hr>
        <section>

            <form action="" method="POST">
                <table class="table table-borderless">
                    <tr>

                        <td width="450"></td>
                        <td>CODIGO </td>
                        <td><input type="text" placeholder="ID_TAREA" name="txtCod" size="40"></td>
                    </tr>
                    <tr>
                        <td width="450"></td>
                        <td>USUARIO</td>
                        <td><input type="text" placeholder="ID_USUARIO" name="txtUsuario" size="40"></td>
                    </tr>
                    <tr>
                        <td width="450"></td>
                        <td width="130">NUEVA TAREA</td>
                        <td><input type="text" placeholder="TAREA" name="txtTarea" size="40"></td>
                    </tr>
                    <tr>
                        <td width="450"></td>
                        <td>ESTADO</td>
                        <td><input type="text" placeholder="PENDIENTE, REALIZADO, EN PROCESO" name="txtEstado" size="40"></td>
                    </tr>
                </table>
                <input type="submit" value="Agregar" name="btnNuevo" class="btn btn-success">
                <?php


                if (isset($_POST['btnNuevo'])) {
                    $codigo = $_POST['txtCod'];
                    $usuario = $_POST['txtUsuario'];
                    $tarea = $_POST['txtTarea'];
                    $estado = $_POST['txtEstado'];

                    $rs = mysqli_query(
                        $cn,
                        "CALL sp_TareaNueva($codigo,$usuario,'$tarea','$estado');"
                    );

                    if ($rs) {
                        echo "<script>alert('Registro de Menu correcto!!!');
                                location.href='listado.php'</script>";
                    } else {
                        echo "Ocurrio un error " . mysqli_error($cn);
                    }
                }

                ?>
            </form>


        </section>
        <hr>
        <footer>
            <h5>DERECHOS RESERVADOS @RONALD - 2024</h5>
        </footer>
    </center>
</body>

</html>