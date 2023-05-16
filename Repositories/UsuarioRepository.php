<?php
    namespace Repositories;
    use Lib\BaseDatos;
    use Models\Usuarios;
    use PDO;
    use PDOException;

    class UsuarioRepository{
        private BaseDatos $conexion;
        private UsuarioRepository $repository;

        function __construct(){
            $this-> conexion = new BaseDatos();
        }

        public function save(array $usuario){
            // PARA INSERTAR DATOS EN LA BASE DE DATOS
            $sql = ("INSERT INTO usuarios(dni,nombre,apellidos,email,telefono,password,rol) values(:dni,:nombre,:apellidos,:email,:telefono,:password,:rol)");
            $dni = $usuario['dni'];
            $nombre = $usuario['nombre'];
            $apellidos = $usuario['apellidos'];
            $email = $usuario['email'];
            $telefono = $usuario['telefono'];
            $password = password_hash($usuario['password'],PASSWORD_BCRYPT,['cost' => 4]);// para cifrar la contraseña // cost es las veces que se cifra
            $rol = $usuario['rol'];
            $consult = $this -> conexion -> prepara($sql);
            $consult -> bindParam(':dni',$dni,PDO::PARAM_STR);
            $consult -> bindParam(':nombre',$nombre,PDO::PARAM_STR);
            $consult -> bindParam(':apellidos',$apellidos,PDO::PARAM_STR);
            $consult -> bindParam(':email',$email,PDO::PARAM_STR);
            $consult -> bindParam(':telefono',$telefono,PDO::PARAM_STR);
            $consult -> bindParam(':password',$password,PDO::PARAM_STR);
            $consult -> bindParam(':rol',$rol,PDO::PARAM_STR);
            try{
                $consult -> execute();
            }catch(PDOException $err){
                echo "Error ". $err -> getMessage();
            }
        }

        public function comprobarEmail($email):bool{
            // Comprueba si existe el email en la base de datos
            $result = false;
            $cons = $this->conexion->prepara("SELECT * FROM usuarios WHERE email = :email");
            $cons->bindParam(':email', $email);
    
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

        public function comprobarDni($dni):bool{
            // Comprueba si existe el email en la base de datos
            $result = false;
            $cons = $this->conexion->prepara("SELECT * FROM usuarios WHERE dni = :dni");
            $cons->bindParam(':dni', $dni);
    
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

        public function login(array $usuario){
            // PARA COMPROBAR QUE EXISTE EL USUARIO
            $sql = ("SELECT * FROM usuarios WHERE email = :email");
            $consult = $this -> conexion -> prepara($sql);
            $consult -> bindParam(':email',$usuario['email']);
            try{
                $consult-> execute();
                $datos = $consult -> fetchAll();
                if(count($datos) != 0){
                    $datos_encontrados = array($datos[0]['id_usuario'],$datos[0]['dni'],$datos[0]['nombre'],$datos[0]['apellidos'],$datos[0]['email'],$datos[0]['telefono'],$datos[0]['password'],$datos[0]['rol']);
                    return $datos_encontrados;
                }else{
                    return [];
                }
            }catch(PDOException $err){
                echo "Error".$err -> getMessage();
            }
        }


        public function editar_datos(array $usuario):void{
            // Funcion para editar los datos de usuario
            $sql = ("UPDATE usuarios SET nombre=:nombre,apellidos=:apellidos,email=:email,telefono=:telefono,password=:password  WHERE id_usuario = :id");
            $password = password_hash($usuario['password'],PASSWORD_BCRYPT,['cost' => 4]);// para cifrar la contraseña // cost es las veces que se cifra
            $fecha = date("Y-m-d");
            $consult = $this -> conexion -> prepara($sql);
            $consult -> bindParam(':id',$usuario['id_usuario'],PDO::PARAM_STR);
            $consult -> bindParam(':nombre',$usuario['nombre'],PDO::PARAM_STR);
            $consult -> bindParam(':apellidos',$usuario['apellidos'],PDO::PARAM_STR);
            $consult -> bindParam(':email',$usuario['email'],PDO::PARAM_STR);
            $consult -> bindParam(':telefono',$usuario['telefono'],PDO::PARAM_STR);
            $consult -> bindParam(':password',$password,PDO::PARAM_STR);
            
            try{
                $consult -> execute();
            }catch(PDOException $err){
                echo "Error".$err -> getMessage();
            }
            
        }


        public static function obtenerUsuarioPorId($id) {
            $usuario = new UsuarioRepository();
            $consulta = "SELECT nombre FROM usuarios WHERE id_usuario = :id_usuario";
            $statement = $usuario->conexion->prepara($consulta);
            $statement->bindValue(':id_usuario', $id, PDO::PARAM_INT);
            $statement->execute();
        
            if ($fila = $statement->fetch(PDO::FETCH_ASSOC)) {
                $nombreUsuario = $fila['nombre'];
                return $nombreUsuario;
            }
        
            return null; // Si no se encontró ningún usuario con el ID especificado, puedes retornar null o manejarlo según tus necesidades
        }
        







        /*
        public function getAll(): ?array{
            $this -> conexion -> consulta('SELECT * FROM usuarios');
            return $this -> extraer_todos();
        }
        */


    }