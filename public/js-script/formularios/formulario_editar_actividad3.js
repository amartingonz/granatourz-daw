function contarCaracteres(elemento) {
  var descripcion = elemento.value;
  var caracteresMaximos = 255; // Máximo de caracteres permitidos en la descripción
  var contadorCaracteres = descripcion.length;
  var contadorElement = document.getElementById('contador-caracteres');
  contadorElement.textContent = contadorCaracteres + '/' + caracteresMaximos + ' caracteres';

  if (contadorCaracteres > caracteresMaximos) {
    elemento.value = descripcion.substring(0, caracteresMaximos);
  }
}

function limitarCaracteres(elemento, maxCaracteres) {
  if (elemento.value.length > maxCaracteres) {
    elemento.value = elemento.value.substr(0, maxCaracteres);
  }
  var contadorElement = document.getElementById('contador-caracteres');
  contadorElement.textContent = elemento.value.length + '/' + maxCaracteres + ' caracteres';
}

function validarFormulario_editar_actividad3() {
  // Validación del nombre de la actividad
  var nombre = document.getElementById('nombre').value;
  if (nombre.trim() === '') {
    document.getElementById('nombre-error').textContent = 'Este campo es obligatorio';
    return false;
  }
  if (!/^[\w\sáéíóúÁÉÍÓÚüÜñÑ'-]*$/u.test(nombre)) {
    document.getElementById('nombre-error').textContent = 'Ingrese un nombre válido (solo letras, espacios, tildes, guiones y comillas)';
    return false;
  }

  // Validación de la duración
  var duracion = document.getElementById('duracion').value;
  if (duracion.trim() === '') {
    document.getElementById('duracion-error').textContent = 'Este campo es obligatorio';
    return false;
  }
  if (!/^\d+$/.test(duracion)) {
    document.getElementById('duracion-error').textContent = 'Ingrese una duración válida (solo números enteros)';
    return false;
  }

  // Validación de la descripción
  var descripcion = document.getElementById('descripcion').value;
  var caracteresMaximos = 255; // Máximo de caracteres permitidos en la descripción
  var contadorCaracteres = descripcion.length;

  if (descripcion.trim() === '') {
    document.getElementById('descripcion-error').textContent = 'Este campo es obligatorio';
    return false;
  }
  if (contadorCaracteres > caracteresMaximos) {
    document.getElementById('descripcion-error').textContent = 'La descripción supera el límite de caracteres';
    return false;
  }

  // Limitar la entrada de texto a 255 caracteres
  descripcion = descripcion.slice(0, caracteresMaximos);
  document.getElementById('descripcion').value = descripcion;

  // Actualizar contador de caracteres
  var contadorElement = document.getElementById('contador-caracteres');
  contadorElement.textContent = contadorCaracteres + '/' + caracteresMaximos + ' caracteres';

  // Validación de la localización
  var localizacion = document.getElementById('localizacion').value;
  if (localizacion.trim() === '') {
    document.getElementById('localizacion-error').textContent = 'Este campo es obligatorio';
    return false;
  }
  if (!/^[\w\sáéíóúÁÉÍÓÚüÜñÑ-]+$/.test(localizacion)) {
    document.getElementById('localizacion-error').textContent = 'Ingrese una localización válida (solo letras, espacios, guiones y tildes)';
    return false;
  }

  // Validación de la hora
  var hora = document.getElementById('hora').value;
  if (hora.trim() === '') {
    document.getElementById('hora-error').textContent = 'Este campo es obligatorio';
    return false;
  }

  // Validación de la fecha
  var fecha = document.getElementById('fecha').value;
  var fechaActual = new Date().toISOString().split('T')[0];
  if (fecha < fechaActual) {
    document.getElementById('fecha-error').textContent = 'Ingrese una fecha válida (a partir de hoy)';
    return false;
  }

  // Validación de la capacidad
  var capacidad = document.getElementById('capacidad').value;
  if (capacidad.trim() === '') {
    document.getElementById('capacidad-error').textContent = 'Este campo es obligatorio';
    return false;
  }
  if (!/^\d+$/.test(capacidad)) {
    document.getElementById('capacidad-error').textContent = 'Ingrese una capacidad válida (solo números enteros)';
    return false;
  }

  // Control de las imágenes
  var archivo = document.getElementById('url').value;
  if (archivo === '') {
    document.getElementById('url-error').textContent = 'Este campo es obligatorio';
    return false;
  }

  var extension = archivo.split('.').pop().toLowerCase();
  var formatosPermitidos = ['jpg', 'jpeg', 'png', 'webp'];
  if (!formatosPermitidos.includes(extension)) {
    document.getElementById('url-error').textContent = 'Error. Formato de imagen no válido (jpg, jpeg, png, webp)';
    return false;
  }

  var tamano = document.getElementById('url').files[0].size;
  var tamanoMaximo = 200000; // 200KB
  if (tamano > tamanoMaximo) {
    document.getElementById('url-error').textContent = 'Error. Tamaño de imagen excede el límite (200KB)';
    return false;
  }
  
  return true;
}
