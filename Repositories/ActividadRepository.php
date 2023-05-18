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
            try {
                $sql = "SELECT * FROM actividades WHERE id_actividad=:id_actividad";
                $stmt = $this->conexion->prepara($sql);
                $stmt->bindParam(':id_actividad', $id_actividad, PDO::PARAM_INT);
                $stmt->execute();
        
                $actividad = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
                return $actividad;
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
                return false;
            }
        }
        

        public function borrar_actividad($id):bool{
            $sql = ("UPDATE actividades SET capacidad = 0 WHERE id_actividad=:id_actividad");
            $consult = $this -> conexion -> prepara($sql);
            $consult -> bindParam(':id_actividad',$id,PDO::PARAM_INT);
            try{
                $consult->execute();
                return true;
            }catch(PDOException $err){
                echo "Error".$err -> getMessage();
                return false;
            }
        }
        //
        public function crear_actividad(array $data):void {
            //Funcion para crear productos pasandole el array recogido del formulario
            $sql = ("INSERT INTO actividades (id_usuario,id_categoria,nombre,duracion,descripcion,localizacion,hora,fecha,capacidad,url) VALUES(:id_usuario,(SELECT id_categoria FROM categorias WHERE nombre = :id_categoria),:nombre,:duracion,:descripcion,:localizacion,:hora,:fecha,:capacidad,:url)");
            // $fecha = date("Y-m-d");
            $archivo = $_FILES['data']['name'];
            $consult = $this -> conexion -> prepara($sql);

            $consult -> bindParam(':id_usuario',$data['id_usuario'],PDO::PARAM_STR);
            $consult -> bindParam(':id_categoria',$data['categoria'],PDO::PARAM_STR);
            $consult -> bindParam(':nombre',$data['nombre'],PDO::PARAM_STR);
            $consult -> bindParam(':duracion',$data['duracion'],PDO::PARAM_STR);
            $consult -> bindParam(':descripcion',$data['descripcion'],PDO::PARAM_STR);
            $consult -> bindParam(':localizacion',$data['localizacion'],PDO::PARAM_STR);
            $consult -> bindParam(':hora',$data['hora'],PDO::PARAM_STR);
            $consult -> bindParam(':fecha',$data['fecha'],PDO::PARAM_STR);
            $consult -> bindParam(':capacidad',$data['capacidad'],PDO::PARAM_INT);
            $consult -> bindParam(':url',$archivo['url'],PDO::PARAM_STR);

            try{
                // var_dump($data);die();
                $consult -> execute();
                // return true;
                
            }catch(PDOException $err){
                echo "Error".$err -> getMessage();
                // return false;
            }
        }

        public function editar_actividad(array $data):void {
            //Funcion para editar actividades pasandole el array recogido del formulario
            $sql = ("UPDATE actividades SET nombre=:nombre,duracion=:duracion,descripcion=:descripcion,localizacion=:localizacion,hora=:hora,fecha=:fecha,capacidad=:capacidad,url=:url WHERE id_actividad=:id_actividad;");
            // $fecha = date("Y-m-d");
            $archivo = $_FILES['data']['name'];


            $consult = $this -> conexion -> prepara($sql);

            $consult -> bindParam(':id_actividad',$data['id_actividad'],PDO::PARAM_INT);
            $consult -> bindParam(':nombre',$data['nombre'],PDO::PARAM_STR);
            $consult -> bindParam(':duracion',$data['duracion'],PDO::PARAM_STR);
            $consult -> bindParam(':descripcion',$data['descripcion'],PDO::PARAM_STR);
            $consult -> bindParam(':localizacion',$data['localizacion'],PDO::PARAM_STR);
            $consult -> bindParam(':hora',$data['hora'],PDO::PARAM_STR);
            $consult -> bindParam(':fecha',$data['fecha'],PDO::PARAM_STR);
            $consult -> bindParam(':capacidad',$data['capacidad'],PDO::PARAM_STR);
            $consult -> bindParam(':url',$archivo['url'],PDO::PARAM_STR);

            try{
                $consult -> execute();
                // return true;
                
            }catch(PDOException $err){
                echo "Error".$err -> getMessage();
                // return false;
            }
        }




        public function getAll():? array{
            //Consulta para extraer todos los campos de productos
            $this -> conexion -> consulta('SELECT * FROM actividades');
            return $this -> conexion -> extraer_todos();
        }

        public function comprobarActividad($producto):bool{
            // Funcion que comprueba si un producto existe
            $result = false;
            $cons = $this->conexion->prepara("SELECT * FROM actividades WHERE nombre = :nombre");
            $cons->bindParam(':nombre', $producto);
            try{
                $cons->execute();
                if($cons && $cons->rowCount() == 1){
                    $result = true;
                }
            } catch(PDOException $err){
                $result = false;
            }
            return $result;
        }

        public function editarActividad($data){
            //Funcion para editar actividades pasandole el array recogido del formulario
            $sql = ("UPDATE actividades SET nombre=:nombre,duracion=:duracion,descripcion=:descripcion,localizacion=:localizacion,hora=:hora,fecha=:fecha,capacidad=:capacidad,url=:url WHERE id_actividad=:id_actividad;");
            // $fecha = date("Y-m-d");
            $archivo = $_FILES['data']['name'];
            $consult = $this -> conexion -> prepara($sql);

            $consult -> bindParam(':id_actividad',$data['id_actividad'],PDO::PARAM_INT);
            $consult -> bindParam(':nombre',$data['nombre'],PDO::PARAM_STR);
            $consult -> bindParam(':duracion',$data['duracion'],PDO::PARAM_STR);
            $consult -> bindParam(':descripcion',$data['descripcion'],PDO::PARAM_STR);
            $consult -> bindParam(':localizacion',$data['localizacion'],PDO::PARAM_STR);
            $consult -> bindParam(':hora',$data['hora'],PDO::PARAM_STR);
            $consult -> bindParam(':fecha',$data['fecha'],PDO::PARAM_STR);
            $consult -> bindParam(':capacidad',$data['capacidad'],PDO::PARAM_STR);
            $consult -> bindParam(':url',$archivo['url'],PDO::PARAM_STR);

            try{
                $consult -> execute();
                // return true;
                
            }catch(PDOException $err){
                echo "Error".$err -> getMessage();
                // return false;
            }




        }


        public function buscarActividad($cod):?array{
            $sql = ("SELECT * FROM actividades WHERE id_categoria = $cod");
            $this -> conexion -> consulta($sql);
            return $this -> conexion -> extraer_todos();
        }
        
        // public function listarXcategorias($data):? array{
        //     //Consulta para extraer todos los campos de productos por categorias
        //     $sql = ("SELECT * FROM actividades WHERE id_categoria = $data");
        //     $this -> conexion -> consulta($sql);
        //     return $this -> conexion -> extraer_todos();
        // }

        public function listarXcategorias($data): ?array {
            try {
                $sql = "SELECT * FROM actividades WHERE id_categoria = :id_categoria";
                $stmt = $this->conexion->prepara($sql);
                $stmt->bindParam(':id_categoria', $data);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "Error al listar actividades por categoría: " . $e->getMessage();
                return null;
            }
        }
        

        public function extraer_todos():?array{
            // Devuelve un array, llama al metodo extraer todos de la base de datos
            $productos = [];
            $ProductoData = $this -> conexion -> extraer_todos();
            foreach($ProductoData as $ProductoData){
                $productos[] = Actividad::fromArray($ProductoData);
            }
            return $productos;
        }

        // public function sacarNombre($data){
        //     $sql = ("SELECT nombre FROM actividades WHERE id_actividad = $data");
        //     $this -> conexion -> consulta($sql);
        //     return $this -> conexion -> extraer_todos();
        // }

        public function sacarNombre($data){
            try {
                $stmt = $this->conexion->prepara("SELECT nombre FROM actividades WHERE id_actividad = :id_actividad");
                $stmt->bindParam(":id_actividad", $data, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                // Manejo de la excepción
                echo "Error al ejecutar la consulta: " . $e->getMessage();
                return null;
            }
        }
        

        public function comprobarNombreActividad($nombre): bool{
            try {
                $sql = "SELECT COUNT(*) FROM actividades WHERE nombre = :nombre";
                $stmt = $this->conexion->prepara($sql);
                $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->fetchColumn() > 0;
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
                return $resultado['capacidad'];
            } catch(PDOException $err) {
                echo "Error" . $err->getMessage();
                return false;
            }
        }
        


        public function sacarListadoActividades($id_usuario){
            try {
                $sql = "SELECT * FROM actividades WHERE id_usuario=:id_usuario";
                $stmt = $this->conexion->prepara($sql);
                $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
                $stmt->execute();
        
                $actividad = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
                return $actividad;
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
                return false;
            }
        }




        public function filasAfectadas(){
            return $this -> conexion -> filasAfectadas();
        }

    

       
    }