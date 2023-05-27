function validarFormularioContacto() {
  var nombreInput = document.getElementById('nombre');
  var emailInput = document.getElementById('email');
  var mensajeInput = document.getElementById('mensaje');

  var nombreValue = nombreInput.value.trim();
  if (nombreValue === '') {
      nombreInput.classList.add('is-invalid');
      nombreInput.nextElementSibling.textContent = 'El campo Nombre es obligatorio.';
      return false;
  } else if (!validarNombre(nombreValue)) {
      nombreInput.classList.add('is-invalid');
      nombreInput.nextElementSibling.textContent = 'El campo Nombre no debe contener números o caracteres especiales.';
      return false;
  } else {
      nombreInput.classList.remove('is-invalid');
      nombreInput.nextElementSibling.textContent = '';
  }

  var emailValue = emailInput.value.trim();
  if (emailValue === '') {
      emailInput.classList.add('is-invalid');
      emailInput.nextElementSibling.textContent = 'El campo Email es obligatorio.';
      return false;
  } else if (!validarEmail(emailValue)) {
      emailInput.classList.add('is-invalid');
      emailInput.nextElementSibling.textContent = 'Ingrese un correo electrónico válido.';
      return false;
  } else {
      emailInput.classList.remove('is-invalid');
      emailInput.nextElementSibling.textContent = '';
  }

  var mensajeValue = mensajeInput.value.trim();
  if (mensajeValue === '') {
      mensajeInput.classList.add('is-invalid');
      mensajeInput.nextElementSibling.textContent = 'El campo Mensaje es obligatorio.';
      return false;
  } else if (mensajeValue.length > 255) {
      mensajeInput.classList.add('is-invalid');
      mensajeInput.nextElementSibling.textContent = 'El campo Mensaje debe tener como máximo 255 caracteres.';
      return false;
  } else {
      mensajeInput.classList.remove('is-invalid');
      mensajeInput.nextElementSibling.textContent = '';
  }

  return true;
}

function validarEmail(email) {
  var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
}

function validarNombre(nombre) {
  var nombreRegex = /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ\s]+$/;
  return nombreRegex.test(nombre);
}

function contarCaracteres(textarea) {
  var contador = document.getElementById('contador-caracteres');
  contador.textContent = textarea.value.length + '/255 caracteres';
}
