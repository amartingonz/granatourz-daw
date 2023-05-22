// Función para validar el formulario
function validarFormularioLogin() {
    var emailInput = document.getElementById('email');
    var passwordInput = document.getElementById('password');
  
    // Validar el campo de email
    var emailValue = emailInput.value.trim();
    if (emailValue === '') {
      emailInput.classList.add('is-invalid');
      emailInput.nextElementSibling.textContent = 'El campo de email es obligatorio.';
      return false;
    } else if (!validarEmail(emailValue)) {
      emailInput.classList.add('is-invalid');
      emailInput.nextElementSibling.textContent = 'Ingrese un correo electrónico válido.';
      return false;
    } else {
      emailInput.classList.remove('is-invalid');
      emailInput.nextElementSibling.textContent = '';
    }
  
    // Validar el campo de contraseña
    if (passwordInput.value.trim() === '') {
      passwordInput.classList.add('is-invalid');
      passwordInput.nextElementSibling.textContent = 'El campo de contraseña es obligatorio.';
      return false;
    } else {
      passwordInput.classList.remove('is-invalid');
      passwordInput.nextElementSibling.textContent = '';
    }
  
    return true; // Permitir el envío del formulario si la validación es exitosa
  }
  
  // Función para validar el formato del correo electrónico utilizando una expresión regular
  function validarEmail(email) {
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
  }
  