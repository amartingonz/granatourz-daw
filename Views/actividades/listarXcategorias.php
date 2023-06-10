<div class="container mt-3">
  <div class="row row-cols-1 row-cols-md-2 g-4 m-5">
    <?php if (isset($actividades)): ?>
      <?php $actividadesMostradas = false; ?>
      <?php foreach ($actividades as $actividad): ?>
        <?php 
          if ($actividad['capacidad'] != 0) {
            $fechaActividad = $actividad['fecha'];
            $fechaActual = date('Y-m-d');
            if ($fechaActividad >= $fechaActual) {
              $actividadesMostradas = true;
        ?>
          <div class="col mb-4">
            <div class="card h-100">
              <img src="<?="../images/".$actividad['url']?>" class="card-img-top img-fluid fixed-size-image" alt="Actividad">
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
                  </li>
                </ul>
              </div>
            </div>
          </div>
        <?php 
            }
          }
        ?>
      <?php endforeach; ?>
      <?php if (!$actividadesMostradas): ?>
        <div class="container d-flex justify-content-center align-items-center">
            <div class="col-12 col-md-6 text-center mt-5">
                <div class="alert alert-warning" role="alert">No hay actividades disponibles.</div>
              </div>
          </div>
      <?php endif; ?>
    <?php endif; ?>
  </div>
</div>
<style>
    .fixed-size-image {
        aspect-ratio: 16/9;
    }
</style>
