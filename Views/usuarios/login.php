<!-- FORMULARIO DE LOGIN -->

<script src="js-script/login.js"></script>
<script src="../js-script/login.js"></script>
<div class="container-fluid p-5">
  <div class="row justify-content-center">
    <div class="col-sm-6 col-md-4 p-5">
      <h2 class="text-center mt-3">Identifícate</h2>
      <form action="<?= $_ENV['BASE_URL']?>usuarios_loguear" method="post" class="needs-validation mt-4" novalidate>

        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="data[email]" required>
          <div class="invalid-feedback">
            <?php if(isset($_SESSION['errores'])){
                if(isset($_SESSION['errores']['email'])){
                    echo $_SESSION['errores']['email'];
                }
            } ?>
          </div>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Contraseña</label>
          <input type="password" class="form-control" id="password" name="data[password]" required>
          <div class="invalid-feedback">
            <?php if(isset($_SESSION['errores'])){
                if(isset($_SESSION['errores']['password'])){
                    echo $_SESSION['errores']['password'];
                }
            } ?>
          </div>
        </div>

        <div class="text-center">
          <button type="submit" class="btn btn-primary">Entrar</button>
        </div>

      </form>
    </div>
  </div>
</div>








