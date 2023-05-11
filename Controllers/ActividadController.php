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
        private CategoriaService $catservice;
        private Utils $utils;

        public function __construct(){
            $this -> pages = new Pages();
            $this -> service = new ActividadService();
            $this -> categoria = new CategoriaController();
            $this -> catservice = new CategoriaService();
            $this -> utils = new Utils();
        }

        public function index(){
            header('Location:'.$_ENV['BASE_URL']);
        }


        public function borrar_producto(){
            // FUNCIÓN QUE LLAMA AL SERVICIO PARA ACTUALIZAR LA ACTIVIDAD A 0 DE CAPACIDAD ES DECIR SE ANULA.
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $id = $_POST['id_actividad'];
                $this -> service -> borrar_actividad($id);
                header('Location:'.$_ENV['BASE_URL']);
            }else{
                header('Location:'.$_ENV['BASE_URL']);
            }
        }

        public function crear_actividad(){
            if(!file_exists('images')){
                mkdir('images');
            }
            // Funcion encargada de crear los productos, he usado metodos de la clase utils para validar los datos.
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $datos = $_POST['data'];
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

        // public function editar_actividad(){
        //     if(!file_exists('images')){
        //         mkdir('images');
        //     }
        //     // Funcion encargada de crear los productos, he usado metodos de la clase utils para validar los datos.
        //     if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //         $datos = $_POST['data'];
        //         $id = $_POST['data']['id_actividad'];
        //         $nombre = $this -> service -> sacarNombre($id);
        //         $archivo = $_FILES['data']['name'];
        //                 if (isset($archivo) && $archivo != "") {
        //                     $tipo = $_FILES['data']['type'];
        //                     $tamano = $_FILES['data']['size'];
        //                     $temp = $_FILES['data']['tmp_name'];
        //                         //Si la imagen es correcta en tamaño y tipo
        //                         //Se intenta subir al servidor
        //                         if (move_uploaded_file($temp['url'], 'images/'.$archivo['url'])) {
        //                             //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
        //                         chmod('images/'.$archivo['url'], 0777);
        //                             //Mostramos el mensaje de que se ha subido co éxito
        //                         echo '<div><b>Se ha subido correctamente la imagen.</b></div>';
        //                             //Mostramos la imagen subida
        //                     }else{
        //                            //Si no se ha podido subir la imagen, mostramos un mensaje de error
        //                         echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
        //                     }
        //                 $this -> service -> editar_actividad($_POST['data']);
        //                 $this -> pages -> render('layout/mensaje', ["mensaje" => "Actividad creada con exito"]);
        //             }else{
        //                 $this -> pages -> render('layout/mensaje', ["mensaje" => "Actividad ya existente"]);
        //             }
        //     }else{
        //         $categorias = $this -> categoria -> listar_categorias();
        //         $actividades = $this -> service -> getAll();
        //         $this -> pages -> render('actividades/editar_actividad', ["categorias" => $categorias,"actividades" => $actividades]);
        //     }
        // }

        public function editar_actividad2(){
            if(!file_exists('images')){
                mkdir('images');
            }
            // Funcion encargada de crear los productos, he usado metodos de la clase utils para validar los datos.
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                if(isset($_POST['editar_categoria'])){
                    $catego_elegida = $_POST['data']['categoria'];
                    $id_categoria = $this -> catservice -> buscarIdCategoria($catego_elegida);
                    $actividades = $this -> service -> listarXcategorias($id_categoria);
                    if(count($actividades) > 0){
                        $this -> pages -> render('actividades/editar_actividad2', ["actividades" => $actividades]);
    
                    }else{
                        $this -> pages -> render('layout/mensaje', ["mensaje" => "No hay actividades en esta categoria"]);
                        $categorias = $this -> categoria -> listar_categorias();
                        $this -> pages -> render('actividades/editar_actividad', ["categorias" => $categorias]);
                    }
                }elseif(isset($_POST['editar_nombre'])){
                    $id_actividad = $_POST['data']['id_actividad'];
                    $this -> pages -> render('actividades/editar_actividad3', ["id_actividad" => $id_actividad ]);

                }elseif(isset($_POST['editar_actividad'])){
                    $nombre = $_POST['data']['nombre'];
                    $id_acti = $_POST['data']['id_actividad'];
                    $actividad_existe = $this -> service -> comprobarNombreActividad($nombre);
                    if($actividad_existe){
                        $this -> pages -> render('layout/mensaje', ["mensaje" => "El nombre de la actividad ya existe en la Base de Datos"]);
                        $this -> pages -> render('actividades/editar_actividad3', ["id_actividad" => $id_acti ]);
                    }else{
                        $this -> service -> editarActividad($_POST['data']);
                        header('Location:'.$_ENV['BASE_URL']);

                    }
                }
                
              }else{
                $categorias = $this -> categoria -> listar_categorias();
                $actividades = $this -> service -> getAll();
                $this -> pages -> render('actividades/editar_actividad', ["categorias" => $categorias,"actividades" => $actividades]);
            }
        }





        public function listar_actividades(){
            // Funcion encargada de listar las actividades de la base de datos
            $_SESSION['categorias'] = $this -> categoria -> listar_categorias();
            $actividades = $this-> service -> getAll();
            $this -> pages -> render('actividades/listar_actividades', ["actividades" => $actividades]);

        }


        public function listarXcategorias($id){
            // Esta funcion sirve para listar las actividades por categorias es decir una vez iniciada la sesion, si pinchas en una
            // categoria te muestra las actividades de dicha categoria.
                // $id = $_GET['categoria'];
                $actividades = $this -> service -> listarXcategorias($id);
                $this -> pages -> render('actividades/listarXcategorias', ["actividades" => $actividades]); 
                
        }


    

        
    }



    ?>