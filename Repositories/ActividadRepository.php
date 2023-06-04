<?php
    namespace Repositories;
    use Lib\BaseDatos;
    use Models\Actividad;
    use PDO;
    use PDOException;

    class ActividadRepository{
        private BaseDatos $conexion;

        public function __construct(){
            $this-> conexion = new BaseDatos();
        }

        public function ver_actividad($id_actividad){
            // Función para sacar los datos de las actividades por el id
            try {
                $sql = "SELECT * FROM actividades WHERE id_actividad=:id_actividad";
                $stmt = $this->conexion->prepara($sql);
                $stmt->bindParam(':id_actividad', $id_actividad, PDO::PARAM_INT);
                $stmt->execute();
        
                $actividad = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
                // Cerrar la consulta
                $stmt->closeCursor();
        
                return $actividad;
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
                return false;
            }
        }
        
        

        public function borrar_actividad($id): bool {
            // Función que pone la capacidad de la actividad a 0
            $sql = "UPDATE actividades SET capacidad = 0 WHERE id_actividad=:id_actividad";
            $consult = $this->conexion->prepara($sql);
            $consult->bindParam(':id_actividad', $id, PDO::PARAM_INT);
            try {
                $consult->execute();
        
                // Cerrar la consulta
                $consult->closeCursor();
        
                return true;
            } catch (PDOException $err) {
                echo "Error" . $err->getMessage();
                return false;
            }
        }
        
        
        public function crear_actividad(array $data): void {
            // Función para crear actividad pasándole el array recogido del formulario
            $sql = "INSERT INTO actividades (id_usuario, id_categoria, nombre, duracion, descripcion, localizacion, hora, fecha, capacidad, url) VALUES (:id_usuario, (SELECT id_categoria FROM categorias WHERE nombre = :id_categoria), :nombre, :duracion, :descripcion, :localizacion, :hora, :fecha, :capacidad, :url)";
            
            $archivo = $_FILES['data']['name'];
            $consult = $this->conexion->prepara($sql);
        
            $consult->bindParam(':id_usuario', $data['id_usuario'], PDO::PARAM_STR);
            $consult->bindParam(':id_categoria', $data['categoria'], PDO::PARAM_STR);
            $consult->bindParam(':nombre', $data['nombre'], PDO::PARAM_STR);
            $consult->bindParam(':duracion', $data['duracion'], PDO::PARAM_STR);
            $consult->bindParam(':descripcion', $data['descripcion'], PDO::PARAM_STR);
            $consult->bindParam(':localizacion', $data['localizacion'], PDO::PARAM_STR);
            $consult->bindParam(':hora', $data['hora'], PDO::PARAM_STR);
            $consult->bindParam(':fecha', $data['fecha'], PDO::PARAM_STR);
            $consult->bindParam(':capacidad', $data['capacidad'], PDO::PARAM_INT);
            $consult->bindParam(':url', $archivo['url'], PDO::PARAM_STR);
        
            try {
                $consult->execute();
        
                // Cerrar la consulta
                $consult->closeCursor();
            } catch (PDOException $err) {
                echo "Error" . $err->getMessage();
            }
        }
        

        public function editar_actividad(array $data): void {
            // Función para editar actividades pasándole el array recogido del formulario
            $sql = "UPDATE actividades SET nombre=:nombre, duracion=:duracion, descripcion=:descripcion, localizacion=:localizacion, hora=:hora, fecha=:fecha, capacidad=:capacidad, url=:url WHERE id_actividad=:id_actividad";
            
            $archivo = $_FILES['data']['name'];
            $consult = $this->conexion->prepara($sql);
        
            $consult->bindParam(':id_actividad', $data['id_actividad'], PDO::PARAM_INT);
            $consult->bindParam(':nombre', $data['nombre'], PDO::PARAM_STR);
            $consult->bindParam(':duracion', $data['duracion'], PDO::PARAM_STR);
            $consult->bindParam(':descripcion', $data['descripcion'], PDO::PARAM_STR);
            $consult->bindParam(':localizacion', $data['localizacion'], PDO::PARAM_STR);
            $consult->bindParam(':hora', $data['hora'], PDO::PARAM_STR);
            $consult->bindParam(':fecha', $data['fecha'], PDO::PARAM_STR);
            $consult->bindParam(':capacidad', $data['capacidad'], PDO::PARAM_STR);
            $consult->bindParam(':url', $archivo['url'], PDO::PARAM_STR);
        
            try {
                $consult->execute();
        
                // Cerrar la consulta
                $consult->closeCursor();
            } catch (PDOException $err) {
                echo "Error" . $err->getMessage();
            }
        }
        




        public function getAll():? array{
            //Consulta para extraer todos los campos de actividades
            $this -> conexion -> consulta('SELECT * FROM actividades');
            return $this -> conexion -> extraer_todos();
        }

        public function comprobarActividad($actividad): bool {
            // Función que comprueba si una actividad existe
            $result = false;
            $cons = $this->conexion->prepara("SELECT * FROM actividades WHERE nombre = :nombre");
            $cons->bindParam(':nombre', $actividad);
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
        

        public function editarActividad($data){
            // Función para editar actividades pasándole el array recogido del formulario
            $sql = "UPDATE actividades SET nombre=:nombre, duracion=:duracion, descripcion=:descripcion, localizacion=:localizacion, hora=:hora, fecha=:fecha, capacidad=:capacidad, url=:url WHERE id_actividad=:id_actividad";
            // $fecha = date("Y-m-d");
            $archivo = $_FILES['data']['name'];
            $consult = $this->conexion->prepara($sql);
        
            $consult->bindParam(':id_actividad', $data['id_actividad'], PDO::PARAM_INT);
            $consult->bindParam(':nombre', $data['nombre'], PDO::PARAM_STR);
            $consult->bindParam(':duracion', $data['duracion'], PDO::PARAM_STR);
            $consult->bindParam(':descripcion', $data['descripcion'], PDO::PARAM_STR);
            $consult->bindParam(':localizacion', $data['localizacion'], PDO::PARAM_STR);
            $consult->bindParam(':hora', $data['hora'], PDO::PARAM_STR);
            $consult->bindParam(':fecha', $data['fecha'], PDO::PARAM_STR);
            $consult->bindParam(':capacidad', $data['capacidad'], PDO::PARAM_STR);
            $consult->bindParam(':url', $archivo['url'], PDO::PARAM_STR);
        
            try {
                $consult->execute();
        
                // Cerrar la consulta
                $consult->closeCursor();
            } catch (PDOException $err) {
                echo "Error" . $err->getMessage();
            }
        }
        


        public function buscarActividad($cod):?array{
            $sql = ("SELECT * FROM actividades WHERE id_categoria = $cod");
            $this -> conexion -> consulta($sql);
            return $this -> conexion -> extraer_todos();
        }
        


        public function listarXcategorias($data): ?array {
            // Función para sacar las actividades por el id de las categorias
            try {
                $sql = "SELECT * FROM actividades WHERE id_categoria = :id_categoria";
                $stmt = $this->conexion->prepara($sql);
                $stmt->bindParam(':id_categoria', $data);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
                // Cerrar la consulta
                $stmt->closeCursor();
        
                return $result;
            } catch (PDOException $e) {
                echo "Error al listar actividades por categoría: " . $e->getMessage();
                return null;
            }
        }
        
        

        public function extraer_todos():?array{
            // Devuelve un array, llama al metodo extraer todos de la base de datos
            $actividad = [];
            $ActividadData = $this -> conexion -> extraer_todos();
            foreach($ActividadData as $ActiviData){
                $actividad[] = Actividad::fromArray($ActiviData);
            }
            return $actividad;
        }



        public function sacarNombre($data){
            // Función para sacar el nombre de la actividad por el id
            try {
                $stmt = $this->conexion->prepara("SELECT nombre FROM actividades WHERE id_actividad = :id_actividad");
                $stmt->bindParam(":id_actividad", $data, PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
                // Cerrar la consulta
                $stmt->closeCursor();
        
                return $result;
            } catch (PDOException $e) {
                // Manejo de la excepción
                echo "Error al ejecutar la consulta: " . $e->getMessage();
                return null;
            }
        }
        
        

        public function comprobarNombreActividad($nombre): bool {
            // Función que comprueba si el nombre de la actividad se encuentra en la BD
            try {
                $sql = "SELECT COUNT(*) FROM actividades WHERE nombre = :nombre";
                $stmt = $this->conexion->prepara($sql);
                $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
                $stmt->execute();
                $result = $stmt->fetchColumn() > 0;
        
                // Cerrar la consulta
                $stmt->closeCursor();
        
                return $result;
            } catch (PDOException $e) {
                // Manejar excepciones aquí
                error_log($e->getMessage());
                return false;
            }
        }
        

        public function obtenerCapacidad($id) {
            // FUNCION PARA OBTENER LA CAPACIDAD DISPONIBLES DE LA ACTIVIDAD
            $sql = "SELECT capacidad FROM actividades WHERE id_actividad = :id_actividad";
            $consult = $this->conexion->prepara($sql);
            $consult->bindParam(':id_actividad', $id, PDO::PARAM_INT);
            try {
                $consult->execute();
                $resultado = $consult->fetch(PDO::FETCH_ASSOC);
        
                // Cerrar la consulta
                $consult->closeCursor();
        
                return $resultado['capacidad'];
            } catch(PDOException $err) {
                echo "Error" . $err->getMessage();
                return false;
            }
        }
        
        


        
        public function sacarListadoActividades($id_usuario) {
            // Función encargada de sacar el listado de actividades según el id del usuario
            try {
                $sql = "SELECT * FROM actividades WHERE id_usuario = :id_usuario";
                $stmt = $this->conexion->prepara($sql);
                $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
                $stmt->execute();
        
                $actividades = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
                // Cerrar la consulta
                $stmt->closeCursor();
        
                return $actividades;
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
                return false;
            }
        }
        
        




        public function filasAfectadas(){
            return $this -> conexion -> filasAfectadas();
        }

    

       
    }