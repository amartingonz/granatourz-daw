<?php
    session_start();
    require_once __DIR__.'../../vendor/autoload.php';
    use Dotenv\Dotenv;
    use Controllers\CategoriaController;
    use Controllers\ComentarioController;
    use Controllers\ReservaController;
    use Controllers\ActividadController;
    use Controllers\UsuarioController;
    use Controllers\SancionController;
    use Controllers\ContactoController;
    use Lib\Router;
    $dotenv = Dotenv::createImmutable(__DIR__.'../../');
    $dotenv->safeLoad();
    require_once '../views/layout/header.php';
    $actividadController = new ActividadController();
    $contactoController = new ContactoController();
    $usuarioController = new UsuarioController();
    $comentarioController = new ComentarioController();
    $reservaController = new ReservaController();
    $sancionController = new SancionController();
    $categoriaController = new CategoriaController();
?>
<div class="main-content flex-grow-1">
<?php

    // INDEX
    Router::add('GET','/',function() use ($actividadController){
        ($actividadController) -> listar_actividades();
    });

    //ERROR 404 

    Router::add('GET','/404',function(){
        require '../views/layout/404.php';
    });


    Router::add('GET','/normas',function(){
        require '../views/ayuda/normas.php';
    });

    Router::add('GET','/contacto',function(){
        require '../views/ayuda/contacto.php';
    });
    
    Router::add('POST','/enviar_correo',function() use ($contactoController){
        ($contactoController) -> enviar_mensaje();
    });

    // REGISTRO
    Router::add('GET','usuarios_registrar',function(){require '../views/usuarios/registro.php';});
    Router::add('POST','usuarios_registrar',function() use ($usuarioController){
        ($usuarioController) -> registrar();});


    // Confirmar mediante el metodo get el correo
    Router::add('GET', 'confirmar-cuenta/:id', function(string $token) use ($usuarioController){
        ($usuarioController)->confirmar_email($token);
    });

    
    // LOGIN
    Router::add('GET','usuarios_loguear',function(){require '../views/usuarios/login.php';});
    Router::add('POST','usuarios_loguear',function() use ($usuarioController){
        ($usuarioController) -> login();});

    // CERRAR SESION

    Router::add('GET','cerrar_sesion',function() use ($usuarioController){
        ($usuarioController) -> cerrar_sesion();});
  

    // LISTAR X CATEGORIAS/ID
    Router::add('GET','listarXcategorias/:id',function(int $id) use ($actividadController){
         ($actividadController) -> listarXcategorias($id);
    });

    // SANCIONES

    Router::add('POST','proponer_sancion',function() use ($sancionController){
        if (!isset($_SESSION['organizador']) && !isset($_SESSION['admin'])) {
            header('Location: ' . $_ENV['BASE_URL']. 'usuarios_loguear');
            exit;
        }
        ($sancionController) -> proponer_sancion();
    });

    Router::add('GET','sancionar_usuario',function() use ($sancionController){
        if (!isset($_SESSION['admin'])) {
            header('Location: ' . $_ENV['BASE_URL']. 'usuarios_loguear');
            exit;
        }
        ($sancionController) -> confirmar_sancion();
    });
    
    Router::add('POST','confirmar_sancion',function() use ($sancionController){
        if (!isset($_SESSION['organizador']) && !isset($_SESSION['admin'])) {
            header('Location: ' . $_ENV['BASE_URL']. 'usuarios_loguear');
            exit;
        }
        ($sancionController) -> confirmar_sancion();
    });

    // RESERVAS
    
    Router::add('GET','consultar_reservas',function() use ($reservaController){
        if (!isset($_SESSION['usuario'])) {
            header('Location: ' . $_ENV['BASE_URL']. 'usuarios_loguear');
            exit;
        }
        ($reservaController) -> consultar_reservas();
    });


    Router::add('POST','realizar_reserva',function() use ($reservaController){
        ($reservaController) -> realizar_reserva();
    });

    Router::add('POST','listado_asistentes',function() use ($reservaController){
        if (!isset($_SESSION['organizador']) && !isset($_SESSION['admin'])) {
            header('Location: ' . $_ENV['BASE_URL']. 'usuarios_loguear');
            exit;
        }
        ($reservaController) -> sacarListadoAsistentes();
    });

    Router::add('POST','anular_reserva',function() use ($reservaController){
        if (!isset($_SESSION['organizador']) && !isset($_SESSION['admin'])) {
            header('Location: ' . $_ENV['BASE_URL']. 'usuarios_loguear');
            exit;
        }
        ($reservaController) -> cancelar_reserva();
    });


    Router::add('POST','cancelar_reserva',function() use ($reservaController){
        ($reservaController) -> cancelar_reserva_usuario();
    });
    // CATEGORIAS

    Router::add('GET','crear_categoria',function(){
        if(!isset($_SESSION['admin'])){
            header('Location: ' . $_ENV['BASE_URL']. 'usuarios_loguear');
            exit;
        }
        require '../views/categorias/crear_categoria.php';
    });

   Router::add('POST','crear_categoria',function() use ($categoriaController){
    ($categoriaController) -> crear_categoria();
    });

    // ACTIVIDADES
    

    Router::add('GET','crear_actividad',function() use ($actividadController){
        // He añadido este if dentro de la función para controlar las rutas es decir no se puedan meter sin estar logueados.
        if (!isset($_SESSION['organizador']) && !isset($_SESSION['admin'])) {
            header('Location: ' . $_ENV['BASE_URL']. 'usuarios_loguear');
            exit;
        }
        ($actividadController) -> crear_actividad();
    });
    Router::add('POST','crear_actividad',function() use ($actividadController){
        ($actividadController) -> crear_actividad();
    });

    Router::add('GET','editar_actividad',function() use ($actividadController){
        if (!isset($_SESSION['organizador']) && !isset($_SESSION['admin'])) {
            header('Location: ' . $_ENV['BASE_URL']. 'usuarios_loguear');
            exit;
        }
        ($actividadController) -> editar_actividad2();
    });

    Router::add('POST','editar_actividad',function() use ($actividadController){
        ($actividadController) -> editar_actividad2();
    });

    Router::add('POST','editar_actividad2',function() use ($actividadController){
        ($actividadController) -> editar_actividad2();
    });

    Router::add('POST','editar_actividad3',function() use ($actividadController){
        ($actividadController) -> editar_actividad2();
    });

    Router::add('POST','eliminar_actividad',function() use ($actividadController) {
        ($actividadController) -> borrar_actividad();
    });

    Router::add('POST','ver_actividad', function() use ($actividadController) {
        ($actividadController) -> ver_actividad();
    });

    Router::add('GET','ver_listado',function() use ($actividadController){
        if (!isset($_SESSION['organizador'])) {
            header('Location: ' . $_ENV['BASE_URL']. 'usuarios_loguear');
            exit;
        }
        ($actividadController) -> sacarListadoAsistentes();
    });

    // EDITAR DATOS

    
    Router::add('GET','editar_datos',function(){
        if (!isset($_SESSION['usuario']) && !isset($_SESSION['admin']) && !isset($_SESSION['organizador'])) {
            header('Location: ' . $_ENV['BASE_URL']. 'usuarios_loguear');
            exit;
        }
        require '../views/usuarios/editar_datos.php';
    });
    
    Router::add('POST','editar_datos',function() use ($usuarioController){
        ($usuarioController) -> editar_datos();
    });


    // COMENTARIOS


    Router::add('POST','crear_comentario',function() use ($comentarioController){
        ($comentarioController) -> crear_comentario();
    });

    Router::add('POST','eliminar_comentario',function() use ($comentarioController){
        ($comentarioController) -> eliminar_comentario();
    });

    Router::dispatch();
?>
</div>
<button onclick="scrollToTop()" id="btnToTop" class="btn btn-primary" style="position: fixed; bottom: 20px; right: 20px; display: none;" aria-label="Volver arriba">
    <span class="fas fa-arrow-up" aria-hidden="true"></span>
</button>
<?php
    require_once '../views/layout/footer.php';
?>

