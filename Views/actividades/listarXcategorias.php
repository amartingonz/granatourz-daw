<!-- LISTAR ACTIVIDADES POR CATEGORIAS -->

<div class="container mt-3">
  <div class="row row-cols-1 row-cols-md-2 g-4 m-5">
    <?php if(isset($actividades)):?>
      <?php foreach($actividades as $actividad):?>
        <?php if($actividad['capacidad'] != 0):?>
          <div class="col mb-4">
            <div class="card h-100">
              <img src="<?="../images/".$actividad['url']?>" class="card-img-top" alt="Actividad">
              <div class="card-body d-flex flex-column">
                <h5 class="card-title"><?= $actividad['nombre']?></h5>
                <p class="card-text flex-grow-1"><?= $actividad['descripcion']?></p>
                <ul class="list-group list-group-flush text-center">
                  <li class="list-group-item"><strong>Duración:</strong> <?= $actividad['duracion']?> minutos</li>
                  <li class="list-group-item"><strong>Localización:</strong> <?= $actividad['localizacion']?></li>
                  <li class="list-group-item"><strong>Hora:</strong> <?= $actividad['hora']?></li>
                  <li class="list-group-item"><strong>Fecha:</strong> <?= $actividad['fecha']?></li>
                  <li class="list-group-item"><strong>Capacidad:</strong> <?= $actividad['capacidad']?> plazas</li>
                  <li class="list-group-item">
                  <?php if(isset($_SESSION['usuario'])):?>
                      <form action="realizar_reserva" method="post">
                        <input type="hidden" name="data[id_actividad]" value="<?= $actividad['id_actividad'] ?>">
                        <input type="hidden" name="data[fecha]" value="<?= $actividad['fecha'] ?>">
                        <input type="hidden" name="data[id_usuario]" value="<?= $id ?>">
                        <button type="submit" class="btn btn-success">Reservar</button>
                      </form>
                  <?php endif;?>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        <?php endif;?>
      <?php endforeach; ?>
    <?php endif;?>
  </div>
</div>
