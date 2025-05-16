<?php
// Verificar que tenemos los datos necesarios
if (!isset($horarios_procesados) || !isset($asesor_id) || !isset($conn)) {
    die("Error: Faltan datos esenciales para la operación");
}

// Validar que el array de horarios no esté vacío
if (empty($horarios_procesados)) {
    die("Error: No hay horarios para insertar");
}

// Validar que el ID del asesor sea válido
if (!is_numeric($asesor_id) || $asesor_id <= 0) {
    die("Error: ID de asesor no válido");
}

// Iniciar transacción para asegurar integridad de datos
$conn->begin_transaction();

try {
    // Preparar la consulta SQL
    $stmt = $conn->prepare("INSERT INTO cid_horario_asesor 
                          (horario_idasesor, horario_dia, horario_hora, asesoria_fecha, horario_estatus) 
                          VALUES (?, ?, ?, 0, '1')");
    
    if ($stmt === false) {
        throw new Exception("Error al preparar la consulta: " . $conn->error);
    }
    
    // Vincular parámetros
    $stmt->bind_param("iss", $horario_idasesor, $horario_dia, $horario_hora);
    
    $registros_insertados = 0;
    $errores = [];
    
    // Insertar cada horario
    foreach ($horarios_procesados as $horario) {
        // Asignar valores para la inserción
        $horario_idasesor = $asesor_id;
        $horario_dia = $horario['dia'];
        $horario_hora = $horario['hora'];
        
        // Ejecutar la inserción
        if ($stmt->execute()) {
            $registros_insertados++;
        } else {
            $errores[] = "Error al insertar horario: " . $stmt->error;
        }
    }
    
    // Verificar si hubo errores
    if (!empty($errores)) {
        throw new Exception("Errores durante la inserción: " . implode("; ", $errores));
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