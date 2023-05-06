    <?php
            use Repositories\CategoriaRepository;
            use Models\Categoria;
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <!-- <link rel="stylesheet" href="css/header.css"> -->
        <!-- <link rel="stylesheet" href="../css/header.css"> -->

    </head>
    <body>
       

        
        <nav class="menu">
        <h1>GranaTourz</h1>
            <ul>
            <li>
                    <a href="<?= $_ENV['BASE_URL']?>">Inicio</a> 
            </li>
            <?php if(!isset($_SESSION['usuario']) && !isset($_SESSION['admin'])){?>
                <li>
                    <a href="<?= $_ENV['BASE_URL']?>usuarios_registrar">Registrar</a>
                </li>
                <li>
                    <a href="<?= $_ENV['BASE_URL']?>usuarios_loguear">Login</a>
                </li>
            <?php }?>
            </ul>
        </nav>

        <?php if(isset($_SESSION['admin'])):?>
        <nav class="menu"> 
            <ul>
                <li><a href="<?= $_ENV['BASE_URL']?>crear_categoria">Crear Categorias</a></li>
                <li><a href="<?= $_ENV['BASE_URL']?>crear_actividad">Agregar Actividad</a></li>
                <li><a href="<?= $_ENV['BASE_URL']?>editar_actividad">Editar Actividad</a></li>
                <li><a href="<?= $_ENV['BASE_URL']?>eliminar_actividad">Eliminar Actividad</a></li>
                <li><a href="<?= $_ENV['BASE_URL']?>eliminar_producto">Sancionar Usuario</a></li>
                <li><a href="<?= $_ENV['BASE_URL']?>eliminar_producto">Editar Comentario</a></li>
                <li><a href="<?= $_ENV['BASE_URL']?>editar_datos">Editar Datos</a></li>
                <li><a href="<?= $_ENV['BASE_URL']?>cerrar_sesion">cerrar sesion</a></li>
            </ul>
        </nav>
        <?php endif;?>


        <?php if(isset($_SESSION['usuario'])):?>
            <nav class="menu">
                <ul>
                    <li><a href="<?= $_ENV['BASE_URL']?>anadir_carrito">Ver carrito</a></li>
                    <li><a href="<?= $_ENV['BASE_URL']?>consultar_pedidos">Ver pedidos</a></li>
                    <li><a href="<?= $_ENV['BASE_URL']?>editar_datos">Editar Datos</a></li>
                    <li><a href="<?= $_ENV['BASE_URL']?>cerrar_sesion">cerrar sesion</a></li>
                </ul>
            </nav>
        <?php endif;?>
        <br>
      
        <?php $categorias=CategoriaRepository::obtenerCategorias(); ?>

    <nav class="categorias">
        <ul>
        <?php foreach($categorias as $cat){
                    echo "<a href=".$_ENV['BASE_URL']."listarXcategorias/".$cat->getId().">".$cat->getNombre()."</a>";
                }

        ?>
        </form>
        </ul>