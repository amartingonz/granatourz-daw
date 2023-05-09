<?php
    session_start();
    require_once __DIR__.'../../vendor/autoload.php';
    
    use Dotenv\Dotenv;
    use Controllers\CategoriaController;
    use Controllers\CarritoController;
    use Controllers\PedidoController;
    use Controllers\ActividadController;
    use Controllers\UsuarioController;
    use Lib\Router;
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->safeLoad();
    require_once '../views/layout/header.php';


    // // INDEX
    // Router::add('GET','/',function(){
    //     (new ProductoController()) -> listar_productos();
    // });

    // REGISTRO
    Router::add('GET','usuarios_registrar',function(){require '../views/usuarios/registro.php';});
    Router::add('POST','usuarios_registrar',function(){
        (new UsuarioController()) -> registrar();});

    // LOGIN
    Router::add('GET','usuarios_loguear',function(){require '../views/usuarios/login.php';});
    Router::add('POST','usuarios_loguear',function(){
        (new UsuarioController()) -> login();});

    // CERRAR SESION
    // Router::add('GET','cerrar_sesion',function(){
    //     require '../views/usuarios/cerrar_sesion.php';}
    // );
    Router::add('GET','cerrar_sesion',function(){
        (new UsuarioController()) -> cerrar_sesion();});
  

    // // LISTAR X CATEGORIAS/ID
    // Router::add('GET','listarXcategorias/:id',function(int $id){
    //      (new ProductoController()) -> listarXcategorias($id);
    // });

    // AÑADIR AL CARRITO
    
//     Router::add('POST','comprobarPedido',function(){
//         (new PedidoController()) -> comprobarPedido();
//     });


//     Router::add('GET','anadir_carrito',function(){
//         (new CarritoController()) -> anadir_carrito();
//     });
    
//    Router::add('POST','anadir_carrito',function(){
//     (new CarritoController()) -> anadir_carrito();
//     });

//     Router::add('GET','borrar_elementos',function(){
//         require '../views/productos/carrito.php';
//     });

//     Router::add('POST','borrar_elementos',function(){
//         (new CarritoController()) -> borrar_elementos();
//     });

    // PEDIDOS
    
    // Router::add('GET','consultar_pedidos',function(){
    //     (new PedidoController()) -> consultar_pedidos();
    // });

    
    // Router::add('GET','comprobarPedido',function(){
    //     (new PedidoController()) -> comprobarPedido();
    // });

    // Router::add('POST','crear_pedido',function(){
    //     (new PedidoController()) -> crear_pedido();
    // });

    // CATEGORIAS

    Router::add('GET','crear_categoria',function(){
        if(!isset($_SESSION['admin'])){
            header('Location: ' . $_ENV['BASE_URL']. 'usuarios_loguear');
            exit;
        }
        require '../views/categorias/crear_categoria.php';
    });

   Router::add('POST','crear_categoria',function(){
    (new CategoriaController()) -> crear_categoria();
    });

    // ACTIVIDADES
    

    Router::add('GET','crear_actividad',function(){
        // He añadido este if dentro de la función para controlar las rutas es decir no se puedan meter sin estar logueados.
        if(!isset($_SESSION['admin'])){
            header('Location: ' . $_ENV['BASE_URL']. 'usuarios_loguear');
            exit;
        }
        (new ActividadController()) -> crear_actividad();
    });
    Router::add('POST','crear_actividad',function(){
        (new ActividadController()) -> crear_actividad();
    });

    Router::add('GET','editar_actividad',function(){
        if(!isset($_SESSION['admin'])){
            header('Location: ' . $_ENV['BASE_URL']. 'usuarios_loguear');
            exit;
        }
        (new ActividadController()) -> editar_actividad();
    });
    Router::add('POST','editar_actividad',function(){
        (new ActividadController()) -> editar_actividad();
    });

    // Router::add('GET','eliminar_producto',function(){
    //     (new ProductoController()) -> borrar_producto();
    // });
    // Router::add('POST','eliminar_producto',function(){
    //     (new ProductoController()) -> borrar_producto();
    // });


    // EDITAR DATOS

    
    Router::add('GET','editar_datos',function(){
        require '../views/usuarios/editar_datos.php';
    });
    
    Router::add('POST','editar_datos',function(){
        (new UsuarioController()) -> editar_datos();
    });





    Router::dispatch();
    require_once '../views/layout/footer.php';

?>

