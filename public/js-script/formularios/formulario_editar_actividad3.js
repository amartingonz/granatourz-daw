function validarFormulario_editar_actividad3() {
    // Validación del nombre de la actividad
    var nombre = document.getElementById('nombre').value;
    if (nombre.trim() === '') {
      document.getElementById('nombre-error').textContent = 'Este campo es obligatorio';
      return false;
    }
    if (!/^[a-zA-Z\s]+$/.test(nombre)) {
      document.getElementById('nombre-error').textContent = 'Ingrese un nombre válido (solo letras y espacios)';
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
    if (descripcion.trim() === '') {
      document.getElementById('descripcion-error').textContent = 'Este campo es obligatorio';
      return false;
    }
  
    // Validación de la localización
    var localizacion = document.getElementById('localizacion').value;
    if (localizacion.trim() === '') {
      document.getElementById('localizacion-error').textContent = 'Este campo es obligatorio';
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
    if (archivo !== '') {
      var extension = archivo.split('.').pop().toLowerCase();
      var formatosPermitidos = ['jpg', 'jpeg', 'png', 'gif'];
      if (!formatosPermitidos.includes(extension)) {
        document.getElementById('url-error').textContent = 'Error. Formato de imagen no válido (jpg, jpeg, png, gif)';
        return false;
      }
      var tamano = document.getElementById('url').files[0].size;
      var tamanoMaximo = 200000000; // 200KB
      if (tamano > tamanoMaximo) {
        document.getElementById('url-error').textContent = 'Error. Tamaño de imagen excede el límite (200KB)';
        return false;
      }
    }
  
    return true;
  }