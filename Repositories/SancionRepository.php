<?php
    namespace Repositories;
    use Lib\BaseDatos;
    use Models\Sancion;
    use PDO;
    use PDOException;

    class SancionRepository{
        private BaseDatos $conexion;

        public function __construct(){
            $this-> conexion = new BaseDatos();
        }


        public function proponer_sancion($data) {
            // Esta función sirve para los usuarios que tengan rol de organizador y sirve para proponer a un usuario para sanción, luego los administradores podrán verlo.
            $fecha = date('Y-m-d'); // Obtener la fecha actual
        
            // Preparar la consulta
            $sql = "INSERT INTO sanciones (id_usuario, id_actividad, motivo, fecha) VALUES (:id_usuario, :id_actividad, :motivo, :fecha)";
            $consult = $this->conexion->prepara($sql);
            $consult->bindParam(':id_usuario', $data['id_usuario'], PDO::PARAM_INT);
            $consult->bindParam(':id_actividad', $data['id_actividad'], PDO::PARAM_INT);
            $consult->bindParam(':motivo', $data['motivo'], PDO::PARAM_STR);
            $consult->bindParam(':fecha', $fecha, PDO::PARAM_STR);
        
            try {
                // Ejecutar la consulta
                $success = $consult->execute();
        
                // Devolver true si la consulta se ejecutó correctamente
                return $success;
            } catch (PDOException $e) {
                // Manejar el error de la base de datos
                echo 'Error: ' . $e->getMessage();
        
                // Devolver false en caso de error
                return false;
            }
        }
        
        public function getAll():? array{
            // Función para conseguir un array de todos los campos de la tabla categorias
            $this -> conexion -> consulta('SELECT * FROM sanciones');
            return $this -> conexion -> extraer_todos();
        }
        
        public function confirmar_sancion($data) {
            // Esta función sirve para que los administradores puedan confirmar las propuestas de sanción        
            // Preparar la consulta
            $sql = "UPDATE sanciones SET estado = 1 WHERE id_sancion=:id_sancion";
            $consult = $this->conexion->prepara($sql);
            $consult->bindParam(':id_sancion',$data['id_sancion'], PDO::PARAM_INT);
        
            try {
                // Ejecutar la consulta
                $success = $consult->execute();
                // Devolver true si la consulta se ejecutó correctamente
                return $success;
            } catch (PDOException $e) {
                // Manejar el error de la base de datos
                echo 'Error: ' . $e->getMessage();
        
                // Devolver false en caso de error
                return false;
            }
        }
        

        

}