function validarFormulario_editar_datos() {
  var formulario = document.querySelector('form');

  // Obtener los valores de los campos del formulario
  var nombre = formulario.elements['data[nombre]'].value;
  var apellidos = formulario.elements['data[apellidos]'].value;
  var email = formulario.elements['data[email]'].value;
  var telefono = formulario.elements['data[telefono]'].value;
  var password = formulario.elements['data[password]'].value;

  // Validar el campo nombre (solo letras)
  var nombreRegex = /^[a-zA-Z\sáéíóúÁÉÍÓÚüÜñÑ]+$/;
  if (!nombreRegex.test(nombre)) {
    formulario.elements['data[nombre]'].nextElementSibling.textContent = "El campo de nombre solo puede contener letras.";
    return false;
  } else {
    formulario.elements['data[nombre]'].nextElementSibling.textContent = "";
  }

  // Validar el campo apellidos (letras, espacios y tildes)
  var apellidosRegex = /^[a-zA-Z\sáéíóúÁÉÍÓÚüÜñÑ]+$/;
  if (!apellidosRegex.test(apellidos)) {
    formulario.elements['data[apellidos]'].nextElementSibling.textContent = "El campo de apellidos solo puede contener letras, espacios y tildes.";
    return false;
  } else {
    formulario.elements['data[apellidos]'].nextElementSibling.textContent = "";
  }

  // Validar el campo email (formato válido)
  var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailRegex.test(email)) {
    formulario.elements['data[email]'].nextElementSibling.textContent = "Por favor, introduce un correo electrónico válido.";
    return false;
  } else {
    formulario.elements['data[email]'].nextElementSibling.textContent = "";
  }

  // Validar el campo teléfono (número de teléfono móvil)
  var telefonoRegex = /^[6-9]\d{8}$/;
  if (!telefonoRegex.test(telefono)) {
    formulario.elements['data[telefono]'].nextElementSibling.textContent = "Por favor, introduce un número de teléfono móvil válido.";
    return false;
  } else {
    formulario.elements['data[telefono]'].nextElementSibling.textContent = "";
  }

  // Validar el campo contraseña (mínimo 6 caracteres)
  if (password.length < 6) {
    formulario.elements['data[password]'].nextElementSibling.textContent = "La contraseña debe tener al menos 6 caracteres.";
    return false;
  } else {
    formulario.elements['data[password]'].nextElementSibling.textContent = "";
  }

  // Si todas las validaciones pasan, enviar el formulario
  return true;
}
