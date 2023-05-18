<div class="container mt-5 p-5">
  <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Apellidos</th>
          <th>DNI</th>
          <th>Email</th>
          <th>Teléfono</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php if(isset($listado)): ?>
          <?php foreach($listado as $lista): ?>
            <tr>
              <td><?= $lista['nombre'] ?></td>
              <td><?= $lista['apellidos'] ?></td>
              <td><?= $lista['dni'] ?></td>
              <td><?= $lista['email'] ?></td>
              <td><?= $lista['telefono'] ?></td>
              <td>
                <form action="anular_reserva" method="POST">
                  <input type="hidden" name="data[id_usuario]" value="<?= $lista['id_usuario'] ?>">
                  <input type="hidden" name="data[id_actividad]" value="<?= $lista['id_actividad'] ?>">
                  <button type="submit" class="btn btn-danger">Anular</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
