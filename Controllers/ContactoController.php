<?php
    namespace Controllers;
    use Lib\Pages;
    use Lib\Email;

    
    class ContactoController{

        private Pages $pages;

        public function __construct(){
            $this -> pages = new Pages();
        }
    

    public function enviar_mensaje(){
        // Funcion para enviar mensajes desde el formulario de contacto
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $nombre = $_POST['data']['nombre'];
            $correo = $_POST['data']['email'];
            $mensaje = $_POST['data']['mensaje'];
            $email = new Email(NULL,NULL);
            $email -> enviar_mensaje_contacto($correo,$nombre,$mensaje);
            $this -> pages -> render('layout/mensaje',["mensaje" => "Gracias por ponerte en contacto, responderemos lo antes posible."]);
        }
    }

}


?>


