<?php

include ("conectarBD.php");
// Crear conexión
$conn = new mysqli($host, $usuario, $contrasena, $base_datos);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta para obtener las carreras
$sql = "SELECT id_carrera, carrera FROM cid_cta_carrera";
$resultado = $conn->query($sql);

// Mostrar el select
echo '<select name="carrera" id="carrera">';
echo '<option value="">Seleccione una carrera</option>'; // Opción por defecto

if ($resultado->num_rows > 0) {
    while($fila = $resultado->fetch_assoc()) {
        echo '<option value="' . $fila["id_carrera"] . '">' . htmlspecialchars($fila["carrera"]) . '</option>';
    }
} else {
    echo '<option value="">No hay carreras registradas</option>';
}

echo '</select>';

// Cerrar conexión
$conn->close();
?>