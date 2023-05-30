<?php 
    namespace Services;
    use Repositories\UsuarioRepository;

    class UsuarioService{
            private UsuarioRepository $repository;
        
            function __construct() {
                $this->repository = new UsuarioRepository();
            }
        
            public function comprobarEmail(string $email){
                //Funcion para llamar al metodo del repositorio para saber si existe el email en la Base de Datos
                return $this -> repository -> comprobarEmail($email);
            }

            public function comprobarDni(string $dni){
                //Funcion para llamar al metodo del repositorio para saber si existe el dni en la Base de Datos
                return $this -> repository -> comprobarDni($dni);
            }

            public function save(array $usuario) : void {
                //Funcion para guardar que usa el metodo del repositorio, donde se le pasa un array de datos.
                $this -> repository -> save($usuario);
            }
            
            public function login(array $usuario):?array{
                //Funcion para login que usa el metodo del repositorio, donde se le pasa un array de datos.
                return $this -> repository -> login($usuario);
            }

            public function editar_datos(array $usuario):void{
                //Funcion para editar datos que usa el metodo del repositorio, donde se le pasa un array de datos.
                $this -> repository -> editar_datos($usuario);
            }

            public function max_id($email){
                // Devuelve el id del ultimo email insertado
                return $this -> repository -> max_id($email);
            }

            public function guardarToken($id,$token):bool{
                // Función que llama al metodo del repositorio guardarToken
                return $this -> repository -> guardarToken($id,$token);
            }

            public function confirmarEmail($token):bool{
                // Función que llama al metodo del repositorio confirmarEmail
                return $this -> repository -> confirmarEmail($token);
            }

            public function borrar_token($token):bool{
                // Función que llama al metodo del repositorio borrar_token
                return $this -> repository -> borrar_token($token);
            }

            public function verificarConfirmacion($email) {
                // Función que llama al metodo del repositorio verificarConfirmacion
                return $this -> repository -> verificarConfirmacion($email);
            }

            public function verificarSancion($idUsuario){
                // Función que llama al metodo del repositorio verificarSancion
                return $this -> repository -> verificarSancion($idUsuario);
            }

        }

    

?>