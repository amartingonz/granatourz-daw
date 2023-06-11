<?php
if(isset($_SESSION['admin'])){

    $datos = $_SESSION['id_admin'];

}elseif(isset($_SESSION['organizador'])){

    $datos = $_SESSION['id_organizador'];
    
}else{
    $datos = $_SESSION['id_usuario'];
}
?>

<div class="container-fluid p-5">
  <div class="row justify-content-center">
    <div class="col-sm-6 col-md-4 p-5">
      <h2 class="text-center mt-3">Editar Datos de Usuario</h2>
      <form action="<?= $_ENV['BASE_URL']?>editar_datos" method="post" class="mt-4" onsubmit="return validarFormulario_editar_datos();">

        <input type="hidden" name="data[id_usuario]" value="<?= $datos ?>">

        <div class="form-group">
          <label for="nombre">Nombre:</label>
          <input type="text" class="form-control" name="data[nombre]" placeholder="Ejemplo: Alejandro">
          <span class="text-danger" id="nombre-error"></span>
        </div>

        <div class="form-group">
          <label for="apellidos">Apellido:</label>
          <input type="text" class="form-control" name="data[apellidos]" placeholder="Ejemplo: Martín González">
          <span class="text-danger" id="apellidos-error"></span>
        </div>

        <div class="form-group">
          <label for="telefono">Teléfono:</label>
          <input type="tel" class="form-control" name="data[telefono]" placeholder="Ejemplo: 649019740">
          <span class="text-danger" id="telefono-error"></span>
        </div>

        <div class="form-group">
          <label for="password">Contraseña:</label>
          <input type="password" class="form-control" name="data[password]" placeholder="Ingrese una contraseña segura">
          <span class="text-danger" id="password-error"></span>
        </div>

        <div class="text-center p-3">
          <button type="submit" class="btn btn-primary">Actualizar</button>
        </div>

      </form>
    </div>
  </div>
</div>