<?php
include 'conexion.php';

if (isset($_POST['codigo_barras'])) {
    $codigo = $conn->real_escape_string($_POST['codigo_barras']);
    $fecha = date('Y-m-d');
    $hora = date('H:i:s');

    // Buscar estudiante por código
    $sql = "SELECT id, nombre FROM estudiantes WHERE codigo_barras = '$codigo'";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        $estudiante_id = $fila['id'];
        $nombre = $fila['nombre'];

        // Verificar si ya registró asistencia hoy
        $check = "SELECT * FROM asistencia WHERE estudiante_id = $estudiante_id AND fecha = '$fecha'";
        $existe = $conn->query($check);

        if ($existe->num_rows == 0) {
            // Insertar asistencia
            $insert = "INSERT INTO asistencia (estudiante_id, fecha, hora) VALUES ($estudiante_id, '$fecha', '$hora')";
            if ($conn->query($insert)) {
                echo "<h3>Asistencia registrada para $nombre</h3>";
            } else {
                echo "Error al registrar: " . $conn->error;
            }
        } else {
            echo "<h3>Asistencia ya registrada hoy para $nombre</h3>";
        }
    } else {
        echo "<h3>Código no encontrado</h3>";
    }
}

$conn->close();
?>