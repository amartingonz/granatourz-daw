<!-- FORMULARIO PARA CREAR ACTIVIDAD -->

<?php 

    if(isset($_SESSION['admin'])){
        $id = $_SESSION['id_admin'];
    }
    if(isset($_SESSION['organizador'])){
        $id = $_SESSION['id_organizador'];
    }
?>

<div class="container-fluid p-5">
  <div class="row justify-content-center">
    <div class="col-sm-6 col-md-4 p-5">
      <h2 class="text-center mt-3">Crear Actividad</h2>
      <div style="overflow-x: hidden;">
        <form action="<?= $_ENV['BASE_URL']?>crear_actividad" method="post" enctype="multipart/form-data" class="needs-validation mt-4" novalidate onsubmit="return validarFormulario_crear_actividad();">

          <input type="hidden" name="data[id_usuario]" value="<?= $id ?>">

          <div class="form-group">
            <label for="categoria">Categoría:</label>
            <select name="data[categoria]" class="form-control" required>
              <?php foreach($categorias as $categoria) {
                echo "<option>".$categoria['nombre']."</option>";
              } ?>
            </select>
          </div>

          <div class="form-group">
            <label for="nombre">Nombre de la actividad:</label>
            <input type="text" name="data[nombre]" id="nombre" class="form-control" placeholder="Ejemplo: Ruta al centro" required>
            <span class="text-danger" id="nombre-error"></span>
          </div>

          <div class="form-group">
            <label for="duracion">Duración (en minutos):</label>
            <input type="number" name="data[duracion]" id="duracion" class="form-control" placeholder="Ejemplo: 20" required>
            <span class="text-danger" id="duracion-error"></span>
          </div>

          <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <textarea name="data[descripcion]" id="descripcion" cols="30" rows="10" class="form-control" maxlength="255" oninput="contarCaracteres(this)"></textarea>
            <div class="invalid-feedback" id="descripcion-error"></div>
            <small id="contador-caracteres" class="form-text text-muted">0/255 caracteres</small>
          </div>

          <div class="form-group">
            <label for="localizacion">Localización:</label>
            <input type="text" name="data[localizacion]" id="localizacion" class="form-control" placeholder="Ejemplo: Granada"  required>
            <span class="text-danger" id="localizacion-error"></span>
          </div>

          <div class="form-group">
            <label for="hora">Hora:</label>
            <input type="time" name="data[hora]" id="hora" class="form-control" required>
            <span class="text-danger" id="hora-error"></span>
          </div>

          <div class="form-group">
            <label for="fecha">Fecha:</label>
            <input type="date" name="data[fecha]" id="fecha" class="form-control" required>
            <span class="text-danger" id="fecha-error"></span>
          </div>

          <div class="form-group">
            <label for="capacidad">Capacidad:</label>
            <input type="number" name="data[capacidad]" id="capacidad" class="form-control" placeholder="Ejemplo: 20" required>
            <span class="text-danger" id="capacidad-error"></span>
          </div>

          <div class="form-group">
            <label for="imagen">Imagen:</label>
            <input type="file" name="data[url]" id="url" class="form-control-file" required>
            <span class="text-danger" id="url-error"></span>
          </div>

          <div class="form-group text-center">
            <button type="submit" class="btn btn-primary btn-block mt-4">Crear actividad</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
