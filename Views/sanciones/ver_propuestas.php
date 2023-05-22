<div class="container mt-5 p-5">
  <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID Usuario</th>
          <th>ID Actividad</th>
          <th>Motivo</th>
          <th>Fecha</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php if (isset($sanciones)): ?>
          <?php foreach ($sanciones as $sancion): ?>
            <?php if ($sancion['estado'] != 1): ?>
              <tr>
                <td><?= $sancion['id_usuario'] ?></td>
                <td><?= $sancion['id_actividad'] ?></td>
                <td><?= $sancion['motivo'] ?></td>
                <td><?= $sancion['fecha'] ?></td>
                <td>
                  <form action="confirmar_sancion" method="POST">
                    <div class="d-flex align-items-center">
                      <input type="hidden" name="data[id_sancion]" value="<?= $sancion['id_sancion'] ?>">
                      <button type="submit" class="btn btn-danger text-center">Confirmar Sancion</button>
                    </div>
                  </form>
                </td>
              </tr>
            <?php endif; ?>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
