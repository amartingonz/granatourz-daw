<div class="container-fluid">
    <h1 class="text-center mt-5">Contacto</h1>
    <div class="row justify-content-center">
      <div class="col-lg-6 col-md-8 col-sm-10">
        <form action="<?= $_ENV['BASE_URL']?>enviar_correo" method="post" class="needs-validation mt-4" novalidate>
          <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" name="data[nombre]" id="nombre" placeholder="Ingrese su nombre">
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="data[email]" id="email" placeholder="Ingrese su email">
          </div>
          <div class="form-group">
            <label for="mensaje">Mensaje</label>
            <textarea class="form-control" name="data[mensaje]" id="mensaje" rows="5" placeholder="Ingrese su mensaje"></textarea>
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-primary">Enviar</button>
          </div>
        </form>
      </div>
    </div>
  </div>