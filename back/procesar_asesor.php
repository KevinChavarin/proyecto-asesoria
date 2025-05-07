<?php
$servername = "localhost";  
$username = "root";         
$password = "";             
$dbname = "cid_cta";        

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$codigo_estudiante = $conn->real_escape_string($_POST['codigo_estudiante']);
$nombre = $conn->real_escape_string($_POST['nombre']);
$carrera = $conn->real_escape_string($_POST['carrera']);
$periodo = $conn->real_escape_string($_POST['periodo']);

// Procesar materias (pueden ser varias)
$materias = [];
if (isset($_POST['materias'])) {
    foreach ($_POST['materias'] as $materia) {
        if (!empty(trim($materia))) {
            $materias[] = $conn->real_escape_string($materia);
        }
    }
}
$materias_str = implode(", ", $materias);

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
$sql = "INSERT INTO asesores (codigo_estudiante, nombre, carrera, periodo, materias, dias_disponibles, horarios) 
        VALUES ('$codigo_estudiante', '$nombre', '$carrera', '$periodo', '$materias_str', '$dias_seleccionados', '$horarios_str')";

if ($conn->query($sql) === TRUE) {
    // Redirigir a una página de éxito o mostrar mensaje
    echo "<script>
            alert('Registro exitoso');
            window.location.href = './index.html';
        </script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar conexión
$conn->close();
?>