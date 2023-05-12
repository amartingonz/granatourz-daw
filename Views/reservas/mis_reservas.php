<div class="container mt-3">
  <div class="row row-cols-1 row-cols-md-2 g-4 m-5">
    <?php if(isset($reservas)):?>
      <?php foreach($reservas as $reserva):?>
        <div class="col mb-4">
          <div class="card h-100">
            <img src="<?="./images/".$reserva['url']?>" class="card-img-top" alt="Reserva">
            <div class="card-body d-flex flex-column">
              <h5 class="card-title"><?= $reserva['nombre']?></h5>
              <p class="card-text flex-grow-1"><?= $reserva['descripcion']?></p>
              <ul class="list-group list-group-flush text-center">
                <li class="list-group-item"><strong>Fecha:</strong> <?= $reserva['fecha']?></li>
                <li class="list-group-item"><strong>Fecha de reserva:</strong> <?= $reserva['fecha_reserva']?></li>
                <li class="list-group-item"><strong>Localización:</strong> <?= $reserva['localizacion']?></li>
                <li class="list-group-item"><strong>Duración:</strong> <?= $reserva['duracion']?></li>
                <?php if(isset($_SESSION['usuario'])):?>
                  <li class="list-group-item">
                    <form action="cancelar_reserva" method="post">
                      <input type="hidden" name="id_reserva" value="<?= $reserva['id_reserva'] ?>">
                      <button type="submit" class="btn btn-primary bg-danger">Cancelar</button>
                    </form>
                  </li>
                <?php endif;?>
              </ul>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif;?>
  </div>
</div>
