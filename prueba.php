<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Seleccionar Materias</title>
</head>
<body>
    <form id="formulario">
        <!-- Lista desplegable cargada desde PHP -->
        <label for="materia">Selecciona una materia:</label>
        <select id="materia">
            <option value="">-- Elige una materia --</option>
            <?php
            // Suponiendo que ya hiciste la conexi�n
            $conexion = new mysqli("localhost", "root", "", "cid_cita");
            $sql = "SELECT materia_id, materia_nombre FROM cid_materia ORDER BY materia_nombre ASC";
            $resultado = $conexion->query($sql);
            while ($fila = $resultado->fetch_assoc()) {
                echo '<option value="' . $fila["materia_id"] . '">' . htmlspecialchars($fila["materia_nombre"]) . '</option>';
            }
            $conexion->close();
            ?>
        </select>

        <button type="button" onclick="agregarMateria()">Agregar Materia</button>

        <h3>Materias seleccionadas:</h3>
        <ul id="listaMaterias"></ul>

        <!-- Campo oculto para enviar los IDs -->
        <input type="hidden" name="materias_seleccionadas" id="materias_seleccionadas">
    </form>

    <script>
        let idsSeleccionados = [];

        function agregarMateria() {
            const select = document.getElementById("materia");
            const id = select.value;
            const nombre = select.options[select.selectedIndex].text;

            if (id === "") {
                alert("Selecciona una materia válida.");
                return;
            }

            // Evitar duplicados
            if (idsSeleccionados.includes(id)) {
                alert("La materia ya fue agregada.");
                return;
            }

            // Agregar al arreglo de IDs
            idsSeleccionados.push(id);

            // Actualizar campo oculto con los IDs separados por coma
            document.getElementById("materias_seleccionadas").value = idsSeleccionados.join(",");

            // Mostrar en lista
            const li = document.createElement("li");
            li.textContent = nombre + " (ID: " + id + ")";
            document.getElementById("listaMaterias").appendChild(li);
        }
    </script>
</body>
</html>
