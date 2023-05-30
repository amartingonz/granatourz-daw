<?php
    namespace Repositories;
    use Lib\BaseDatos;
    use Models\Reserva;
    use PDO;
    use PDOException;

    class ReservaRepository{
        private BaseDatos $conexion;

        public function __construct(){
            $this-> conexion = new BaseDatos();
        }



        public function comprobar_fecha_reserva($data){
            // Función que compueba la fecha de la reserva para ver si es válida
            try {
                $sql = "SELECT fecha_reserva FROM reservas WHERE id_usuario = :id_usuario AND id_actividad = :id_actividad";
                $stmt = $this->conexion->prepara($sql);
                $stmt->bindParam(':id_usuario', $data['id_usuario'], PDO::PARAM_INT);
                $stmt->bindParam(':id_actividad', $data['id_actividad'], PDO::PARAM_INT);
                $stmt->execute();
                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($resultado && isset($resultado['fecha_reserva'])) {
                    $fecha_reserva = $resultado['fecha_reserva'];
                    return $fecha_reserva;
                } else {
                    return false;
                }
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
                return false;
            }
        }
        
        


        public function comprobar_reserva($id_usuario,$id_actividad,$fecha_reserva){
            // Función que comprueba si un usuario tiene ya una reserva en esa actividad
            $sql = "SELECT COUNT(*) AS num_reservas FROM reservas WHERE id_usuario = :id_usuario AND id_actividad = :id_actividad AND fecha_reserva = :fecha_reserva";
            $consulta = $this->conexion->prepara($sql);
            $consulta->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $consulta->bindParam(':id_actividad', $id_actividad, PDO::PARAM_INT);
            $consulta->bindParam(':fecha_reserva', $fecha_reserva, PDO::PARAM_STR);
            $consulta->execute();
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
            $num_reservas = $resultado['num_reservas'];
            if ($num_reservas > 0) {
                return true; // Si el usuario tiene al menos una reserva para la actividad y fecha especificadas, devuelve true
            } else {
                return false; // Si el usuario no tiene ninguna reserva para la actividad y fecha especificadas, devuelve false
            }
        }
        

        public function realizar_reserva(array $data){
                // Función para crear el pedido se le pasa los datos mediante un array recogido del formulario
                $sql = ("INSERT INTO reservas (id_usuario,id_actividad,fecha_reserva) VALUES (:id_usuario,:id_actividad,:fecha_reserva)");
                $fecha = date("Y-m-d");
                $consult = $this -> conexion -> prepara($sql);
                $consult -> bindParam(':id_usuario',$data['id_usuario'],PDO::PARAM_INT);
                $consult -> bindParam(':id_actividad',$data['id_actividad'],PDO::PARAM_INT);
                $consult -> bindParam(':fecha_reserva',$fecha,PDO::PARAM_STR);
                // $consult -> bindParam(':estado','confirmado',PDO::PARAM_STR);                
                $this -> conexion -> iniciar_transaccion();
                $result = $consult -> execute();
                if(!$result){
                    $this -> conexion -> rollback();
                    return FALSE;
                }
                $sql = "UPDATE actividades SET capacidad = capacidad - 1 WHERE id_actividad = :id_actividad";
                $consult = $this -> conexion -> prepara($sql);
                $consult -> bindParam(':id_actividad',$data['id_actividad'],PDO::PARAM_STR);
                $result = $consult -> execute();
                if(!$result){
                    $this -> conexion -> rollback();
                    return FALSE;
                }
                $this -> conexion -> commit();
            }

        public function cancelar_reserva($data){
            // Función para cancelar una reserva según la id_reserva
            $sql = "DELETE FROM reservas WHERE id_reserva = :id_reserva";
            $consult = $this->conexion->prepara($sql);
            $consult->bindParam(':id_reserva', $data['id_reserva'], PDO::PARAM_INT);
                    
            $this->conexion->iniciar_transaccion();
            $result = $consult->execute();
            if (!$result) {
                $this->conexion->rollback();
                return false;
            }
                    
            $sql = "UPDATE actividades SET capacidad = capacidad + 1 WHERE id_actividad = :id_actividad";
            $consult = $this->conexion->prepara($sql);
            $consult->bindParam(':id_actividad', $data['id_actividad'], PDO::PARAM_INT);
                    
            $result = $consult->execute();
            if (!$result) {
                $this->conexion->rollback();
                return false;
            }
                    
            $this->conexion->commit();
            return true;
        }
            

        public function cancelar_reserva_usuario($data){
            // Función para cancelar una reserva según la id_reserva
            $sql = "DELETE FROM reservas WHERE id_reserva = :id_reserva";
            $consult = $this->conexion->prepara($sql);
            $consult->bindParam(':id_reserva', $data['id_reserva'], PDO::PARAM_INT);
                
            $this->conexion->iniciar_transaccion();
            $result = $consult->execute();
            if (!$result) {
                $this->conexion->rollback();
                return false;
            }
                
            $sql = "UPDATE actividades SET capacidad = capacidad + 1 WHERE id_actividad = :id_actividad";
            $consult = $this->conexion->prepara($sql);
            $consult->bindParam(':id_actividad', $data['id_actividad'], PDO::PARAM_INT);
                
            $result = $consult->execute();
            if (!$result) {
                $this->conexion->rollback();
                return false;
            }
                
            $this->conexion->commit();
            return true;
        }
        

        public function obtener_reservas_usuario_conectado($id_usuario) {
            // Función para obtener las reservas del usuario que esta conectado por el id
            try {
                $sql = "SELECT r.id_reserva, a.id_actividad, a.nombre,a.duracion,a.descripcion,a.localizacion,a.hora,a.fecha,a.capacidad,a.url, r.fecha_reserva
                        FROM reservas r
                        JOIN actividades a ON r.id_actividad = a.id_actividad
                        WHERE r.id_usuario = :id_usuario";
                $stmt = $this->conexion->prepara($sql);
                $stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                // Manejo de excepciones
                echo "Error al ejecutar la consulta: " . $e->getMessage();
                return null;
            }
        }
        
        public function sacarListadoAsistentes($id_actividad){
            // Función que realiza una consulta a la base de datos para obtener los datos de los asistentes a una actividad específica, y devuelve los resultados obtenidos en forma de un array asociativo que contiene la información de cada asistente (incluyendo su DNI, nombre, apellidos, email y teléfono).
            try {
                $sql = "SELECT r.*, u.dni, u.nombre, u.apellidos, u.email, u.telefono FROM reservas r INNER JOIN usuarios u ON r.id_usuario = u.id_usuario WHERE r.id_actividad = :id_actividad";
                $stmt = $this->conexion->prepara($sql);
                $stmt->bindParam(':id_actividad', $id_actividad);
            
                $stmt->execute();
                $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                return $resultados;
            } catch (PDOException $e) {
                // Manejo de excepciones en caso de error
                echo "Error: " . $e->getMessage();
                return array(); // Devuelve un array vacío en caso de error
            }
        }
        

        public function comprobarReservas($id_actividad){
            // Función para comprobar que hay reservas para dicha actividad pasandole la id de la actividad
            try {
                $sql = "SELECT COUNT(*) as total_reservas FROM reservas WHERE id_actividad = :id_actividad";
                $stmt = $this->conexion->prepara($sql);
                $stmt->bindParam(':id_actividad', $id_actividad);
            
                $stmt->execute();
                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                
                $totalReservas = $resultado['total_reservas'];
                
                return $totalReservas > 0;
            } catch (PDOException $e) {
                // Manejo de excepciones en caso de error
                echo "Error: " . $e->getMessage();
                return false;
            }
        }
        

}