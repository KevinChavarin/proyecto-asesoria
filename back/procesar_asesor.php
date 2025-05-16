<?php

include ("conectarbd.php");      

$conn = new mysqli($host, $usuario, $contrasena, $base_datos);


if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$codigo_estudiante = $conn->real_escape_string($_POST['codigo_estudiante']);
$nombre = $conn->real_escape_string($_POST['nombre']);
$carrera = $conn->real_escape_string($_POST['carrera']);
$periodo = $conn->real_escape_string($_POST['periodo']);


// Procesar días seleccionados
$dias_seleccionados = isset($_POST['dias_seleccionados']) ? $conn->real_escape_string($_POST['dias_seleccionados']) : '';

// Procesar horarios (pueden ser varios)
$horarios = [];
if (isset($_POST['horarios'])) {
    foreach ($_POST['horarios'] as $horario) {
        $horarios[] = $conn->real_escape_string($horario);
    }
}
$horarios_str = implode(", ", $horarios);

// Preparar y ejecutar la consulta SQL
$sql = "INSERT INTO cid_asesor (asesor_codigo, asesor_nombre, asesor_idcarrera, asesor_periodo) 
        VALUES ('$codigo_estudiante', '$nombre', '$carrera', '$periodo')";

if ($conn->query($sql) === TRUE) {
    // Redirigir a una página de éxito o mostrar mensaje
	
	$asesor_id = $conn->insert_id;   // Obtengo el id del asesor insertado
    include ("convertirmateriasanumerico.php");
	include ("insertarmateria.php");
	include ("convertirhorarioarreglo.php");
	include ("insertarhorario.php");

    echo "<script>
            alert('Registro exitoso');
            window.location.href = '../index.php';
         </script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar conexión
$conn->close();
?>