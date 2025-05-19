<?php

include ("conectarbd.php");
// Crear conexión
$conn = new mysqli($host, $usuario, $contrasena, $base_datos);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener las carreras
$sql = "SELECT materia_id, materia_nombre FROM cid_materia ORDER BY materia_nombre ASC";
$resultado = $conn->query($sql);

echo '<select name="materia" id="materia">';
echo '<option value="">Seleccione una carrera</option>';

if ($resultado->num_rows > 0) {
    while($fila = $resultado->fetch_assoc()) {
        echo '<option value="' . $fila["materia_id"] . '">' . htmlspecialchars($fila["materia_nombre"]) . '</option>';
    }
} else {
    echo '<option value="">No hay carreras registradas</option>';
}

echo '</select>';

// Cerrar conexión
$conn->close();
?>