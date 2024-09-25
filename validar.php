<?php
 session_start();

include("conexion.php");

$usuario = $_POST['user'];
$password = $_POST['password'];
$_SESSION["user"] = $usuario;
$_SESSION["password"] = $usuario;

$consulta = "SELECT * FROM USUARIO WHERE USERNAME = '$usuario' AND CONTRASEÑA = '$password' ";
$rs = mysqli_query($cn , $consulta);

$filas = mysqli_num_rows($rs);

if ($filas) {
    header("location:listado.php");
}else{
    include("index.php");
    ?>
    <h1>ERORR DE AUNTENTIFICACION</h1>
    <?php
}
mysqli_free_result($rs);
mysqli_close($cn);