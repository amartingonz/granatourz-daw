    <?php
            use Repositories\CategoriaRepository;
            use Models\Categoria;
            ob_start();

    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="logo.png">
        <title>GranaTourz</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
        <script src="js/bootstrap.min.js" defer></script>
        <script src="../js/bootstrap.min.js" defer></script>
        <script src="jquery-3.6.3.min.js" defer></script>
        <script src="../js/jquery-3.6.3.min.js" defer></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous" defer></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous" defer></script>
        <!-- Scripts botón scroll -->
        <script src="js-script/boton/btn_scroll.js" defer></script>
        <!-- Scripts validaciones de formularios -->
        <script src="js-script/formularios/formulario_categoria.js" defer></script>
        <script src="js-script/formularios/formulario_login.js" defer></script>
        <script src="js-script/formularios/formulario_registro.js" defer></script>
        <script src="js-script/formularios/formulario_editar_datos.js" defer></script>
        <script src="js-script/formularios/formulario_comentario.js" defer></script>
        <script src="js-script/formularios/formulario_crear_actividad.js" defer></script>
        <script src="js-script/formularios/formulario_editar_actividad3.js" defer></script>
        <script src="js-script/formularios/formulario_contacto.js" defer></script>
    </head>
    <body>    
    <header>
      <nav class="navbar navbar-expand-md navbar-dark bg-primary p-4">
        <a class="navbar-brand" href="<?= $_ENV['BASE_URL']?>">GranaTourz</a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-label="Abrir menú de navegación">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarContent">
        <ul class="navbar-nav mr-auto">
          <?php if(!isset($_SESSION['usuario']) && !isset($_SESSION['admin'])  && !isset($_SESSION['organizador'])){?>
            <li class="nav-item">
              <a class="nav-link" href="<?= $_ENV['BASE_URL']?>usuarios_registrar">Registrar</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= $_ENV['BASE_URL']?>usuarios_loguear">Login</a>
            </li>
          <?php }?>
          
          <?php if(isset($_SESSION['admin'])):?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Admin
              </a>
              <div class="dropdown-menu" aria-labelledby="adminDropdown">
                <a class="dropdown-item" href="<?= $_ENV['BASE_URL']?>crear_categoria">Crear Categorias</a>
                <a class="dropdown-item" href="<?= $_ENV['BASE_URL']?>crear_actividad">Agregar Actividad</a>
                <a class="dropdown-item" href="<?= $_ENV['BASE_URL']?>editar_actividad">Editar Actividad</a>
                <a class="dropdown-item" href="<?= $_ENV['BASE_URL']?>sancionar_usuario">Sancionar Usuario</a>
                <a class="dropdown-item" href="<?= $_ENV['BASE_URL']?>editar_datos">Editar Datos</a>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= $_ENV['BASE_URL']?>cerrar_sesion">Cerrar Sesion</a>
            </li>
          <?php endif;?>

          <?php if(isset($_SESSION['organizador'])): ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="organizadorDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Organizador
              </a>
              <div class="dropdown-menu" aria-labelledby="organizadorDropdown">
                <a class="dropdown-item" href="<?= $_ENV['BASE_URL']?>crear_actividad">Agregar Actividad</a>
                <a class="dropdown-item" href="<?= $_ENV['BASE_URL']?>editar_actividad">Editar Actividad</a>
                <a class="dropdown-item" href="<?= $_ENV['BASE_URL']?>ver_listado">Ver listado</a>
                <a class="dropdown-item" href="<?= $_ENV['BASE_URL']?>editar_datos">Editar Datos</a>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= $_ENV['BASE_URL']?>cerrar_sesion">Cerrar Sesión</a>
            </li>
          <?php endif; ?>


          <?php if(isset($_SESSION['usuario'])):?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="usuarioDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Usuario
              </a>
              <div class="dropdown-menu" aria-labelledby="usuarioDropdown">
                <a class="dropdown-item" href="<?= $_ENV['BASE_URL']?>consultar_reservas">Ver reservas</a>
                <a class="dropdown-item" href="<?= $_ENV['BASE_URL']?>editar_datos">Editar Datos</a>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= $_ENV['BASE_URL']?>cerrar_sesion">Cerrar Sesion</a>
            </li>
            <?php endif;?>
        </ul>
      </div>
    </nav>

    </header>
    <body class="d-flex flex-column min-vh-100">
    <?php $categorias=CategoriaRepository::obtenerCategorias();?>
    <nav class="categorias navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#categoriasMenu" aria-controls="categoriasMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="categoriasMenu">
        <ul class="navbar-nav nav-justified w-100">
          <?php foreach($categorias as $cat) { ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo $_ENV['BASE_URL']."listarXcategorias/".$cat->getId(); ?>">
                <?php echo $cat->getNombre(); ?>
              </a>
            </li>
          <?php }; ?>
        </ul>
      </div>
    </div>
  </nav>



  </form>
  </ul>
  

