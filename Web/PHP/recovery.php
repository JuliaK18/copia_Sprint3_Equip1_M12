<?php
if(isset($_POST['forgotPwd'])){
    //Comprova si email està buit
    if(!empty($_POST['email'])){
        //Comprova que el email existeix a la base de dades
        $prevCon['where'] = array('email'=>$_POST['email']);
        $prevCon['return_type'] = 'count';
        $prevUser = $user->getRows($prevCon);
        if($prevUser > 0){
            //Generar un hash
            $uniqidStr = md5(uniqid(mt_rand()));;
            
            //Actualitzar les dades amb el hash
            $conditions = array(
                'email' => $_POST['email']
            );
            $data = array(
                'HashRecovery' => $uniqidStr
            );
            $update = $user->update($data, $conditions);
            
            if($update){
                $resetPassLink = '/HTML/Recovery-2/index.html'.$uniqidStr;
                
                //Obtenir email del usuari
                $con['where'] = array('email'=>$_POST['email']);
                $con['return_type'] = 'single';
                $userDetails = $user->getRows($con);
                
                //Enviar correu per a restablir contrasenya
                $to = $userDetails['email'];
                $subject = "Petición de cambio de contraseña";
                $mailContent = 'Estimado '.$userDetails['Cognom'].', 
                <br/>Recientemente se envió una solicitud para restablecer una contraseña para su cuenta. Si esto fue un error, simplemente ignore este correo electrónico y no pasará nada.
                <br/>Para restablecer su contraseña, visite el siguiente enlace: <a href="'.$resetPassLink.'">'.$resetPassLink.'</a>
                <br/><br/>Saludos';
                //Establir la capçalera de tipus de contingut per enviar correu electrònic HTML
                $headers = "MIME-Version: 1.0" . "rn";
                $headers .= "Content-type:text/html;charset=UTF-8" . "rn";
                //Capçalera adicional
                $headers .= 'From: Tu<[email protected]>' . "rn";
                //Enviar email
                mail($to,$subject,$mailContent,$headers);
                
                $sessData['status']['type'] = 'success';
                $sessData['status']['msg'] = 'Por favor revise su correo electrónico, hemos enviado un enlace de restablecimiento de contraseña a su correo electrónico registrado.';
            }else{
                $sessData['status']['type'] = 'error';
                $sessData['status']['msg'] = 'Ocurrió algún problema, inténtalo de nuevo.';
            }
        }else{
            $sessData['status']['type'] = 'error';
            $sessData['status']['msg'] = 'El correo electrónico dado no está asociado con ninguna cuenta.'; 
        }
        
    }else{
        $sessData['status']['type'] = 'error';
        $sessData['status']['msg'] = 'Ingrese el correo electrónico para crear una nueva contraseña para su cuenta.'; 
    }
    //Emmagatzemar l'estat de restabliment de la contrasenya a la sessió
    $_SESSION['sessData'] = $sessData;
    //Redirigeix ​​a la pàgina de contrasenya oblidada
    header("/HTML/Recovery/index.php");
}elseif(isset($_POST['resetBtn'])){
    $fp_code = '';
    if(!empty($_POST['password']) && !empty($_POST['confirm_password']) && !empty($_POST['fp_code'])){
        $fp_code = $_POST['fp_code'];
        //Contrasenya i confirmació de comparació de contrasenyes
        if($_POST['password'] !== $_POST['confirm_password']){
            $sessData['status']['type'] = 'error';
            $sessData['status']['msg'] = 'Confirm password must match with the password.'; 
        }else{
            //Comprovar si el codi d'identitat existeix a la base de dades
            $prevCon['where'] = array('forgot_pass_identity' => $fp_code);
            $prevCon['return_type'] = 'single';
            $prevUser = $user->getRows($prevCon);
            if(!empty($prevUser)){
                //Actualitzar les dades amb una nova contrasenya
                $conditions = array(
                    'forgot_pass_identity' => $fp_code
                );
                $data = array(
                    'password' => md5($_POST['password'])
                );
                $update = $user->update($data, $conditions);
                if($update){
                    $sessData['status']['type'] = 'success';
                    $sessData['status']['msg'] = 'Your account password has been reset successfully. Please login with your new password.';
                }else{
                    $sessData['status']['type'] = 'error';
                    $sessData['status']['msg'] = 'Some problem occurred, please try again.';
                }
            }else{
                $sessData['status']['type'] = 'error';
                $sessData['status']['msg'] = 'You does not authorized to reset new password of this account.';
            }
        }
    }else{
        $sessData['status']['type'] = 'error';
        $sessData['status']['msg'] = 'All fields are mandatory, please fill all the fields.'; 
    }
    //Emmagatzemar l'estat de restabliment de la contrasenya a la sessió
    $_SESSION['sessData'] = $sessData;
    $redirectURL = ($sessData['status']['type'] == 'success')?'index.php':'resetPassword.php?fp_code='.$fp_code;
    //Redirigeix ​​a la pàgina d'inici de sessió/restabliment de la contrasenya
    header("Location:".$redirectURL);
}