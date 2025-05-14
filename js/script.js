document.addEventListener('DOMContentLoaded', function() {
    const formulario = document.getElementById('formulario-asesor');
    
    // Validar formulario antes de enviar
    formulario.addEventListener('submit', function(e) {
        let isValid = true;
        let errorMessage = '';
        
        // 1. Validar código de estudiante
        const codigoEstudiante = document.querySelector('input[name="codigo_estudiante"]');
        if (!codigoEstudiante.value.trim()) {
            isValid = false;
            errorMessage += 'El código de estudiante es obligatorio.\n';
        }
        
        // 2. Validar nombre completo
        const nombreCompleto = document.querySelector('input[name="nombre"]');
        if (!nombreCompleto.value.trim()) {
            isValid = false;
            errorMessage += 'El nombre completo es obligatorio.\n';
        }
        
        // 3. Validar carrera
        const carrera = document.querySelector('select[name="carrera"]');
        if (!carrera.value) {
            isValid = false;
            errorMessage += 'Debes seleccionar una carrera.\n';
        }
        
        // 4. Validar periodo
        const periodo = document.querySelector('select[name="periodo"]');
        if (!periodo.value) {
            isValid = false;
            errorMessage += 'Debes seleccionar un periodo.\n';
        }
        
        // 5. Validar materias seleccionadas (campo oculto)
        const materiasSeleccionadas = document.getElementById('materias_seleccionadas').value;
        if (!materiasSeleccionadas) {
            isValid = false;
            errorMessage += 'Debes seleccionar al menos una materia.\n';
        }
        
        // 6. Validar horarios (al menos un checkbox marcado)
        const checkboxesHorarios = document.querySelectorAll('table input[type="checkbox"]');
        let alMenosUnHorario = false;
        
        checkboxesHorarios.forEach(checkbox => {
            if (checkbox.checked) {
                alMenosUnHorario = true;
            }
        });
        
        if (!alMenosUnHorario) {
            isValid = false;
            errorMessage += 'Debes seleccionar al menos un horario disponible.\n';
        }
        
   
    });

});