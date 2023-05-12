<!-- LISTAR ACTIVIDADES -->

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
    <?php if(isset($actividades)):?>
      <?php foreach($actividades as $actividad):?>
        <?php if($actividad['capacidad'] != 0):?>
          <div class="col mb-4">
            <div class="card h-100">
              <img src="<?="./images/".$actividad['url']?>" class="card-img-top" alt="Actividad">
              <div class="card-body d-flex flex-column">
                <h5 class="card-title"><?= $actividad['nombre']?></h5>
                <p class="card-text flex-grow-1"><?= $actividad['descripcion']?></p>
                <ul class="list-group list-group-flush text-center">
                  <li class="list-group-item"><strong>Duración:</strong> <?= $actividad['duracion']?></li>
                  <li class="list-group-item"><strong>Localización:</strong> <?= $actividad['localizacion']?></li>
                  <li class="list-group-item"><strong>Hora:</strong> <?= $actividad['hora']?></li>
                  <li class="list-group-item"><strong>Fecha:</strong> <?= $actividad['fecha']?></li>
                  <li class="list-group-item"><strong>Capacidad:</strong> <?= $actividad['capacidad']?></li>
                  <li class="list-group-item">
                    <form action="ver_actividad" method="post">
                      <input type="hidden" name="id_actividad" value="<?= $actividad['id_actividad'] ?>">
                      <button type="submit" class="btn btn-primary">Ver más</button>
                    </form>
                  </li>
                  <?php if(isset($_SESSION['admin'])):?>
                  <li class="list-group-item">
                    <form action="eliminar_actividad" method="post">
                      <input type="hidden" name="id_actividad" value="<?= $actividad['id_actividad'] ?>">
                      <button type="submit" class="btn btn-primary bg-danger">Eliminar</button>
                    </form>
                  </li>
                  <?php endif;?>
                  <?php if(isset($_SESSION['usuario'])):?>
                  <li class="list-group-item">
                    <form action="realizar_reserva" method="post">
                      <input type="hidden" name="data[id_actividad]" value="<?= $actividad['id_actividad'] ?>">
                      <input type="hidden" name="data[fecha]" value="<?= $actividad['fecha'] ?>">
                      <input type="hidden" name="data[id_usuario]" value="<?= $id ?>">
                      <button type="submit" class="btn btn-primary btn-success">Reservar</button>
                    </form>
                  </li>
                  <?php endif;?>
                </ul>
              </div>
            </div>
          </div>
        <?php endif;?>
      <?php endforeach; ?>
    <?php endif;?>
  </div>
</div>

