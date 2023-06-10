<?php
namespace Lib;



class Router {

    private static array $routes = [];
    //para ir añadiendo los métodos y las rutas en el tercer parámetro.
    public static function add(string $method, string $action, Callable $controller):void{
        //die($action);

        $action = trim($action, '/');
       
        self::$routes[$method][$action] = $controller;
    }
   
    // Este método se encarga de obtener el sufijo de la URL que permitirá seleccionar
    // la ruta y mostrar el resultado de ejecutar la función pasada al metodo add para esa ruta
    // usando call_user_func()

    public static function dispatch():void {
        $method = $_SERVER['REQUEST_METHOD']; 

        $action = preg_replace("/\/granatourz-daw\/public\//",'',$_SERVER['REQUEST_URI']);//desde el public
       //$_SERVER['REQUEST_URI'] almacena la cadena de texto que hay después del nombre del host en la URL
        $action = trim($action, '/');


        $param = null;
        $p= preg_match('/\/[a-z0-9A-Z.-_]+$/', $action, $match);
       if(!empty($match)){

            $param = $match[0];
            $param =preg_replace("/\//",'',$param);
            $action=preg_replace('/'.$param.'/',':id',$action);

       }

        $fn = self::$routes[$method][$action] ?? null;

        if($fn){
            $callback = self::$routes[$method][$action];
            echo call_user_func($callback, $param);
        } else {
            header('Location: ' . $_ENV['BASE_URL'].'404'); // Redirigir a la página 404.php
            exit();
        }
        



        }





}

