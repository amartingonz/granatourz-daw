<!-- FORMULARIO DE EDITAR ACTIVIDAD (SELECCIONAR ACTIVIDAD) -->

<div class="container-fluid p-5">
  <div class="row justify-content-center">
    <div class="col-sm-6 col-md-4 p-5">
      <h2 class="text-center mt-3">Editar Actividad</h2>
      <form action="<?= $_ENV['BASE_URL']?>editar_actividad2" method="post" enctype="multipart/form-data" class="needs-validation mt-4" novalidate>
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
        <div class="form-group text-center">
            <button type="submit" name="editar_nombre" class="btn btn-primary btn-block mt-4">Ir a editar</button>
        </div>
        </form>
        </div>
    </div>
</div>
