<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMAiler;

class Email {
    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token){
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion(){

        //Crear el objeto de email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USUARIO'];
        $mail->Password = $_ENV['EMAIL_PASSWORD'];

        $mail -> setFrom('cuentas@appsalon.com');
        $mail -> addAddress('cuentas@appsalo.com', 'AppSalon.com');
        $mail -> Subject = 'Confirma tu cuenta';

        //Set HTML
        $mail -> isHTML();
        $mail -> CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong> Hola " .$this->nombre. "</strong>. Has creado tu cuenta en AppSalon. Solamente debes confirmarlo presionando el siguiente enlace. </p>";
        $contenido .= "<p> Haz click aquí: <a href='". $_ENV['APP_URL'] . "/confirmar-cuenta?token=" .$this->token. "'> Confirmar cuenta </a> </p>";
        $contenido .= "<p>Si tu no solicitaste la creación de esta cuenta, puedes ignonar este mensaje. </p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        //Enviar el email
        $mail->send();
    }

    public function enviarInstrucciones(){

        //Crear el objeto de email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USUARIO'];
        $mail->Password = $_ENV['EMAIL_PASSWORD'];

        $mail -> setFrom('cuentas@appsalon.com');
        $mail -> addAddress('cuentas@appsalo.com', 'AppSalon.com');
        $mail -> Subject = 'Reestablece tu constraseña';

        //Set HTML
        $mail -> isHTML(TRUE);
        $mail -> CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong> Hola " .$this->nombre. "</strong>. Has solicitado reestablecer tu constraseña. Sigue el siguiente enlace para hacerlo. </p>";
        $contenido .= "<p> Haz click aquí: <a href='". $_ENV['APP_URL'] . "/recuperar?token=" .$this->token. "'> Reestablece constraseña </a> </p>";
        $contenido .= "<p>Si tu no solicitaste la creación de esta cuenta, puedes ignonar este mensaje. </p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        //Enviar el email
        $mail->send();
    }
}