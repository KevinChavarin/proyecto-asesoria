document.addEventListener('DOMContentLoaded', function() {
    const formulario = document.getElementById('formulario-asesor');
    const dias = document.querySelectorAll('.day');
    const inputDiasSeleccionados = document.getElementById('dias_seleccionados');
    let selectedDays = [];
    
    // Manejar selección de días
    dias.forEach(day => {
        day.addEventListener('click', function() {
            this.classList.toggle('selected');
            const dayValue = this.getAttribute('data-day');
            
            if (this.classList.contains('selected')) {
                if (!selectedDays.includes(dayValue)) {
                    selectedDays.push(dayValue);
                }
            } else {
                selectedDays = selectedDays.filter(d => d !== dayValue);
            }
            
            inputDiasSeleccionados.value = selectedDays.join(',');
        });
    });

    // Validar formulario antes de enviar
    formulario.addEventListener('submit', function(e) {
        if (selectedDays.length === 0) {
            e.preventDefault();
            alert('Por favor selecciona al menos un día disponible');
        }
        
        // Validar que al menos una materia esté seleccionada
        const materias = document.querySelectorAll('input[name="materias[]"]:checked');
        if (materias.length === 0) {
            e.preventDefault();
            alert('Por favor selecciona al menos una materia');
        }
    });
});