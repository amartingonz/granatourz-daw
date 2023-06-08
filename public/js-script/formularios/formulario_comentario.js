function validarFormulario_crear_comentario() {
    var urlInput = document.getElementById('url');
    var textoInput = document.getElementById('texto');
    var valoracionInput = document.getElementById('valoracion');
  
    // Validar el campo de imagen (opcional)
  
    // Obtener el archivo seleccionado
    var selectedFile = urlInput.files[0];
  
    // Verificar si se seleccionó un archivo
    if (selectedFile) {
      // Obtener la extensión del archivo
      var fileExtension = selectedFile.name.split('.').pop().toLowerCase();
  
      // Validar la extensión del archivo
      var allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
      if (!allowedExtensions.includes(fileExtension)) {
        urlInput.classList.add('is-invalid');
        urlInput.nextElementSibling.textContent = 'Por favor, selecciona un archivo de imagen válido (JPG, JPEG, PNG, WEBP).';
        return false;
      } else {
        urlInput.classList.remove('is-invalid');
        urlInput.nextElementSibling.textContent = '';
      }
    }
  
    // Validar el campo de comentario (no vacío)
    var textoValue = textoInput.value.trim();
    if (textoValue === '') {
      textoInput.classList.add('is-invalid');
      textoInput.nextElementSibling.textContent = 'El campo de comentario es obligatorio.';
      return false;
    } else {
      textoInput.classList.remove('is-invalid');
      textoInput.nextElementSibling.textContent = '';
    }
  
    // Validar el campo de valoración (rango de 1 a 5)
    var valoracionValue = parseInt(valoracionInput.value);
    if (isNaN(valoracionValue) || valoracionValue < 1 || valoracionValue > 10) {
      valoracionInput.classList.add('is-invalid');
      valoracionInput.nextElementSibling.textContent = 'Por favor, introduce una valoración válida (entre 1 y 10).';
      return false;
    } else {
      valoracionInput.classList.remove('is-invalid');
      valoracionInput.nextElementSibling.textContent = '';
    }
  
    return true; // Permitir el envío del formulario si la validación es exitosa
  }
  