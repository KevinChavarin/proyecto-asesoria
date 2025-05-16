<?php
// Inicializar array para almacenar los horarios seleccionados
$horarios_seleccionados = array();

// Patrón para identificar los nombres de los checkboxes (día_hora)
$patron = '/^(lun|mar|mie|jue|vie|sab|dom)_\d{2}$/';

// Recorrer todos los datos POST recibidos
foreach ($_POST as $nombre => $valor) {
    // Verificar si el campo es un checkbox de horario
    if (preg_match($patron, $nombre)) {
        // Los checkboxes solo aparecen en $_POST cuando están marcados
        $horarios_seleccionados[] = $nombre;
    }
}



// Si necesitas procesar estos datos para MySQL:
if (!empty($horarios_seleccionados)) {
    // Aquí puedes convertir los códigos a un formato para tu base de datos
    // Ejemplo: separar día y hora
    $horarios_procesados = array();
    
    foreach ($horarios_seleccionados as $horario) {
        list($dia, $hora) = explode('_', $horario);
        $horarios_procesados[] = array(
            'dia' => $dia,
            'hora' => $hora.':00' // Convertir a formato hora (ej: "08" -> "08:00")
        );
    }
    

} else {
    echo "No se seleccionaron horarios.";
}
?>