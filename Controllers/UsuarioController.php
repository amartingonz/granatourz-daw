<?php
    namespace Controllers;
    use Lib\Pages;
    use Models\Usuarios;
    use Services\UsuarioService;
    use Lib\Email;

    class UsuarioController{
        private UsuarioService $service;
        private Pages $pages;
        private CategoriaController $categoria;

        public function __construct(){
            $this -> pages = new Pages();
            $this -> service = new UsuarioService();
            $this -> categoria = new CategoriaController();
        }
        
        public function inicio(){
            $categorias = $this -> categoria -> listar_categorias();
            $this -> pages -> render('layout/header', ["categorias" => $categorias]);
        }


        public function registrar(): void{
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $email = $_POST['data']['email'];
                $datos = $_POST['data'];
                $dni = $_POST['data']['dni'];
                $existe = $this->service->comprobarEmail($email);
                $existeDni = $this->service->comprobarDni($dni);
        
                if (!$existe && !$existeDni) {
                    $this->service->save($_POST['data']);
                    $id = $this->service->max_id($email);
                    // GENERAR TOKEN (CÓDIGO ALEATORIO)
                    $code = preg_replace('/[^a-zA-Z0-9]/', '', uniqid());
                    $this->service->guardarToken($id, $code);
                    $email_obj = new Email($email, $code);
                    $email_obj->enviarConfirmacion();
                    $this -> pages -> render('layout/mensaje',["mensaje" => "Se ha enviado el correo de confirmación."]);
                } else {
                    $this->pages->render("layout/mensaje", ["mensaje" => "El email o DNI ya existe"]);
                }
            } else {
                $this->pages->render('usuarios/registro');
            }
        }
        
    
        public function confirmar_email($token){
            // Funcion para confirmar el usuario al registrar mediante correo
            $tokens = $this -> service -> confirmarEmail($token);
            $this -> service -> borrar_token($token);
            if(!empty($tokens)){
                $this -> pages -> render('layout/mensaje',["mensaje" => "Confirmado con éxito"]);
            }else{
                $this -> pages -> render('layout/mensaje',["mensaje" => "Error al confirmar tu cuenta"]);
            }
        }
      
        public function login(): void {
            // Función encargada de verificar el inicio de sesión, es decir, que el email y la contraseña sean los de la base de datos.
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $datos = $this->service->login($_POST['data']);
                if ($datos != []) {
                    $nuevo_usuario = new Usuarios($datos[0], $datos[1], $datos[2], $datos[3], $datos[4], $datos[5], $datos[6], $datos[7], $datos[8], $datos[9]);
                    $email = $nuevo_usuario->getEmail();
                    $rol = $nuevo_usuario->getRol();
                    $_SESSION['id'] = $nuevo_usuario->getId();
                    $_SESSION['nombre'] = $nuevo_usuario->getNombre();
                    $_SESSION['email'] = $email;
        
                    if (!$this->service->verificarConfirmacion($email)) {
                        $this->pages->render('layout/mensaje', ['mensaje' => 'Debes confirmar tu cuenta antes de iniciar sesión']);
                        return; // Agregar return para evitar que se siga ejecutando el código después de mostrar el mensaje
                    }
        
                    if (!$this->service->verificarSancion($nuevo_usuario->getId())) {
                        if (password_verify($_POST['data']['password'], $nuevo_usuario->getPassword())) {
                            if ($rol == 'admin') {
                                $_SESSION['admin'] = $nuevo_usuario;
                                $_SESSION['id_admin'] = $nuevo_usuario->getId();
                            } elseif ($rol == 'organizador') {
                                $_SESSION['organizador'] = $nuevo_usuario;
                                $_SESSION['id_organizador'] = $nuevo_usuario->getId();
                            } else {
                                $_SESSION['usuario'] = $nuevo_usuario;
                                $_SESSION['id_usuario'] = $nuevo_usuario->getId();
                            }
                            $this->pages->render('layout/mensaje', ["mensaje" => "Has iniciado sesión"]);
                            header("Location:" . $_ENV['BASE_URL']);
                            return; // Agregar return para evitar que se siga ejecutando el código después de redireccionar
                        } else {
                            $this->pages->render('layout/mensaje', ["mensaje" => "Error al iniciar sesión"]);
                        }
                    } else {
                        $this->pages->render('layout/mensaje', ["mensaje" => "El usuario tiene una sanción"]);
                    }
                } else {
                    $this->pages->render('layout/mensaje', ["mensaje" => "No hay datos en la base de datos"]);
                }
            } else {
                $this->pages->render('usuarios/login');
            }
        }
        
        


        public function editar_datos(){
            // Función encargada de editar datos.
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $datos = $_POST['data'];
                $this->service->editar_datos($_POST['data']);
                $this->pages->render('layout/mensaje', ["mensaje" => "Has modificado tus datos con éxito"]);
            } else {
                $this->pages->render('usuarios/editar_datos');
            }
        }
        

        public function cerrar_sesion(){
            // Funcion encargada de borrar las sesiones de usuarios.
            if(isset($_SESSION['usuario'])){
                unset($_SESSION['usuario']);
                session_destroy();
            }

            if(isset($_SESSION['admin'])){
                unset($_SESSION['admin']);
                session_destroy();
            }

            if(isset($_SESSION['organizador'])){
                unset($_SESSION['organizador']);
                session_destroy();
            }
            header("Location:".$_ENV['BASE_URL']);
        }














    }

    
?>