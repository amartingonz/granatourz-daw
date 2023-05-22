<?php

    namespace Lib;

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;

    class Email{

        public $email;

        public $token;

        public function __construct($email, $token){
            $this->email = $email;
            $this->token = $token;

        }

        public function enviarConfirmacion() {
            // Crear una instancia de PHPMailer
            $mail = new PHPMailer();
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER; // Habilitar depuración SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'tls'; // O usa 'ssl' si tu servidor lo requiere
            $mail->Port = 587; // Puerto para TLS (o 465 para SSL)
            $mail->Username = 'granatourz@gmail.com'; // Tu dirección de correo electrónico de Gmail
            $mail->Password = 'mevjwhtqgxfwzzon'; // Tu contraseña de Gmail
        
            $mail->setFrom('granatourz@gmail.com');
            $mail->addAddress($this->email); // Aquí va la dirección de correo del destinatario
            $mail->Subject = 'Confirma tu Cuenta';
        
            //Ponemos el HTML.
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
        
            $contenido = '<html>';
            $contenido .= "<p><strong>Hola " . $this->email . "<br></strong>Has creado tu cuenta en Granatourz, solo debes confirmarla presionando el siguiente enlace</p>";
            $contenido .= "<br><p>Presiona aquí: <a href='http://localhost/granatourz-daw/public/confirmar-cuenta/" . $this->token . "'>Confirmar Cuenta</a></p>";
            $contenido .= "<br><p>Si tú no solicitaste este cambio, puedes ignorar el mensaje.</p>";
            $contenido .= '</html>';
            $mail->Body = $contenido;
        
            // Enviar el correo.
            if ($mail->send()) {
                echo "El correo de confirmación se ha enviado correctamente.";
            } else {
                echo "Error al enviar el correo de confirmación: " . $mail->ErrorInfo;
            }
        }
        


        public function enviar_mensaje_contacto($email,$nombre,$mensaje) {
            // Crear una instancia de PHPMailer
            $mail = new PHPMailer();
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER; // Habilitar depuración SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'tls'; // O usa 'ssl' si tu servidor lo requiere
            $mail->Port = 587; // Puerto para TLS (o 465 para SSL)
            $mail->Username = 'granatourz@gmail.com'; // Tu dirección de correo electrónico de Gmail
            $mail->Password = 'mevjwhtqgxfwzzon'; // Tu contraseña de Gmail
            
            $mail->setFrom('granatourz@gmail.com');
            $mail->setFrom($email);
            $mail->addAddress('granatourz@gmail.com'); // Aquí va la dirección de correo del destinatario
            $mail->Subject = 'Mensaje de contacto desde Granatourz';
        
            //Ponemos el HTML.
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
        
            $contenido = '<html>';
            $contenido .= "<p><strong>". $nombre ." con el siguiente correo (". $email .") ha escrito lo siguiente mediante el formulario de contacto:<br></strong></p>";
            $contenido .= "<br><p>". $mensaje ."</p>";
            $contenido .= "<br><p>Un saludo, ". $nombre ."</p>";
            $contenido .= '</html>';
            $mail->Body = $contenido;
        
            // Enviar el correo.
            if ($mail->send()) {
                echo "El correo de confirmación se ha enviado correctamente.";
            } else {
                echo "Error al enviar el correo de confirmación: " . $mail->ErrorInfo;
            }
        }
    }

?>
