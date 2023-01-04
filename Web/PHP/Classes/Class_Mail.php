<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../../modules/phpmailer/src/Exception.php';
require __DIR__ . '/../../modules/phpmailer/src/PHPMailer.php';
require __DIR__ . '/../../modules/phpmailer/src/SMTP.php';

class Mail {

    private $to; 
    private $alias; 
    private $subject; 
    private $body; 
    private $alt; 
    
    public function __construct() {
        $arguments = func_get_args();
        $numberOfArguments = func_num_args();

        if (method_exists($this, $function = '__construct'.$numberOfArguments)) {
            call_user_func_array(array($this, $function), $arguments);
        }
    }

    public function __construct4($to, $subject, $body, $alt) {
        $this->to = $to;
        $this->alias = $to;
        $this->subject = $subject;
        $this->body = $body;
        $this->alt = $alt;
    }

    public function __construct5($to, $alias, $subject, $body, $alt) {
        $this->to = $to;
        $this->alias = $alias;
        $this->subject = $subject;
        $this->body = $body;
        $this->alt = $alt;
    }

    public function send() {
        require __DIR__ . '/../secretvariables.php';
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = $phpmailer_email;                     //SMTP username
            $mail->Password   = $phpmailer_password;                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            $mail->CharSet = 'UTF-8';

            //Recipients
            $mail->setFrom($phpmailer_email, 'MirMeet');
            $mail->addAddress($this->to, $this->alias);     //Add a recipient
            $mail->addReplyTo($phpmailer_email, 'MirMeet');

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $this->subject;
            $mail->Body    = $this->body;
            $mail->AltBody = $this->alt;

            $mail->send();
        } catch (Exception $e) {
            
        }
    }

}
?>