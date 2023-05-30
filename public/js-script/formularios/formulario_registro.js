function validarFormularioRegistro() {
  var formulario = document.querySelector('form');

  // Validar DNI
  var dniPattern = /^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKET]{1}$/i;
  var letrasDNI = 'TRWAGMYFPDXBNJZSQVHLCKET';

  if (!dniPattern.test(formulario['data[dni]'].value)) {
    document.getElementById('dni-error').textContent = 'El formato del DNI no es válido.';
    return false;
  }

  var dni = formulario['data[dni]'].value.toUpperCase();
  var letra = dni.charAt(dni.length - 1);
  var numeros = dni.substr(0, dni.length - 1);

  if (letrasDNI.charAt(numeros % 23) !== letra) {
    document.getElementById('dni-error').textContent = 'El DNI no es válido.';
    return false;
  }

  // Validar Nombre y Apellidos
  var nombreApellidosRegex = /^[a-zA-Z\sáéíóúÁÉÍÓÚüÜñÑ',.-]+$/; // Expresión regular actualizada

  var nombre = formulario.elements.nombre.value;
  var apellidos = formulario.elements.apellidos.value;

  if (!nombreApellidosRegex.test(nombre)) {
    document.getElementById('nombre-error').textContent = 'El nombre solo debe contener letras y espacios.';
    return false;
  }

  if (apellidos && !nombreApellidosRegex.test(apellidos)) {
    document.getElementById('apellidos-error').textContent = 'Los apellidos solo deben contener letras y espacios.';
    return false;
  }

  // Validar Email
  var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  if (!emailPattern.test(formulario['data[email]'].value)) {
    document.getElementById('email-error').textContent = 'El formato del email no es válido.';
    return false;
  }

  // Validar Teléfono
  var telefonoPattern = /^\d{9}$/;

  if (!telefonoPattern.test(formulario['data[telefono]'].value)) {
    document.getElementById('telefono-error').textContent = 'El formato del teléfono no es válido.';
    return false;
  }

  // Validar Contraseña
  if (formulario['data[password]'].value.length < 6) {
    document.getElementById('password-error').textContent = 'La contraseña debe tener al menos 6 caracteres.';
    return false;
  }

  // Restablecer mensajes de error anteriores
  document.getElementById('dni-error').textContent = '';
  document.getElementById('nombre-error').textContent = '';
  document.getElementById('apellidos-error').textContent = '';
  document.getElementById('email-error').textContent = '';
  document.getElementById('telefono-error').textContent = '';
  document.getElementById('password-error').textContent = '';

  return true;
}
