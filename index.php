<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/login.css">
    <link rel="stylesheet" href="CSS/cabecera.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>LOGIN</title>
</head>

<body>
    <center>
        <form action="Validar.php" method="post">

            <h2 class="animate_animated animate_backInLeft"><b>LOGIN USUARIO</b></h2>
            <hr>
            <p><b>Usuario</b> <input type="text" placeholder="Nombre de usuario" name="user"></p>
            <p><b>Password</b> <input type="password" placeholder="Ingrese su contraseña" name="password"></p>

            <input type="submit" value="Ingresar" name="btnIngreso">
            <hr>
            <a href="Registrar.php" class="btn btn-secondary">
                <span>Registrate</span>
            </a>

        </form>

        <footer>
            <h5>DERECHOS RESERVADOS @RONALD - 2024</h5>
        </footer>
    </center>
</body>

</html>