<?php
// Verificar que tenemos los datos necesarios
if (!isset($materias_numericas) || !isset($asesor_id) || !isset($conn)) {
    die("Error: Faltan datos esenciales para la operaci�n");
}

// Validar que el array de materias no est� vac�o
if (empty($materias_numericas)) {
    die("Error: El array de materias est� vac�o");
}

// Validar que el ID del asesor sea v�lido
if (!is_numeric($asesor_id) || $asesor_id <= 0) {
    die("Error: ID de asesor no v�lido");
}

// Iniciar transacci�n para asegurar la integridad de los datos
$conn->begin_transaction();

try {
    // Preparar la consulta SQL una sola vez
    $stmt = $conn->prepare("INSERT INTO cid_horario_materia_asesoria 
                          (hMateria_asesor, hMateria_materia) 
                          VALUES (?, ?)");
    
    if ($stmt === false) {
        throw new Exception("Error al preparar la consulta: " . $conn->error);
    }
    
    // Vincular par�metros
    $stmt->bind_param("ii", $asesor_id, $materia_id);
    
    $registros_insertados = 0;
    
    // Insertar cada materia
    foreach ($materias_numericas as $materia_id) {
        // Validar cada ID de materia
        if (!is_numeric($materia_id) || $materia_id <= 0) {
            continue; // Saltar valores no v�lidos
        }
        
        // Ejecutar la inserci�n
        if ($stmt->execute()) {
            $registros_insertados++;
        } else {
            throw new Exception("Error al insertar materia ID $materia_id: " . $stmt->error);
        }
    }
    
    // Confirmar la transacci�n si todo fue bien
    $conn->commit();

    
} catch (Exception $e) {
    // Revertir la transacci�n en caso de error
    $conn->rollback();
    die("Error en la operaci�n: " . $e->getMessage());
} finally {
    // Cerrar la declaraci�n
    if (isset($stmt)) {
        $stmt->close();
    }
}
?>