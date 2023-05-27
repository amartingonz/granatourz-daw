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

<div class="container mt-5 mb-5">
  <div class="row justify-content-center">
    <?php if(isset($actividades)):?>
      <?php foreach($actividades as $actividad):?>
        <?php if($actividad['capacidad'] != 0):?>
          <div class="col-md-6">
            <div class="card text-center">
              <img src="<?="./images/".$actividad['url']?>" class="card-img-top" alt="Actividad">
              <div class="card-body">
                <h5 class="card-title"><?= $actividad['nombre']?></h5>
                <p class="card-text"><?= $actividad['descripcion']?></p>
                <p class="card-text"><strong>Duración:</strong> <?= $actividad['duracion']?> minutos</p>
                <p class="card-text"><strong>Localización:</strong> <?= $actividad['localizacion']?></p>
                <p class="card-text"><strong>Hora:</strong> <?= $actividad['hora']?></p>
                <p class="card-text"><strong>Fecha:</strong> <?= $actividad['fecha']?></p>
                <p class="card-text"><strong>Capacidad:</strong> <?= $actividad['capacidad']?> plazas</p>
                <?php if(isset($_SESSION['admin'])):?>
                  <form action="eliminar_actividad" method="post">
                    <input type="hidden" name="id_actividad" value="<?= $actividad['id_actividad'] ?>">
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                  </form>
                <?php endif;?>
                <?php if(isset($_SESSION['usuario'])):?>
                  <form action="realizar_reserva" method="post">
                    <input type="hidden" name="data[id_actividad]" value="<?= $actividad['id_actividad'] ?>">
                    <input type="hidden" name="data[fecha]" value="<?= $actividad['fecha'] ?>">
                    <input type="hidden" name="data[id_usuario]" value="<?= $id ?>">
                    <button type="submit" class="btn btn-success">Reservar</button>
                  </form>
                <?php endif;?>
              </div>
            </div>
          </div>
        <?php endif;?>
      <?php endforeach; ?>
    <?php endif;?>
  </div>
</div>
<?php if(isset($_SESSION['usuario'])):?>
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-body text-center">
          <h3 class="card-title">Crear comentario:</h3>
          <form action="crear_comentario" method="post" enctype="multipart/form-data" onsubmit="return validarFormulario_crear_comentario();">
            <input type="hidden" name="data[id_actividad]" value="<?= $actividad['id_actividad'] ?>">
            <input type="hidden" name="data[id_usuario]" value="<?= $id ?>">
            <div class="form-group">
              <p class="card-text"><strong>Imagen:</strong></p>
              <input type="file" class="form-control-file" name="data[url]" id="url">
              <span class="text-danger" id="url-error"></span>
            </div>
            <div class="form-group">
              <p class="card-text"><strong>Comentario:</strong></p>
              <textarea class="form-control" name="data[texto]" id="texto" rows="5"></textarea>
              <span class="text-danger" id="texto-error"></span>
            </div>
            <div class="form-group">
              <p class="card-text"><strong>Valoración:</strong></p>
              <input type="number" name="data[valoracion]" id="valoracion">
              <span class="text-danger" id="valoracion-error"></span>
            </div>
            <button type="submit" class="btn btn-warning btn-success m-3">Enviar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php endif;?>
<?php $comentarios = ComentarioRepository::obtenerComentarios(); ?>
<div class="container">
    <?php foreach ($comentarios as $comentario) { ?>
      <?php if ($comentario->getId_actividad() === $actividad['id_actividad']) { ?>
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="<?="./images/".$comentario->getUrl();?>" class="img-fluid" alt="Imagen Comentario">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <?php $nombreUsuario = UsuarioRepository::obtenerUsuarioPorId($comentario->getId_usuario()); ?>
                        <h5 class="card-title">Usuario: <?php echo $nombreUsuario !== null ? $nombreUsuario : 'Desconocido'; ?></h5>
                        <p class="card-text">Actividad: <?php echo $comentario->getId_actividad(); ?></p>
                        <p class="card-text">Fecha: <?php echo $comentario->getFecha(); ?></p>
                        <p class="card-text">Texto: <?php echo $comentario->getTexto(); ?></p>
                        <p class="card-text">Valoración: <?php echo $comentario->getValoracion(); ?>/10</p>
                        <?php if (isset($id) && $comentario->getId_usuario() === $id) { ?>
                          <form action="eliminar_comentario" method="post">
                              <input type="hidden" name="id_comentario" value="<?php echo $comentario->getId_comentario(); ?>">
                              <button type="submit" class="btn btn-danger">Eliminar Comentario</button>
                          </form>
                        <?php };?>
                        <?php if(isset($_SESSION['admin'])):?>
                          <form action="eliminar_comentario" method="post">
                              <input type="hidden" name="id_comentario" value="<?php echo $comentario->getId_comentario(); ?>">
                              <button type="submit" class="btn btn-danger">Eliminar Comentario</button>
                          </form>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    <?php }; ?>
</div>
