<!-- FORMULARIO DE EDITAR ACTIVIDAD -->

<div class="container-fluid p-5">
  <div class="row justify-content-center">
    <div class="col-sm-6 col-md-4 p-5">
      <h2 class="text-center mt-3">Editar Actividad</h2>
      <form action="<?= $_ENV['BASE_URL']?>editar_actividad2" method="post" enctype="multipart/form-data" class="needs-validation mt-4" novalidate>
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
        <div class="form-group text-center">
          <button type="submit" name="editar_categoria" class="btn btn-primary btn-block mt-4">Continuar editando</button>
        </div>
      </form>
    </div>
  </div>
</div>
