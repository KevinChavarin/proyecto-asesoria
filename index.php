<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Asesores</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <main class="container">
        <h1>Registro de Asesores</h1>
        
        <form id="formulario-asesor" action="Back/procesar_asesor.php" method="POST">
            <label>
                Código de Estudiante:
                <input type="text" name="codigo_estudiante" required placeholder="Ej: A12345">
            </label>
            
            <label>
                Nombre Completo:
                <input type="text" name="nombre" required placeholder="Nombre(s) Apellidos">
            </label>
            
            <label>
                Carrera:
                <?php 
                    include("back/listadocarreras.php");
                ?>
            </label>
            
            <label>
                Periodo:
                <select name="periodo" required>
                    <option value="">Seleccione un periodo</option>
                    <option value="Enero-Abril 2024">Enero-Abril 2024</option>
                    <option value="Mayo-Agosto 2024">Mayo-Agosto 2024</option>
                    <option value="Agosto-Noviembre 2025-B">Agosto-Noviembre 2025-B</option>
                    <option value="Enero-Mayo 2026-A">Enero-Mayo 2026-A</option>
                </select>
            </label>
            
            <fieldset>
                <legend>Materias que puede asesorar:</legend>
                <?php 
                    include("back/listadomaterias.php");
                ?>
            </fieldset>
			<button type="button" onclick="agregarMateria()">Agregar Materia</button>
            <h3>Materias seleccionadas:</h3>
            <ul id="listaMaterias"></ul>

            <!-- Campo oculto para enviar los IDs -->
            <input type="hidden" name="materias_seleccionadas" id="materias_seleccionadas">
            <table>
                <thead>
                <tr>
                    <th>Día / Hora</th>
                    <!-- Generar columnas de hora de 08 a 19 -->
                    <!-- Puedes generar esto con un lenguaje de servidor, pero aquí lo hago manualmente -->
                    <th>08:00</th>
                    <th>09:00</th>
                    <th>10:00</th>
                    <th>11:00</th>
                    <th>12:00</th>
                    <th>13:00</th>
                    <th>14:00</th>
                    <th>15:00</th>
                    <th>16:00</th>
                    <th>17:00</th>
                    <th>18:00</th>
                    <th>19:00</th>
                </tr>
                </thead>
                <tbody>
                <!-- Lista de días abreviados -->
                <!-- Cada fila representa un día -->
                <!-- Puedes replicar este bloque para cada día -->
                <!-- Lunes -->
                <tr>
                    <td>Lunes</td>
                    <td><input type="checkbox" name="lun_08"></td>
                    <td><input type="checkbox" name="lun_09"></td>
                    <td><input type="checkbox" name="lun_10"></td>
                    <td><input type="checkbox" name="lun_11"></td>
                    <td><input type="checkbox" name="lun_12"></td>
                    <td><input type="checkbox" name="lun_13"></td>
                    <td><input type="checkbox" name="lun_14"></td>
                    <td><input type="checkbox" name="lun_15"></td>
                    <td><input type="checkbox" name="lun_16"></td>
                    <td><input type="checkbox" name="lun_17"></td>
                    <td><input type="checkbox" name="lun_18"></td>
                    <td><input type="checkbox" name="lun_19"></td>
                </tr>
                <!-- Martes -->
                <tr>
                    <td>Martes</td>
                    <td><input type="checkbox" name="mar_08"></td>
                    <td><input type="checkbox" name="mar_09"></td>
                    <td><input type="checkbox" name="mar_10"></td>
                    <td><input type="checkbox" name="mar_11"></td>
                    <td><input type="checkbox" name="mar_12"></td>
                    <td><input type="checkbox" name="mar_13"></td>
                    <td><input type="checkbox" name="mar_14"></td>
                    <td><input type="checkbox" name="mar_15"></td>
                    <td><input type="checkbox" name="mar_16"></td>
                    <td><input type="checkbox" name="mar_17"></td>
                    <td><input type="checkbox" name="mar_18"></td>
                    <td><input type="checkbox" name="mar_19"></td>
                </tr>
                <!-- Miércoles -->
                <tr>
                    <td>Miércoles</td>
                    <td><input type="checkbox" name="mie_08"></td>
                    <td><input type="checkbox" name="mie_09"></td>
                    <td><input type="checkbox" name="mie_10"></td>
                    <td><input type="checkbox" name="mie_11"></td>
                    <td><input type="checkbox" name="mie_12"></td>
                    <td><input type="checkbox" name="mie_13"></td>
                    <td><input type="checkbox" name="mie_14"></td>
                    <td><input type="checkbox" name="mie_15"></td>
                    <td><input type="checkbox" name="mie_16"></td>
                    <td><input type="checkbox" name="mie_17"></td>
                    <td><input type="checkbox" name="mie_18"></td>
                    <td><input type="checkbox" name="mie_19"></td>
                </tr>
                <!-- Jueves -->
                <tr>
                    <td>Jueves</td>
                    <td><input type="checkbox" name="jue_08"></td>
                    <td><input type="checkbox" name="jue_09"></td>
                    <td><input type="checkbox" name="jue_10"></td>
                    <td><input type="checkbox" name="jue_11"></td>
                    <td><input type="checkbox" name="jue_12"></td>
                    <td><input type="checkbox" name="jue_13"></td>
                    <td><input type="checkbox" name="jue_14"></td>
                    <td><input type="checkbox" name="jue_15"></td>
                    <td><input type="checkbox" name="jue_16"></td>
                    <td><input type="checkbox" name="jue_17"></td>
                    <td><input type="checkbox" name="jue_18"></td>
                    <td><input type="checkbox" name="jue_19"></td>
                </tr>
                <!-- Viernes -->
                <tr>
                    <td>Viernes</td>
                    <td><input type="checkbox" name="vie_08"></td>
                    <td><input type="checkbox" name="vie_09"></td>
                    <td><input type="checkbox" name="vie_10"></td>
                    <td><input type="checkbox" name="vie_11"></td>
                    <td><input type="checkbox" name="vie_12"></td>
                    <td><input type="checkbox" name="vie_13"></td>
                    <td><input type="checkbox" name="vie_14"></td>
                    <td><input type="checkbox" name="vie_15"></td>
                    <td><input type="checkbox" name="vie_16"></td>
                    <td><input type="checkbox" name="vie_17"></td>
                    <td><input type="checkbox" name="vie_18"></td>
                    <td><input type="checkbox" name="vie_19"></td>
                </tr>
                <!-- Sábado -->
                <tr>
                    <td>Sábado</td>
                    <td><input type="checkbox" name="sab_08"></td>
                    <td><input type="checkbox" name="sab_09"></td>
                    <td><input type="checkbox" name="sab_10"></td>
                    <td><input type="checkbox" name="sab_11"></td>
                    <td><input type="checkbox" name="sab_12"></td>
                    <td><input type="checkbox" name="sab_13"></td>
                    <td><input type="checkbox" name="sab_14"></td>
                    <td><input type="checkbox" name="sab_15"></td>
                    <td><input type="checkbox" name="sab_16"></td>
                    <td><input type="checkbox" name="sab_17"></td>
                    <td><input type="checkbox" name="sab_18"></td>
                    <td><input type="checkbox" name="sab_19"></td>
                </tr>
                <!-- Domingo -->
                <tr>
                    <td>Domingo</td>
                    <td><input type="checkbox" name="dom_08"></td>
                    <td><input type="checkbox" name="dom_09"></td>
                    <td><input type="checkbox" name="dom_10"></td>
                    <td><input type="checkbox" name="dom_11"></td>
                    <td><input type="checkbox" name="dom_12"></td>
                    <td><input type="checkbox" name="dom_13"></td>
                    <td><input type="checkbox" name="dom_14"></td>
                    <td><input type="checkbox" name="dom_15"></td>
                    <td><input type="checkbox" name="dom_16"></td>
                    <td><input type="checkbox" name="dom_17"></td>
                    <td><input type="checkbox" name="dom_18"></td>
                    <td><input type="checkbox" name="dom_19"></td>
                </tr>
                </tbody>
            </table>
            
            <button type="submit" class="btn">Registrar Asesor</button>
        </form>
    </main>

    <script src="js/script.js"></script>
	<script src="js/agregarmateria.js"></script>
</body>
</html> 
<!-- holaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa -->