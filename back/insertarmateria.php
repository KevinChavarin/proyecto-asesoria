<?php
// Verificar que tenemos los datos necesarios
if (!isset($materias_numericas) || !isset($asesor_id) || !isset($conn)) {
    die("Error: Faltan datos esenciales para la operación");
}

// Validar que el array de materias no esté vacío
if (empty($materias_numericas)) {
    die("Error: El array de materias está vacío");
}

// Validar que el ID del asesor sea válido
if (!is_numeric($asesor_id) || $asesor_id <= 0) {
    die("Error: ID de asesor no válido");
}

// Iniciar transacción para asegurar la integridad de los datos
$conn->begin_transaction();

try {
    // Preparar la consulta SQL una sola vez
    $stmt = $conn->prepare("INSERT INTO cid_horario_materia_asesoria 
                          (hMateria_asesor, hMateria_materia) 
                          VALUES (?, ?)");
    
    if ($stmt === false) {
        throw new Exception("Error al preparar la consulta: " . $conn->error);
    }
    
    // Vincular parámetros
    $stmt->bind_param("ii", $asesor_id, $materia_id);
    
    $registros_insertados = 0;
    
    // Insertar cada materia
    foreach ($materias_numericas as $materia_id) {
        // Validar cada ID de materia
        if (!is_numeric($materia_id) || $materia_id <= 0) {
            continue; // Saltar valores no válidos
        }
        
        // Ejecutar la inserción
        if ($stmt->execute()) {
            $registros_insertados++;
        } else {
            throw new Exception("Error al insertar materia ID $materia_id: " . $stmt->error);
        }
    }
    
    // Confirmar la transacción si todo fue bien
    $conn->commit();

    
} catch (Exception $e) {
    // Revertir la transacción en caso de error
    $conn->rollback();
    die("Error en la operación: " . $e->getMessage());
} finally {
    // Cerrar la declaración
    if (isset($stmt)) {
        $stmt->close();
    }
}
?>