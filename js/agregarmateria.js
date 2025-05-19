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
            botonEliminar.classList.add = "btn-eliminar";
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