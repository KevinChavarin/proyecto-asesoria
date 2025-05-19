<?php
// Conexión a la base de datos
include ("back/conectarbd.php"); // Archivo con la conexi�n a la BD
$conn = new mysqli($host, $usuario, $contrasena, $base_datos);


// Consulta para obtener materias disponibles
$query_materias = "
    SELECT DISTINCT m.materia_id, m.materia_nombre 
    FROM cid_materia m
    JOIN cid_horario_materia_asesoria hma ON m.materia_id = hma.hMateria_materia
    JOIN cid_horario_asesor ha ON hma.hMateria_asesor = ha.horario_idasesor
    WHERE ha.horario_estatus = '1'
    ORDER BY m.materia_nombre
";
$materias = $conn->query($query_materias);

// Procesar selección de materia
$horarios = [];
$materia_seleccionada = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['materia_id'])) {
    $materia_id = $conn->real_escape_string($_POST['materia_id']);
    
    // Obtener información de la materia seleccionada
    $query_materia = "SELECT materia_nombre FROM cid_materia WHERE materia_id = $materia_id";
    $materia_seleccionada = $conn->query($query_materia)->fetch_assoc();
    
    // Consulta para horarios disponibles
    $query_horarios = "
        SELECT 
            ha.horario_id,
            ha.horario_dia,
            TIME_FORMAT(ha.horario_hora, '%H:%i') as hora_formateada,
            a.asesor_nombre,
            a.asesor_id
        FROM cid_horario_asesor ha
        JOIN cid_horario_materia_asesoria hma ON ha.horario_idasesor = hma.hMateria_asesor
        JOIN cid_asesor a ON ha.horario_idasesor = a.asesor_id
        WHERE hma.hMateria_materia = $materia_id
        AND ha.horario_estatus = '1'
        ORDER BY 
            FIELD(ha.horario_dia, 'Lunes', 'Martes', 'Mi�rcoles', 'Jueves', 'Viernes', 'S�bado', 'Domingo'),
            ha.horario_hora
    ";
    
    $horarios = $conn->query($query_horarios);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Asesor&iacute;as Acad&eacute;micas</title>
    <link rel="stylesheet" href="css/style_index.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Sistema de Asesorias Acad&eacute;micas</h1>
        </header>

        <main>
            <!-- Formulario de selecci�n de materia -->
            <form method="POST" class="card">
                <h2>1. Selecciona una materia</h2>
                <select name="materia_id" class="form-select" required>
                    <option value="">-- Selecciona una materia --</option>
                    <?php while($materia = $materias->fetch_assoc()): ?>
                        <option value="<?= $materia['materia_id'] ?>" 
                            <?= isset($_POST['materia_id']) && $_POST['materia_id'] == $materia['materia_id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($materia['materia_nombre']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
                <button type="submit" class="btn">Buscar Horarios</button>
            </form>

            <!-- Resultados: Horarios disponibles -->
            <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['materia_id'])): ?>
                <div class="card">
                    <h2>2. Horarios disponibles para <?= htmlspecialchars($materia_seleccionada['materia_nombre']) ?></h2>
                    
                    <?php if ($horarios->num_rows > 0): ?>
                        <form method="POST" action="registrar_asesoria.php">
                            <input type="hidden" name="materia_id" value="<?= htmlspecialchars($_POST['materia_id']) ?>">
                            <input type="hidden" name="materia_nombre" value="<?= htmlspecialchars($materia_seleccionada['materia_nombre']) ?>">
                            
                            <div class="horarios-grid">
                                <?php while($horario = $horarios->fetch_assoc()): ?>
                                    <div class="horario-card">
                                        <label>
                                            <input type="radio" name="horario_id" value="<?= $horario['horario_id'] ?>" required>
                                            <strong><?= htmlspecialchars($horario['horario_dia']) ?></strong>
                                            <span><?= htmlspecialchars($horario['hora_formateada']) ?></span>
                                            <small>Asesor: <?= htmlspecialchars($horario['asesor_nombre']) ?></small>
                                        </label>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                            
                            
                        </form>
                    <?php else: ?>
                        <p class="no-results">No hay horarios disponibles para esta materia.</p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </main>
    </div>
    <button onclick="window.location.href='./index.php'" class="btn">Volver al inicio</button>
</body>
</html>