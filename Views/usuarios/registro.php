<!-- FORMULARIO DE REGISTRO -->


<div class="container-fluid p-5">
  <div class="row justify-content-center">
    <div class="col-sm-6 col-md-4 p-5">
      <h2 class="text-center mt-3">Registro</h2>
      <form action="<?= $_ENV['BASE_URL']?>usuarios_registrar" method="post" class="needs-validation mt-4" novalidate onsubmit="return validarFormularioRegistro();">

        <div class="form-group">
          <label for="dni">Dni:</label>
          <input type="text" class="form-control" name="data[dni]" required>
          <span class="text-danger" id="dni-error"></span>
        </div>

        <div class="form-group">
          <label for="nombre">Nombre:</label>
          <input type="text" class="form-control" name="data[nombre]" required>
          <span class="text-danger" id="nombre-error"></span>
        </div>

        <div class="form-group">
          <label for="apellidos">Apellido:</label>
          <input type="text" class="form-control" name="data[apellidos]" required>
          <span class="text-danger" id="apellidos-error"></span>
        </div>

        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" class="form-control" name="data[email]" required>
          <span class="text-danger" id="email-error"></span>
        </div>

        <div class="form-group">
          <label for="telefono">Teléfono:</label>
          <input type="tel" class="form-control" name="data[telefono]" required>
          <span class="text-danger" id="telefono-error"></span>
        </div>

        <div class="form-group">
          <label for="password">Contraseña:</label>
          <input type="password" class="form-control" name="data[password]" required>
          <span class="text-danger" id="password-error"></span>
        </div>

        <div class="form-group">
          <label for="rol">Rol:</label>
          <br>
          <select name="data[rol]" id="rol">
            <option value="usuario">usuario</option>
            <option value="organizador">organizador</option>
          </select>
        </div>

        <div class="text-center p-3">
          <button type="submit" class="btn btn-primary">Registrar</button>
        </div>

      </form>
    </div>
  </div>
</div>
