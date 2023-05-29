<?php
    namespace Controllers;
    use Lib\Pages;
    use Models\Actividad;
    use Services\CategoriaService;
    use Services\ActividadService;


    
    class ActividadController{
        private ActividadService $service;
        private Pages $pages;
        private CategoriaController $categoria;
        private CategoriaService $catservice;

        public function __construct(){
            $this -> pages = new Pages();
            $this -> service = new ActividadService();
            $this -> categoria = new CategoriaController();
            $this -> catservice = new CategoriaService();
        }

        public function index(){
            header('Location:'.$_ENV['BASE_URL']);
        }

        public function ver_actividad(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $id = $_POST['id_actividad'];
                $actividades = $this -> service -> ver_actividad($id);
                $this -> pages -> render('actividades/ver_actividad', ["actividades" => $actividades]);
            }else{
                $this -> pages -> render('actividades/ver_actividad');
            }
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

       
        public function crear_actividad()
        {
            if (!file_exists('images')) {
                mkdir('images');
            }
        
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $nombre = $_POST['data']['nombre'];
                $archivo = $_FILES['data']['name']['url'];
        
                $existe = $this->service->comprobarActividad($nombre); // Verificar si la actividad ya existe en la base de datos
        
                if (!$existe) {
                    if (isset($archivo) && $archivo != "") {
                        $tipo = $_FILES['data']['type']['url'];
                        $tamano = $_FILES['data']['size']['url'];
                        $temp = $_FILES['data']['tmp_name']['url'];
        
                        $extension = pathinfo($archivo, PATHINFO_EXTENSION);
                        $formatosPermitidos = ['jpg', 'jpeg', 'png', 'gif'];
        
                        if (in_array($extension, $formatosPermitidos) && $tamano < 2000000000) {
                            if (move_uploaded_file($temp, 'images/' . $archivo)) {
                                chmod('images/' . $archivo, 0777);
                                $this->service->crear_actividad($_POST['data']); // Crear la actividad en la base de datos
                                $this->mostrarMensaje("Actividad creada con éxito");
                            } else {
                                $mensajeError = '<b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b>';
                                $this->mostrarMensaje($mensajeError);
                            }
                        } else {
                            $mensajeError = '<b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
                                - Se permiten archivos .jpg, .jpeg, .png y .gif, y un tamaño máximo de 200 kb.</b>';
                            $this->mostrarMensaje($mensajeError);
                        }
                    } 
                } else {
                    $this->mostrarMensaje("Actividad ya existente");
                }
            } else {
                $categorias = $this->categoria->listar_categorias();
                $this->pages->render('actividades/crear_actividad', ["categorias" => $categorias]);
            }
        }
        

    private function mostrarMensaje($mensaje)
    {
        $this->pages->render('layout/mensaje', ["mensaje" => $mensaje]);
    }

        
        
        public function editar_actividad2(){
            if (!file_exists('images')) {
                mkdir('images');
            }
        
            // Función encargada de crear los productos, he usado métodos de la clase utils para validar los datos.
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (isset($_POST['editar_categoria'])) {
                    $catego_elegida = $_POST['data']['categoria'];
                    $id_categoria = $this->catservice->buscarIdCategoria($catego_elegida);
                    $actividades = $this->service->listarXcategorias($id_categoria);
                    if (count($actividades) > 0) {
                        $this->pages->render('actividades/editar_actividad2', ["actividades" => $actividades]);
                    } else {
                        $this->pages->render('layout/mensaje', ["mensaje" => "No hay actividades en esta categoría"]);
                        $categorias = $this->categoria->listar_categorias();
                        $this->pages->render('actividades/editar_actividad', ["categorias" => $categorias]);
                    }
                } elseif (isset($_POST['editar_nombre'])) {
                    $id_actividad = $_POST['data']['id_actividad'];
                    $this->pages->render('actividades/editar_actividad3', ["id_actividad" => $id_actividad]);
                } elseif (isset($_POST['editar_actividad'])) {
                    $nombre = $_POST['data']['nombre'];
                    $id_acti = $_POST['data']['id_actividad'];
                    $actividad_existe = $this->service->comprobarNombreActividad($nombre);
        
                    if ($actividad_existe) {
                        $this->pages->render('layout/mensaje', ["mensaje" => "El nombre de la actividad ya existe en la Base de Datos"]);
                        $this->pages->render('actividades/editar_actividad3', ["id_actividad" => $id_acti]);
                    } else {
                        $archivo = $_FILES['data']['name']['url'];
        
                        if (empty($archivo)) {
                            $this->service->editarActividad($_POST['data']);
                            header('Location:' . $_ENV['BASE_URL']);
                            exit;
                        } else {
                            $extension = pathinfo($archivo, PATHINFO_EXTENSION);
                            $formatosPermitidos = ['jpg', 'jpeg', 'png', 'gif'];
                            $tamanoMaximo = 200000000;
        
                            if (in_array($extension, $formatosPermitidos) && $_FILES['data']['size']['url'] <= $tamanoMaximo) {
                                $tipo = $_FILES['data']['type']['url'];
                                $tamano = $_FILES['data']['size']['url'];
                                $temp = $_FILES['data']['tmp_name']['url'];
        
                                if (move_uploaded_file($temp, 'images/' . $archivo)) {
                                    chmod('images/' . $archivo, 0777);
                                    $_POST['data']['url'] = 'images/' . $archivo;
                                    $this->service->editarActividad($_POST['data']);
                                    header('Location:' . $_ENV['BASE_URL']);
                                    exit;
                                } else {
                                    $mensajeError = '<b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b>';
                                    $this->pages->render('layout/mensaje', ["mensaje" => $mensajeError]);

                                }
                            } else {
                                $mensajeError = '<b>Error. La extensión o el tamaño de los archivos no es correcta.<br/> - Se permiten archivos .jpg, .jpeg, .png y .gif, y un tamaño máximo de 200 KB.</b>';
                                $this->pages->render('layout/mensaje', ["mensaje" => $mensajeError]);

                                }
                            }
                        }
                    }
                }else{
                    // Agregar los renders faltantes
                    $categorias = $this -> categoria -> listar_categorias();
                    $actividades = $this -> service -> getAll();
                    $this -> pages -> render('actividades/editar_actividad', ["categorias" => $categorias,"actividades" => $actividades]);
                } 
            }
                    

        public function sacarListadoAsistentes(){
            // Función para sacar el listado de asistentes
            
            $id_usuario = $_SESSION['id_organizador'];
            $actividades = $this -> service -> sacarListadoActividades($id_usuario);           
            $this -> pages -> render('organizadores/ver_listado', ["actividades" => $actividades]);
            
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