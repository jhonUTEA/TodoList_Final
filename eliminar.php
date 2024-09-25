<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <title>Eliminar Tarea</title>
</head>

<body>
    <?php
    include("conexion.php");
    ?>
    <header>
        <center>
        <h1>Eliminar Tarea</h1>
        </center>
    </header>
    <section>
        <form action="" method="post">
            <table class="table table-hover">
                <tr>
                    <td width="550"></td>
                    <td width="50">CODIGO</td>
                    <td>
                        <input type="text" name="txtID">
                    </td>
                </tr>
                <tr>
                    <td width="550"></td>
                    <td colspan="2">
                        <input type="submit" value="Borrar" name="btnBorrar" class="btn btn-danger">
                    </td>
                </tr>
                <?php

                if (isset($_POST['btnBorrar'])) {
                    $codigo = $_POST['txtID'];

                    $rs = mysqli_query($cn, "CALL sp_BorrarTarea('$codigo')");

                    if ($rs) {
                        echo "<script>alert('Tarea eliminada!!!');
                                location.href='listado.php'</script>";
                    } else {
                        echo "Ocurrio un error " . mysqli_error($cn);
                    }
                }

                ?>
            </table>
        </form>
    </section>
    <footer>

    </footer>
</body>

</html>