<!-- FORMULARIO DE EDITAR ACTIVIDAD -->

<div class="container-fluid p-5">
  <div class="row justify-content-center">
    <div class="col-sm-6 col-md-4 p-5">
      <h2 class="text-center mt-3">Editar Actividad</h2>
      <div style="overflow-x: hidden;">
        <form action="<?= $_ENV['BASE_URL']?>editar_actividad" method="post" enctype="multipart/form-data" class="needs-validation mt-4" novalidate onsubmit="return validarFormulario_editar_actividad3();">
          <input type="hidden" name="data[id_actividad]" value="<?php echo $id_actividad; ?>">

          <div class="form-group">
            <label for="nombre">Nombre de la actividad:</label>
            <input type="text" name="data[nombre]" id="nombre" class="form-control" required>
            <span class="text-danger" id="nombre-error"></span>
          </div>

          <div class="form-group">
            <label for="duracion">Duración (en minutos):</label>
            <input type="number" name="data[duracion]" id="duracion" class="form-control" required>
            <span class="text-danger" id="duracion-error"></span>
          </div>

          <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <br>
            <textarea name="data[descripcion]" id="descripcion" cols="30" rows="10" class="form-control" oninput="contarCaracteres(this)"></textarea>
            <span class="text-danger" id="descripcion-error"></span>
            <small id="contador-caracteres" class="form-text text-muted">0/255 caracteres</small>
          </div>

          <div class="form-group">
            <label for="localizacion">Localización:</label>
            <input type="text" name="data[localizacion]" id="localizacion" class="form-control" required>
            <span class="text-danger" id="localizacion-error"></span>
          </div>

          <div class="form-group">
            <label for="hora">Hora:</label>
            <br>
            <input type="time" name="data[hora]" id="hora" class="form-control" required>
            <span class="text-danger" id="hora-error"></span>
          </div>

          <div class="form-group">
            <label for="fecha">Fecha:</label>
            <br>
            <input type="date" name="data[fecha]" id="fecha" class="form-control" required>
            <span class="text-danger" id="fecha-error"></span>
          </div>

          <div class="form-group">
            <label for="capacidad">Capacidad:</label>
            <br>
            <input type="number" name="data[capacidad]" id="capacidad" class="form-control" required>
            <span class="text-danger" id="capacidad-error"></span>
          </div>

          <div class="form-group">
            <label for="imagen">Imagen:</label>
            <input type="file" name="data[url]" id="url" class="form-control-file" required>
            <span class="text-danger" id="url-error"></span>
          </div>

          <div class="form-group text-center">
            <button type="submit" name="editar_actividad" class="btn btn-primary btn-block mt-4">Editar actividad</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
