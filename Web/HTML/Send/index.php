<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../../modules/phpmailer/src/Exception.php';
require __DIR__ . '/../../modules/phpmailer/src/PHPMailer.php';
require __DIR__ . '/../../modules/phpmailer/src/SMTP.php';


echo __DIR__;


class Mail {
    
    public function __construct() {
        $arguments = func_get_args();
        $numberOfArguments = func_num_args();

        if (method_exists($this, $function = '__construct'.$numberOfArguments)) {
            call_user_func_array(array($this, $function), $arguments);
        }
    }

    public function send() {
        require __DIR__ . '/../../PHP/secretvariables.php';
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = $phpmailer_email;                     //SMTP username
            $mail->Password   = $phpmailer_password;                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            $mail->CharSet = 'UTF-8';

            //Recipients
            $mail->setFrom('mirmeetofficial@gmail.com', 'MirMeet');
            $mail->addAddress('aleixescrihuela@iesmontsia.org', 'Aleix');     //Add a recipient
            $mail->addReplyTo('mirmeetofficial@gmail.com', 'MirMeet');

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = '¡Bienvenido a MirMeet!';
            $mail->Body    = 'Se acaba de crear una cuenta con su correo en MirMeet, la mejor red social de la historia. <br><i>Si usted no ha realizado este paso, póngase en contacto con el técnico específico Aleix.</i>';
            $mail->AltBody = 'You are not using HTML. :(';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

}

$mail = new Mail();
$mail->send();

?>