<!-- FORMULARIO DE LOGIN -->
<div class="container-fluid p-5">
  <div class="row justify-content-center">
    <div class="col-sm-6 col-md-4 p-5">
      <h2 class="text-center mt-3">Iniciar Sesión</h2>
      <form action="<?= $_ENV['BASE_URL']?>usuarios_loguear" method="post" class="needs-validation mt-4" novalidate onsubmit="return validarFormularioLogin();">

        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="data[email]" placeholder="Ingresa tu email" required>
          <div class="invalid-feedback" id="email-error"></div>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Contraseña</label>
          <input type="password" class="form-control" id="password" name="data[password]" placeholder="Ingresa tu contraseña" required>
          <div class="invalid-feedback" id="password-error"></div>
        </div>

        <div class="text-center">
          <button type="submit" class="btn btn-primary">Entrar</button>
        </div>

      </form>
    </div>
  </div>
</div>








