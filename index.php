<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
    <title>LOGIN</title>
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .login-container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 90%; /* Responsive width */
            max-width: 400px; /* Maximum width */
            margin: auto; /* Centering */
        }
        h2 {
            margin-bottom: 20px;
            color: #343a40;
            text-align: center; /* Centered text */
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            transition: border-color 0.3s;
        }
        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #80bdff;
            outline: none;
        }
        .btn {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        footer {
            margin-top: 20px;
            font-size: 12px;
            color: #6c757d;
            text-align: center; /* Centered footer */
        }
    </style>
</head>

<body>
    <div class="login-container animate__animated animate__fadeIn">
        <form action="Validar.php" method="post">
            <h2><b>LOGIN USUARIO</b></h2>
            <hr>
            <p><b>Usuario</b></p>
            <input type="text" placeholder="Nombre de usuario" name="user" required>
            <p><b>Password</b></p>
            <input type="password" placeholder="Ingrese su contraseña" name="password" required>
            <button type="submit" class="btn">Ingresar</button>
            <hr>
            <a href="Registrar.php" class="btn btn-secondary">Registrate</a>
        </form>
        <footer>
            <h5 style="width: fit-content;"></h5>Derechos Reservados @Juarez Sandoval - 2024</h5>
        </footer>
    </div>
</body>

</html>