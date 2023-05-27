function validarFormulario_crear_categoria() {
    // Obtener el valor del campo de nombre de categoría
    var nombre = document.getElementById('nombre').value;

    // Expresión regular para permitir caracteres alfabéticos, tildes y espacios
    var regex = /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ\s]+$/;

    // Obtener el elemento <span> para el mensaje de error
    var errorNombre = document.getElementById('error-nombre');

    // Validar el campo de nombre de categoría
    if (nombre.trim() === '') {
        errorNombre.textContent = 'El campo de nombre de categoría es obligatorio.';
        return false; // Evitar el envío del formulario si la validación falla
    } else if (!regex.test(nombre)) {
        errorNombre.textContent = 'Ingrese un nombre de categoría válido. Solo se permiten caracteres alfabéticos, tildes y espacios.';
        return false; // Evitar el envío del formulario si la validación falla
    }

    // Limpiar el mensaje de error si la validación es exitosa
    errorNombre.textContent = '';

    return true; // Permitir el envío del formulario si la validación es exitosa
}
