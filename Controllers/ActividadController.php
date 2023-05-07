<?php
    namespace Controllers;
    use Lib\Pages;
    use Models\Actividad;
    use Services\CategoriaService;
    use Services\ActividadService;
    use Utils\Utils;


    
    class ActividadController{
        private ActividadService $service;
        private Pages $pages;
        private CategoriaController $categoria;
        private Utils $utils;

        public function __construct(){
            $this -> pages = new Pages();
            $this -> service = new ActividadService();
            $this -> categoria = new CategoriaController();
            $this -> utils = new Utils();
        }

        public function index(){
            header('Location:'.$_ENV['BASE_URL']);
        }


        public function borrar_producto(){
            // CREAR LUEGO LA FUNCION PARA BORRARLA.
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $id = $_POST['id'];
                $this -> service -> borrar_actividad($id);
                $actividades = $this -> service -> getAll();
                $this -> pages -> render('productos/eliminar_productos', ["actividades" => $actividades]);
                header('Location:'.$_ENV['BASE_URL']);

            }else{
                $productos = $this -> service -> getAll();
                $this -> pages -> render('productos/eliminar_productos', ["productos" => $productos]);
            }
        }

        public function crear_actividad(){
            if(!file_exists('images')){
                mkdir('images');
            }
            // Funcion encargada de crear los productos, he usado metodos de la clase utils para validar los datos.
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $datos = $_POST['data'];
                // var_dump($datos);
                // die();
                $nombre = $_POST['data']['nombre'];
                $archivo = $_FILES['data']['name'];
                
                
                $errores = $this -> utils -> validar_crearActividad($datos);
                $existe = $this -> service -> comprobarActividad($nombre);

                if($this -> utils -> sinErrorescrearActividad($errores)){
                    if(!$existe){
                        if (isset($archivo) && $archivo != "") {
                            $tipo = $_FILES['data']['type'];
                            $tamano = $_FILES['data']['size'];
                            $temp = $_FILES['data']['tmp_name'];
                            /*
                            if (!((strpos($tipo['imagen'], "image/gif") || strpos($tipo['imagen'], "image/jpeg") || strpos($tipo['imagen'], "image/jpg") || strpos($tipo['imagen'], "image/png")) && (intval($tamano['imagen']) < 200000000))) {
                                echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
                                - Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo.</b></div>';
                             } else {
                            */
                                //Si la imagen es correcta en tamaño y tipo
                                //Se intenta subir al servidor
                                if (move_uploaded_file($temp['url'], 'images/'.$archivo['url'])) {
                                    //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
                                chmod('images/'.$archivo['url'], 0777);
                                    //Mostramos el mensaje de que se ha subido co éxito
                                echo '<div><b>Se ha subido correctamente la imagen.</b></div>';
                                    //Mostramos la imagen subida
                                //echo '<p><img src="../images/'.$archivo['imagen'].'"></p>';
                            }else{
                                   //Si no se ha podido subir la imagen, mostramos un mensaje de error
                                echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
                            }
                            }
                        $this -> service -> crear_actividad($_POST['data']);
                        $this -> pages -> render('layout/mensaje', ["mensaje" => "Actividad creada con exito"]);
                    }else{
                        $this -> pages -> render('layout/mensaje', ["mensaje" => "Actividad ya existente"]);
                    }
                }else{
                    $categorias = $this -> categoria -> listar_categorias();
                    $this -> pages -> render('actividades/crear_actividad', ["categorias" => $categorias]);
                    $_SESSION['errores'] = $errores;
                    $this -> pages -> render('actividades/crear_actividad');
                }
            }else{
                $categorias = $this -> categoria -> listar_categorias();
                $this -> pages -> render('actividades/crear_actividad', ["categorias" => $categorias]);
            }
        }

        public function editar_actividad(){
            if(!file_exists('images')){
                mkdir('images');
            }
            // Funcion encargada de crear los productos, he usado metodos de la clase utils para validar los datos.
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $datos = $_POST['data'];
                $id = $_POST['data']['id_actividad'];
                $nombre = $this -> service -> sacarNombre($id);
                $archivo = $_FILES['data']['name'];
                        if (isset($archivo) && $archivo != "") {
                            $tipo = $_FILES['data']['type'];
                            $tamano = $_FILES['data']['size'];
                            $temp = $_FILES['data']['tmp_name'];
                            /*
                            if (!((strpos($tipo['imagen'], "image/gif") || strpos($tipo['imagen'], "image/jpeg") || strpos($tipo['imagen'], "image/jpg") || strpos($tipo['imagen'], "image/png")) && (intval($tamano['imagen']) < 200000000))) {
                                echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
                                - Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo.</b></div>';
                             } else {
                            */
                                //Si la imagen es correcta en tamaño y tipo
                                //Se intenta subir al servidor
                                if (move_uploaded_file($temp['url'], 'images/'.$archivo['url'])) {
                                    //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
                                chmod('images/'.$archivo['url'], 0777);
                                    //Mostramos el mensaje de que se ha subido co éxito
                                echo '<div><b>Se ha subido correctamente la imagen.</b></div>';
                                    //Mostramos la imagen subida
                                //echo '<p><img src="../images/'.$archivo['imagen'].'"></p>';
                            }else{
                                   //Si no se ha podido subir la imagen, mostramos un mensaje de error
                                echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
                            }
                        $this -> service -> editar_actividad($_POST['data']);
                        $this -> pages -> render('layout/mensaje', ["mensaje" => "Actividad creada con exito"]);
                    }else{
                        $this -> pages -> render('layout/mensaje', ["mensaje" => "Actividad ya existente"]);
                    }
            }else{
                $categorias = $this -> categoria -> listar_categorias();
                $actividades = $this -> service -> getAll();
                $this -> pages -> render('actividades/editar_actividad', ["categorias" => $categorias,"actividades" => $actividades]);
            }
        }


        public function listar_productos(){
            // Funcion encargada de listar los productos de la base de datos
            $_SESSION['categorias'] = $this -> categoria -> listar_categorias();
            $actividades = $this-> service -> getAll();
            $this -> pages -> render('actividades/editar_actividad', ["productos" => $actividades]);

        }


        public function listarXcategorias($id){
            // Esta funcion sirve para listar los productos por categorias es decir una vez iniciada la sesion, si pinchas en una
            // categoria te muestra los productos de dicha categoria.
                // $id = $_GET['categoria'];
                $actividades = $this -> service -> listarXcategorias($id);
                $this -> pages -> render('actividades/listarXcategorias', ["actividades" => $actividades]); 
                
        }


    

        
    }



    ?>