<?php
session_start();
include("conexion.php");

$usuario = $_POST['user'];
$password = $_POST['password'];
$_SESSION["user"] = $usuario; // Almacena el nombre de usuario, si es necesario

// Prepara la consulta para evitar inyecciones SQL
$consulta = "SELECT * FROM USUARIO WHERE USERNAME = '$usuario'";
$rs = mysqli_query($cn, $consulta);
$usuarioData = mysqli_fetch_assoc($rs);

if ($usuarioData) {
    // Verifica la contraseña usando password_verify
    if (password_verify($password, $usuarioData['contraseña'])) {
        // Si la contraseña es correcta, establece el ID del usuario en la sesión
        $_SESSION['id_user'] = $usuarioData['id_user']; // Asegúrate de que este campo sea correcto

        header("Location: listado.php");
        exit; // Asegúrate de salir después de redirigir
    } else {
        // Contraseña incorrecta
        $error = "ERROR DE AUTENTIFICACIÓN: Contraseña incorrecta.";
    }
} else {
    // Usuario no encontrado
    $error = "ERROR DE AUTENTIFICACIÓN: Usuario no encontrado.";
}

mysqli_free_result($rs);
mysqli_close($cn);

// Si hubo un error, muestra el mensaje
if (isset($error)) {
    include("index.php");
    echo "<h1>$error</h1>";
}
?>
