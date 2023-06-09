<?php
    namespace Repositories;
    use Lib\BaseDatos;
    use Models\Categoria;
    use PDO;
    use PDOException;

    class CategoriaRepository{
        private BaseDatos $conexion;

        public function __construct(){
            $this-> conexion = new BaseDatos();
        }

        public function crear_categoria(string $data): void {
            // Función para crear categorias con la consulta INSERT
            $sql = "INSERT INTO categorias (nombre) VALUES (:nombre)";
            $consult = $this->conexion->prepara($sql);
            $consult->bindParam(':nombre', $data, PDO::PARAM_STR);
            try {
                $consult->execute();
        
                // Cerrar la consulta
                $consult->closeCursor();
            } catch (PDOException $err) {
                echo "Error" . $err->getMessage();
            }
        }
        

        public function getAll():? array{
            // Función para conseguir un array de todos los campos de la tabla categorias
            $this -> conexion -> consulta('SELECT * FROM categorias');
            return $this -> conexion -> extraer_todos();
        }

        public function comprobarCategoria($categoria): bool {
            // Función para comprobar si existe una categoria
            $result = false;
            $cons = $this->conexion->prepara("SELECT * FROM categorias WHERE nombre = :nombre");
            $cons->bindParam(':nombre', $categoria);
            try {
                $cons->execute();
                if ($cons && $cons->rowCount() == 1) {
                    $result = true;
                }
        
                // Cerrar la consulta
                $cons->closeCursor();
            } catch (PDOException $err) {
                $result = false;
            }
            return $result;
        }
        
        

        public function buscarIdCategoria($nombre) {
            // Función para buscar el id de las categorias por nombre
            try {
                $sql = "SELECT id_categoria FROM categorias WHERE nombre = :nombre";
                $stmt = $this->conexion->prepara($sql);
                $stmt->bindParam(':nombre', $nombre);
                $stmt->execute();
                $id_categoria = $stmt->fetchColumn();
        
                // Cerrar la consulta
                $stmt->closeCursor();
        
                return $id_categoria;
            } catch (PDOException $e) {
                echo "Error al buscar ID de categoría: " . $e->getMessage();
            }
        }
        
        

        public static function obtenerCategorias(){
            // Función para obtener las categorias
            $categoria=new CategoriaRepository();
            $categoria->conexion->consulta("SELECT * FROM categorias ORDER BY id_categoria");
            return $categoria->extraer_todos(); 
        }

        public function extraer_todos():?array{
            $categorias = [];
            $categoriasData = $this -> conexion -> extraer_todos();
            foreach($categoriasData as $categoriaData){
                $categorias[] = Categoria::fromArray($categoriaData);
            }
            return $categorias;
        }

        
    }
    

        
