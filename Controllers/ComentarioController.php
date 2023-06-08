<?php
    namespace Controllers;
    use Lib\Pages;
    use Services\ComentarioService;

    
    class ComentarioController{
        private ComentarioService $service;
        private Pages $pages;

        public function __construct(){
            $this -> pages = new Pages();
            $this -> service = new ComentarioService();
        }

        public function crear_comentario(){

            if (!file_exists('images')) {
                mkdir('images');
            }
            
            // Función para crear un comentario de una actividad
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $archivo = $_FILES['data']['name']['url'];
                
                if (isset($archivo) && $archivo != "") {
                    $tipo = $_FILES['data']['type']['url'];
                    $tamano = $_FILES['data']['size']['url'];
                    $temp = $_FILES['data']['tmp_name']['url'];
                    
                    $formatosPermitidos = array('image/webp', 'image/jpeg', 'image/jpg', 'image/png');
                    $pesoMaximo = 200000; // en bytes (200 KB)
                    
                    if (!in_array($tipo, $formatosPermitidos) || $tamano > $pesoMaximo) {
                        $mensajeError = '<b>Error. La extensión o el tamaño de los archivos no es correcta.<br/> - Se permiten archivos .jpg, .jpeg, .png y .webp, y un tamaño máximo de 200 KB.</b>';
                        $this->pages->render('layout/mensaje', ["mensaje" => $mensajeError]);
                        return;
                    }
                    
                    // Si la imagen es correcta en tamaño y tipo
                    // Se intenta subir al servidor
                    if (move_uploaded_file($temp, 'images/' . $archivo)) {
                        // Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
                        chmod('images/' . $archivo, 0777);
                        // Mostramos el mensaje de que se ha subido correctamente la imagen
                        $mensaje = '<b>Se ha subido correctamente la imagen.</b>';
                        $this->pages->render('layout/mensaje', ["mensaje" => $mensaje]);
                        header('Location:' . $_ENV['BASE_URL']);
                    } else {
                        // Si no se ha podido subir la imagen, mostramos un mensaje de error
                        $mensajeError = '<b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b>';
                        $this->pages->render('layout/mensaje', ["mensaje" => $mensajeError]);
                        return;
                    }
                }
                
                $this->service->crear_comentario($_POST['data']);
                $this->pages->render('actividades/ver_actividad');
            } else {
                header('Location:' . $_ENV['BASE_URL']);
            }
        }
        

        public function eliminar_comentario(){
            // Función para eliminar los comentarios
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $id_comentario = $_POST['id_comentario'];
                $this -> service -> eliminar_comentario($id_comentario);
                $mensajeError = '<b>Se ha borrado correctamente el comentario.</b>';
                $this->pages->render('layout/mensaje', ["mensaje" => $mensajeError]);
                header('Location:' . $_ENV['BASE_URL']);
            }
        }

        public function listar_comentarios():?array{
            // Función para listar comentarios.
            $comentarios = $this-> service -> getAll();
            return $comentarios;
        }

        
    }



    ?>