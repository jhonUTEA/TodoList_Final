<?php
// Include the database connection
include 'conexion.php'; // Asegúrate de que este archivo contenga la lógica de conexión

// Variables para mensajes
$mensaje_exito = "";
$mensaje_error = "";

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user inputs
    $nombreCompleto = $_POST['nombreCompleto']; // Campo para el nombre completo
    $username = $_POST['username'];
    $password = $_POST['password'];
    $repeat_password = $_POST['repeat_password'];

    // Check if passwords match
    if ($password !== $repeat_password) {
        $mensaje_error = "Las contraseñas no coinciden.";
    } else {
        // Prepare and bind to check if the username already exists
        $stmt = $cn->prepare("SELECT * FROM USUARIO WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if the username already exists
        if ($result->num_rows > 0) {
            $mensaje_error = "El nombre de usuario ya existe.";
        } else {
            // Hash the password before storing it
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert new user (no need to specify id_user)
            $stmt = $cn->prepare("INSERT INTO USUARIO (NombreCompleto, username, contraseña) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $nombreCompleto, $username, $hashed_password);

            if ($stmt->execute()) {
                $mensaje_exito = "Registro exitoso. Puedes iniciar sesión.";
            } else {
                $mensaje_error = "Error al registrar el usuario: " . $stmt->error;
            }
        }
    }

    // Close the statement and connection
    $stmt->close();
    $cn->close();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Registro de Usuario</title>
</head>

<body>
    <div class="container">
        <center>
            <header>
                <h1>PASOS PARA TU REGISTRO</h1>
            </header>
            <section>
                <form method="post" action="">
                    <table width="200">
                        <tr>
                            <td>NOMBRE COMPLETO</td>
                            <td>
                                <input type="text" placeholder="Nombre Completo" name="nombreCompleto" required>
                            </td>
                        </tr>
                        <tr>
                            <td>USERNAME</td>
                            <td>
                                <input type="text" placeholder="Nombre de usuario" name="username" required>
                            </td>
                        </tr>
                        <tr>
                            <td>CONTRASEÑA</td>
                            <td>
                                <input type="password" placeholder="Crea Contraseña" name="password" required>
                            </td>
                        </tr>
                        <tr>
                            <td>REPETIR CONTRASEÑA</td>
                            <td>
                                <input type="password" placeholder="Repite Contraseña" name="repeat_password" required>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <button type="submit" class="btn btn-warning">Registrarme</button>
                            </td>
                            <td>
                                <a href="index.php" class="btn btn-dark" style="margin-left: 70px;">
                                    <span>Salir</span>
                                </a>
                            </td>
                        </tr>
                    </table>
                </form>

                <!-- Mostrar mensajes de éxito o error -->
                <?php if (!empty($mensaje_exito)): ?>
                    <div class="alert alert-success mt-3"><?php echo $mensaje_exito; ?></div>
                <?php elseif (!empty($mensaje_error)): ?>
                    <div class="alert alert-danger mt-3"><?php echo $mensaje_error; ?></div>
                <?php endif; ?>
            </section>
            <footer>
            </footer>
        </center>
    </div>
</body>

</html>