<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Seleccionar Materias</title>
    <style>
        .materia-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 5px;
            max-width: 400px;
        }
        .materia-item button {
            margin-left: 10px;
            color: white;
            background-color: red;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            padding: 2px 6px;
        }
    </style>
</head>
<body>
    <form id="formulario">
        <label for="materia">Selecciona una materia:</label>
        <select id="materia">
            <option value="">-- Elige una materia --</option>
            <?php
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

            if (idsSeleccionados.includes(id)) {
                alert("La materia ya fue agregada.");
                return;
            }

            idsSeleccionados.push(id);
            actualizarCampoOculto();

            const li = document.createElement("li");
            li.className = "materia-item";
            li.setAttribute("data-id", id);

            const texto = document.createElement("span");
            texto.textContent = nombre + " (ID: " + id + ")";

            const botonEliminar = document.createElement("button");
            botonEliminar.textContent = "Eliminar";
            botonEliminar.onclick = function() {
                eliminarMateria(id, li);
            };

            li.appendChild(texto);
            li.appendChild(botonEliminar);
            document.getElementById("listaMaterias").appendChild(li);
        }

        function eliminarMateria(id, elementoLi) {
            // Quitar del arreglo
            idsSeleccionados = idsSeleccionados.filter(item => item !== id);
            // Quitar del DOM
            elementoLi.remove();
            // Actualizar campo oculto
            actualizarCampoOculto();
        }

        function actualizarCampoOculto() {
            document.getElementById("materias_seleccionadas").value = idsSeleccionados.join(",");
        }
    </script>
</body>
</html>
