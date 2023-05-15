<?php
    namespace Repositories;
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
                $sql = "INSERT INTO comentarios (id_usuario, id_actividad, url, fecha, texto) VALUES (:id_usuario, :id_actividad, :url, :fecha, :texto)";
        
                // Preparar la consulta
                $stmt = $this->conexion->prepara($sql);
        
                // Asignar los valores de los parámetros
                $stmt->bindParam(':id_usuario', $data['id_usuario']);
                $stmt->bindParam(':id_actividad', $data['id_actividad']);
                $stmt->bindParam(':url', $archivo['url']);
                $stmt->bindParam(':fecha', $fecha);
                $stmt->bindParam(':texto', $data['texto']);
        
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

        
        
        public function getAll():? array{
            // Funcion para conseguir un array de todos los campos de la tabla categorias
            $this -> conexion -> consulta('SELECT * FROM comentarios');
            return $this -> conexion -> extraer_todos();
        }

        public static function obtenerComentarios(){
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