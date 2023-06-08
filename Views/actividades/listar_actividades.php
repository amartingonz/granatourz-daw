<?php 
if(isset($_SESSION['admin'])){
    $id = $_SESSION['id_admin'];
}
if(isset($_SESSION['usuario'])){
    $id = $_SESSION['id_usuario'];
}
?>

<div class="container mt-3">
  <div class="row row-cols-1 row-cols-md-2 g-4 m-5">
    <?php
    if (isset($actividades)) {
      $fechaActual = date("Y-m-d");
      $actividadesMostradas = false; // Variable para verificar si se muestran actividades

      foreach ($actividades as $actividad) {
        $fechaActividad = $actividad['fecha'];
        if ($actividad['capacidad'] != 0 && $fechaActividad >= $fechaActual) {
          $actividadesMostradas = true; // Se encontró al menos una actividad
    ?>
          <div class="col mb-4">
            <div class="card h-100">
              <img src="./images/<?php echo $actividad['url']; ?>" class="card-img-top" alt="Actividad">
              <div class="card-body d-flex flex-column">
                <h5 class="card-title"><?php echo $actividad['nombre']; ?></h5>
                <p class="card-text flex-grow-1"><?php echo $actividad['descripcion']; ?></p>
                <ul class="list-group list-group-flush text-center">
                  <li class="list-group-item"><strong>Duración:</strong> <?php echo $actividad['duracion']; ?> minutos</li>
                  <li class="list-group-item"><strong>Localización:</strong> <?php echo $actividad['localizacion']; ?></li>
                  <li class="list-group-item"><strong>Hora:</strong> <?php echo $actividad['hora']; ?></li>
                  <li class="list-group-item"><strong>Fecha:</strong> <?php echo $actividad['fecha']; ?></li>
                  <li class="list-group-item"><strong>Capacidad:</strong> <?php echo $actividad['capacidad']; ?> plazas</li>
                  <li class="list-group-item">
                    <form action="ver_actividad" method="post">
                      <input type="hidden" name="id_actividad" value="<?php echo $actividad['id_actividad']; ?>">
                      <button type="submit" class="btn btn-primary">Ver más</button>
                    </form>
                  </li>
          <?php if (isset($_SESSION['admin'])) : ?>
                  <li class="list-group-item">
                    <form action="eliminar_actividad" method="post">
                      <input type="hidden" name="id_actividad" value="<?php echo $actividad['id_actividad']; ?>">
                      <button type="submit" class="btn btn-primary bg-danger">Eliminar</button>
                    </form>
                  </li>
          <?php endif; ?>
          <?php if (isset($_SESSION['usuario'])) : ?>
                  <li class="list-group-item">
                    <form action="realizar_reserva" method="post">
                      <input type="hidden" name="data[id_actividad]" value="<?php echo $actividad['id_actividad']; ?>">
                      <input type="hidden" name="data[fecha]" value="<?php echo $actividad['fecha']; ?>">
                      <input type="hidden" name="data[id_usuario]" value="<?php echo $id; ?>">
                      <button type="submit" class="btn btn-primary btn-success">Reservar</button>
                    </form>
                  </li>
          <?php endif; ?>
                </ul>
              </div>
            </div>
          </div>
    <?php
        }
      }
      
      if (!$actividadesMostradas) {
        ?>
        <div class="container d-flex justify-content-center align-items-center">
          <div class="col-12 col-md-6 text-center mt-5">
            <div class="alert alert-warning" role="alert">No hay actividades aún</div>
          </div>
        </div>
        <?php
      }  
    }
    ?>
  </div>
</div>
