<?php
            use Repositories\ComentarioRepository;
            use Repositories\UsuarioRepository;
            use Models\Comentario;
            use Models\Usuarios;

            ob_start();
?>

<?php 

    if(isset($_SESSION['admin'])){
        $id = $_SESSION['id_admin'];
    }
    if(isset($_SESSION['usuario'])){
        $id = $_SESSION['id_usuario'];
    }


?>

<div class="container mt-5 p-5">
  <div class="row justify-content-center">
    <?php if(isset($actividades)):?>
      <?php foreach($actividades as $actividad):?>
        <?php if($actividad['capacidad'] != 0):?>
          <div class="col-md-6 mb-4">
            <div class="card text-center">
              <img src="<?="./images/".$actividad['url']?>" class="card-img-top" alt="Actividad">
              <div class="card-body">
                <h5 class="card-title"><?= $actividad['nombre']?></h5>
                <p class="card-text"><?= $actividad['descripcion']?></p>
                <p class="card-text"><strong>Duración:</strong> <?= $actividad['duracion']?></p>
                <p class="card-text"><strong>Localización:</strong> <?= $actividad['localizacion']?></p>
                <p class="card-text"><strong>Hora:</strong> <?= $actividad['hora']?></p>
                <p class="card-text"><strong>Fecha:</strong> <?= $actividad['fecha']?></p>
                <p class="card-text"><strong>Capacidad:</strong> <?= $actividad['capacidad']?></p>
                <?php if(isset($_SESSION['admin'])):?>
                  <form action="eliminar_actividad" method="post">
                    <input type="hidden" name="id_actividad" value="<?= $actividad['id_actividad'] ?>">
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                  </form>
                <?php endif;?>
                <form action="listado_asistentes" method="post">
                    <input type="hidden" name="data[id_actividad]" value="<?= $actividad['id_actividad'] ?>">
                    <input type="hidden" name="data[id_usuario]" value="<?= $id ?>">
                    <button type="submit" class="btn btn-success">Ver lista</button>
                  </form>
                <?php endif;?>
              </div>
            </div>
          </div>
      <?php endforeach; ?>
    <?php endif;?>
  </div>
</div>
