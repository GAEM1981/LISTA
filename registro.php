<?php
include 'conexion.php';

// Consulta para obtener las asistencias con nombres
$sql = "
    SELECT a.fecha, a.hora, e.nombre, e.codigo_barras
    FROM asistencia a
    INNER JOIN estudiantes e ON a.estudiante_id = e.id
    ORDER BY a.fecha DESC, a.hora DESC
";

$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registro de Asistencias</title>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: auto;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #eee;
        }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Listado de Asistencias</h2>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Matricula</th>
            <th>Fecha</th>
            <th>Hora</th>
        </tr>
        <?php if ($resultado->num_rows > 0): ?>
            <?php while($row = $resultado->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($row['codigo_barras']); ?></td>
                    <td><?php echo htmlspecialchars($row['fecha']); ?></td>
                    <td><?php echo htmlspecialchars($row['hora']); ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="4">No hay registros de asistencia.</td></tr>
        <?php endif; ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>