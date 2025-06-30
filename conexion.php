<?php
$host = "localhost";
$usuario = "root"; // tu usuario de MySQL
$contrasena = "";  // tu contraseña de MySQL
$base_datos = "lista";

$conn = new mysqli($host, $usuario, $contrasena, $base_datos);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

?>