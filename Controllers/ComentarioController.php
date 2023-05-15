<?php
    namespace Controllers;
    use Lib\Pages;
    use Services\ComentarioService;
    use Utils\Utils;

    
    class ComentarioController{
        private ComentarioService $service;
        private Pages $pages;
        private Utils $utils;

        public function __construct(){
            $this -> pages = new Pages();
            $this -> service = new ComentarioService();
            $this -> utils = new Utils();
        }

        public function crear_comentario(){
            if(!file_exists('images')){
                mkdir('images');
            }
            // Función para crear un comentario de una actividad
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
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
                }
                $this -> service -> crear_comentario($_POST['data']);
                $this -> pages -> render('actividades/ver_actividad');

            }else{
                header('Location:'.$_ENV['BASE_URL']);
            }
        }
        
        public function eliminar_comentario(){
            // Funcion para eliminar los comentarios
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $id_comentario = $_POST['id_comentario'];
                $this -> service -> eliminar_comentario($id_comentario);
            }
        }

        public function listar_comentarios():?array{
            // Funcion para listar comentarios.
            $comentarios = $this-> service -> getAll();
            return $comentarios;
        }

        
    }



    ?>