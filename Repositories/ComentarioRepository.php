<?php
    namespace Repositories;

use Exception;
use Lib\BaseDatos;
    use Models\Comentario;
    use PDO;
    use PDOException;

    class ComentarioRepository{
        private BaseDatos $conexion;

        public function __construct(){
            $this-> conexion = new BaseDatos();
        }

        public function crear_comentario($data){
            // Función para crear un comentario
            $archivo = $_FILES['data']['name'];
            $fecha = date("Y-m-d");

            try {
                $sql = "INSERT INTO comentarios (id_usuario, id_actividad, url, fecha, texto, valoracion) VALUES (:id_usuario, :id_actividad, :url, :fecha, :texto, :valoracion)";
        
                // Preparar la consulta
                $stmt = $this->conexion->prepara($sql);
        
                // Asignar los valores de los parámetros
                $stmt->bindParam(':id_usuario', $data['id_usuario']);
                $stmt->bindParam(':id_actividad', $data['id_actividad']);
                $stmt->bindParam(':url', $archivo['url']);
                $stmt->bindParam(':fecha', $fecha);
                $stmt->bindParam(':texto', $data['texto']);
                $stmt->bindParam(':valoracion', $data['valoracion']);

        
                // Ejecutar la consulta
                if ($stmt->execute()) {
                    // Comentario creado exitosamente
                    return true;
                } else {
                    // Error al crear el comentario
                    return false;
                }
            } catch (PDOException $e) {
                // Manejo de excepciones
                echo "Error al crear el comentario: " . $e->getMessage();
                return false;
            }
        }

        public function eliminar_comentario($id_comentario){
            // Función para eliminar los comentarios
            try {
                $sql = "DELETE FROM comentarios WHERE id_comentario = :id_comentario";
                $stmt = $this->conexion->prepara($sql);
                $stmt->bindParam(':id_comentario', $id_comentario, PDO::PARAM_INT);
                $stmt->execute();

                // Retornar true o false según el resultado de la eliminación
                return $stmt->rowCount() > 0;
                
            } catch (PDOException $e) {
                // Manejar la excepción capturada
                // Puedes mostrar un mensaje de error o lanzar una nueva excepción, por ejemplo:
                throw new Exception('Error al eliminar el comentario: ' . $e->getMessage());
            }
        }
        
        
        public function getAll():? array{
            // Función para conseguir un array de todos los campos de la tabla categorias
            $this -> conexion -> consulta('SELECT * FROM comentarios');
            return $this -> conexion -> extraer_todos();
        }

        public static function obtenerComentarios(){
            // Función para obtener los comentarios
            $comentario=new ComentarioRepository();
            $comentario-> conexion -> consulta("SELECT * FROM comentarios ORDER BY id_comentario");
            return $comentario->extraer_todos(); 
        }

        public function extraer_todos():?array{
            $comentarios = [];
            $comentariosData = $this -> conexion -> extraer_todos();
            foreach($comentariosData as $comentarioData){
                $comentarios[] = Comentario::fromArray($comentarioData);
            }
            return $comentarios;
        }

    }