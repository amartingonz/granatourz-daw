<!-- FORMULARIO DE EDITAR ACTIVIDAD -->

<div class="container-fluid p-5">
  <div class="row justify-content-center">
    <div class="col-sm-6 col-md-4 p-5">
      <h2 class="text-center mt-3">Editar Actividad</h2>
      <form action="<?= $_ENV['BASE_URL']?>editar_actividad" method="post" enctype="multipart/form-data" class="needs-validation mt-4" novalidate>
        <div class="form-group">
          <label for="categoria">Categoría:</label>
          <br>
          <select name="data[categoria]" id="categoria" class="form-control">
            <?php foreach($categorias as $categoria) {
              echo "<option>".$categoria['nombre']."</option>";
            }
            ?>
          </select>
        </div>
        
        <div class="form-group">
          <label for="nombre">Nombre de la actividad:</label>
          <select name="data[id_actividad]" id="nombre" class="form-control">
            <?php foreach($actividades as $actividad) {
              echo "<option value=".$actividad['id_actividad'].">".$actividad['nombre']."</option>";
            }
            ?>
          </select>
          <span class="text-danger">
            <?php if(isset($_SESSION['errores'])){
              if(isset($_SESSION['errores']['nombre'])){
                echo $_SESSION['errores']['nombre'];
              }
            } ?>
          </span>
        </div>
        
        <div class="form-group">
          <label for="descripcion">Descripción:</label>
          <br>
          <textarea name="data[descripcion]" id="descripcion" cols="30" rows="10" class="form-control"></textarea>
          <span class="text-danger">
            <?php if(isset($_SESSION['errores'])){
              if(isset($_SESSION['errores']['descripcion'])){
                echo $_SESSION['errores']['descripcion'];
              }
            } ?>
          </span>
        </div>
        
        <div class="form-group">
          <label for="localizacion">Localización:</label>
          <input type="text" name="data[localizacion]" id="localizacion" class="form-control">
        </div>
        
        <div class="form-group">
          <label for="hora">Hora:</label>
          <br>
          <input type="time" name="data[hora]" id="hora" class="form-control">
        </div>
        
        <div class="form-group">
          <label for="fecha">Fecha:</label>
          <br>
          <input type="date" name="data[fecha]" id="fecha" class="form-control">
        </div>
        
        <div class="form-group">
          <label for="capacidad">Capacidad:</label>
          <br>
          <input type="number" name="data[capacidad]" id="capacidad" class="form-control">
        </div>
        
        <div class="form-group">
          <label for="url">Imagen:</label>
          <br>
          <input type="file" name="data[url]" id="url" class="form-control-file">
        </div>
        
        <div class="form-group text-center">
          <button type="submit" class="btn btn-primary btn-block mt-4">Crear actividad</button>
        </div>
      </form>
    </div>
  </div>
</div>
