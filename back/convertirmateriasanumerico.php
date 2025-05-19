

<?php
// Verificar si se recibió el campo
if (!isset($_POST['materias_seleccionadas'])) {
    die("Error: No se recibió el campo 'materias_seleccionadas'");
}

// Obtener y limpiar el string
$materias_str = trim($_POST['materias_seleccionadas']);

// Convertir a array y limpiar cada valor
$materias_array = explode(',', $materias_str);
$materias_numericas = array();

foreach ($materias_array as $materia) {
    $materia_limpia = trim($materia);
    
    // Validar que sea numérico y positivo
    if (is_numeric($materia_limpia) && $materia_limpia > 0) {
        $materias_numericas[] = (int)$materia_limpia;
    }
}

?>