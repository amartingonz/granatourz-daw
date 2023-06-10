function validarFormulario_editar_datos() {
  var formulario = document.querySelector('form');

  // Obtener los valores de los campos del formulario
  var nombre = formulario.elements['data[nombre]'].value;
  var apellidos = formulario.elements['data[apellidos]'].value;
  var telefono = formulario.elements['data[telefono]'].value;
  var password = formulario.elements['data[password]'].value;

  // Validar el campo nombre (solo letras)
  var nombreRegex = /^[a-zA-Z\sáéíóúÁÉÍÓÚüÜñÑ\s]+$/;
  if (!nombreRegex.test(nombre)) {
    document.getElementById('nombre-error').textContent = "El campo de nombre solo puede contener letras.";
    return false;
  } else {
    document.getElementById('nombre-error').textContent = "";
  }

  // Validar el campo apellidos (letras, espacios y tildes)
  var apellidosRegex = /^[a-zA-Z\sáéíóúÁÉÍÓÚüÜñÑ\s]+$/;
  if (!apellidosRegex.test(apellidos)) {
    document.getElementById('apellidos-error').textContent = "El campo de apellidos solo puede contener letras, espacios y tildes.";
    return false;
  } else {
    document.getElementById('apellidos-error').textContent = "";
  }

  // Validar el campo teléfono (número de teléfono móvil)
  var telefonoRegex = /^[6-9]\d{8}$/;
  if (!telefonoRegex.test(telefono)) {
    document.getElementById('telefono-error').textContent = "Por favor, introduce un número de teléfono móvil válido.";
    return false;
  } else {
    document.getElementById('telefono-error').textContent = "";
  }

  // Validar el campo contraseña (mínimo 6 caracteres)
  if (password.length < 6) {
    document.getElementById('password-error').textContent = "La contraseña debe tener al menos 6 caracteres.";
    return false;
  } else {
    document.getElementById('password-error').textContent = "";
  }

  // Si todas las validaciones pasan, enviar el formulario
  return true;
}
