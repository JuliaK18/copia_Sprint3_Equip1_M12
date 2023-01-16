<?php

require __DIR__ . '/Class_Mail.php';
require __DIR__ . '/Class_Validate.php';

class Usuari {
    private $id;
    private $nom;
    private $cognom;
    private $DNI;
    private $telefon;
    private $dataNaixement;
    private $dataInscripcio;
    private $nom_usuari;
    private $contrasenya;
    private $email;
    private $email_validat;
    private $acceptat;
    private $verificat;
    private $bloquejat;
    private $tipus_usuari;
    private $hash;
    
    public function __construct() {
        $arguments = func_get_args();
        $numberOfArguments = func_num_args();
    
        if (method_exists($this, $function = '__construct'.$numberOfArguments)) {
            call_user_func_array(array($this, $function), $arguments);
        }
      }

    public function __construct1($input) {
        if (is_int($input)) {
            $this->id = $input;
        } else if (Validate::is_email($input)) {
            $this->email = $input;
        } else {
            $this->hash = $input;
        }
    }

    public function __construct2($nom_usuari, $contrasenya) {
        $this->nom_usuari = $nom_usuari;
        $this->contrasenya = $contrasenya;

        include_once 'connect.php';
        // Recuperem la informació necessària
        // Fem la sentència per veure si existeix un usuari amb aquesta dada
        $existsQuery = $conn->prepare("SELECT Id FROM Usuari WHERE NomUsuari = ?");
        $existsQuery->bind_param('s', $this->nom_usuari);
        $existsQuery->execute();
        
        $existsResult = $existsQuery->get_result();

        // Del contrari, torna false
        $algo = $existsResult->fetch();
        return $algo['id_user'];
        
        //tancar connexioDB
        $conn->close();
    }

    public function __construct3($nom_usuari, $email, $contrasenya) {
        $this->nom_usuari = $nom_usuari;
        $this->email = $email;
        $this->contrasenya = $contrasenya;
    }
    public function __construct4($verificat) {
        $this->verificat = $verificat;
    }
    public function __construct5($nom_usuari) {
        $this->nom_usuari = $nom_usuari;
    }

    public function set_username($username) {
        $this->nom_usuari = $username;
    } 

    public function create() {
        // Connectem a la base de dades
        include 'connect.php';

        // Recuperem la informació necessària
        $username = $this->nom_usuari;
        $email = $this->email;
        $password = $this->contrasenya;

        // Fem la sentència per veure si existeix un usuari amb aquestes dades
        $existsQuery = $conn->prepare("SELECT Id FROM Usuari WHERE NomUsuari = ? OR CorreuElectronic = ?");
        $existsQuery->bind_param('ss', $username, $email);
        $existsQuery->execute();
        
        // Guardem el resultat a una variable
        $existsResult = $existsQuery->get_result();

        // Si no existeix cap usuari...
        if ($existsResult->num_rows == 0) {
            if (isset($password)) {
                return $this->create_normal();
            } else {
                return $this->create_google();
            }
        }
        // Del contrari, torna false
        return false;
        
        //tancar connexioDB
        $conn->close();
    }

    public function create_normal() {
        // Connectem a la base de dades
        include 'connect.php';

        // Recuperem la informació necessària
        $username = $this->nom_usuari;
        $email = $this->email;
        $password = $this->contrasenya;

        // Creem un hash per verificar el correu després
        $hash = bin2hex(random_bytes(32));
        $this->hash = $hash;

        // Fes un insert d'aquest usuari i torna true
        $insertQuery = $conn->prepare("INSERT INTO Usuari (NomUsuari, CorreuElectronic, Contrasenya, HashCorreuValidar, IdTipusUsuari, Acceptat) VALUES (?, ?, ?, ?, 1, 0)");
        $insertQuery->bind_param('ssss', $username, $email, $password, $hash);
        $insertQuery->execute();

        $this->send_email_validate_email();

        return true;
    }

    public function create_google() {
        // Connectem a la base de dades
        include 'connect.php';

        // Recuperem la informació necessària
        $username = $this->nom_usuari;
        $email = $this->email;

        // Fes un insert d'aquest usuari i torna true
        $insertQuery = $conn->prepare("INSERT INTO Usuari (NomUsuari, CorreuElectronic, IdTipusUsuari, CorreuValidat, Acceptat) VALUES (?, ?, 1, 1, 0)");
        $insertQuery->bind_param('ss', $username, $email);
        $insertQuery->execute();

        $this->send_email_welcome();

        return true;
    }

    public function send_email_welcome() {
        $this->nom = (isset($_SESSION['given_name'])) ? $_SESSION['given_name'] : $this->nom_usuari;

        $subject = '¡Bienvenido a MirMeet!';

        $body = "Le enviamos este correo para informarle de que su cuenta en MirMeet, @$this->nom_usuari, acaba de ser creada.
        <br><br>
        Estamos muy feliz de tenerle en MirMeet. 
        <br><br>
        Deseamos que disfrute mucho de la experiencia.
        <br><br>
        Cordialmente,
        <br>
        El equipo de MirMeet.";

        $alt = "Le enviamos este correo para informarle de que su cuenta en MirMeet, @$this->nom_usuari, acaba de ser creada.
        Estamos muy feliz de tenerle en MirMeet. 
        Deseamos que disfrute mucho de la experiencia.
        Cordialmente,
        El equipo de MirMeet.";

        $mail = new Mail($this->email, $this->nom, $subject, $body, $alt);
        $mail->send();
    }

    public function send_email_validate_email() {
        $this->nom = (isset($_SESSION['given_name'])) ? $_SESSION['given_name'] : $this->nom_usuari;

        $subject = '¡Bienvenido a MirMeet!';

        $body = "Le enviamos este correo para informarle de que está a punto de crear su cuenta en MirMeet, @$this->nom_usuari.
        <br><br>
        Para continuar, solo debe pulsar en el siguiente enlace (o puede copiarlo y pegarlo en cualquier navegador web):
        <br>
        <a href='http://localhost:88/PHP/validate-email.php?hash=$this->hash'>http://localhost:88/PHP/validate-email.php?hash=$this->hash</a>
        <br><br>
        Deseamos que disfrute mucho de la experiencia.
        <br><br>
        Cordialmente,
        <br>
        El equipo de MirMeet.";

        $alt = "Le enviamos este correo para informarle de que está a punto de crear su cuenta en MirMeet, @$this->nom_usuari.
        Para continuar, solo debe pulsar en el siguiente enlace (o puede copiarlo y pegarlo en cualquier navegador web):
        http://localhost:88/PHP/validate-email.php?hash=$this->hash
        Deseamos que disfrute mucho de la experiencia.
        Cordialmente,
        El equipo de MirMeet.";

        $mail = new Mail($this->email, $this->nom, $subject, $body, $alt);
        $mail->send();
    }

    public function send_email_recovery() {
        $this->nom = (isset($this->nom)) ? $this->nom : $this->nom_usuari;

        $subject = 'Intento de recuperar la contraseña';

        $body = "Le enviamos este correo para informarle que se ha solicitado un cambio de contraseña para su cuenta de MirMeet, @$this->nom_usuari.
        <br><br>
        Para continuar, solo debe pulsar en el siguiente enlace (o puede copiarlo y pegarlo en cualquier navegador web):
        <br>
        <a href='http://localhost:88/HTML/Recovery-2?hash=$this->hash'>http://localhost:88/HTML/Recovery-2?hash=$this->hash</a>
        <br><br>
        Si usted no ha solicitado el cambio de contraseña, puede ignorar este correo.
        <br><br>
        Cordialmente,
        <br>
        El equipo de MirMeet.";

        $alt = "Le enviamos este correo para informarle que se ha solicitado un cambio de contraseña para su cuenta de MirMeet, @$this->nom_usuari.
        Para continuar, solo debe pulsar en el siguiente enlace (o puede copiarlo y pegarlo en cualquier navegador web):
        http://localhost:88/HTML/Recovery-2?hash=$this->hash
        Si usted no ha solicitado el cambio de contraseña, puede ignorar este correo.
        Cordialmente,
        El equipo de MirMeet.";

        $mail = new Mail($this->email, $this->nom, $subject, $body, $alt);
        return $mail->send();
    }

    public function validate_email() {
        // Connectem a la base de dades
        include 'connect.php';

        // Recuperem la informació necessària
        $hash = $this->hash;

        // Fem la sentència per recuperar el correu 
        $emailQuery = $conn->prepare("UPDATE Usuari SET CorreuValidat = 1 WHERE HashCorreuValidar = ?");
        $emailQuery->bind_param('s', $hash);
        $emailQuery->execute();

        $conn->close();
    }

    public function create_normal() {
        // Connectem a la base de dades
        include 'connect.php';

        // Recuperem la informació necessària
        $username = $this->nom_usuari;
        $email = $this->email;
        $password = $this->contrasenya;

        // Creem un hash per verificar el correu després
        $hash = bin2hex(random_bytes(32));
        $this->hash = $hash;

        // Fes un insert d'aquest usuari i torna true
        $insertQuery = $conn->prepare("INSERT INTO Usuari (NomUsuari, CorreuElectronic, Contrasenya, HashCorreuValidar, IdTipusUsuari, Acceptat) VALUES (?, ?, ?, ?, 1, 0)");
        $insertQuery->bind_param('ssss', $username, $email, $password, $hash);
        $insertQuery->execute();

        $this->send_email_validate_email();

        return true;
    }

    public function create_google() {
        // Connectem a la base de dades
        include 'connect.php';

        // Recuperem la informació necessària
        $username = $this->nom_usuari;
        $email = $this->email;

        // Fes un insert d'aquest usuari i torna true
        $insertQuery = $conn->prepare("INSERT INTO Usuari (NomUsuari, CorreuElectronic, IdTipusUsuari, CorreuValidat, Acceptat) VALUES (?, ?, 1, 1, 0)");
        $insertQuery->bind_param('ss', $username, $email);
        $insertQuery->execute();

        $this->send_email_welcome();

        return true;
    }

    public function send_email_welcome() {
        $this->nom = (isset($_SESSION['given_name'])) ? $_SESSION['given_name'] : $this->nom_usuari;

        $subject = '¡Bienvenido a MirMeet!';

        $body = "Le enviamos este correo para informarle de que su cuenta en MirMeet, @$this->nom_usuari, acaba de ser creada.
        <br><br>
        Estamos muy feliz de tenerle en MirMeet. 
        <br><br>
        Deseamos que disfrute mucho de la experiencia.
        <br><br>
        Cordialmente,
        <br>
        El equipo de MirMeet.";

        $alt = "Le enviamos este correo para informarle de que su cuenta en MirMeet, @$this->nom_usuari, acaba de ser creada.
        Estamos muy feliz de tenerle en MirMeet. 
        Deseamos que disfrute mucho de la experiencia.
        Cordialmente,
        El equipo de MirMeet.";

        $mail = new Mail($this->email, $this->nom, $subject, $body, $alt);
        $mail->send();
    }

    public function send_email_validate_email() {
        $this->nom = (isset($_SESSION['given_name'])) ? $_SESSION['given_name'] : $this->nom_usuari;

        $subject = '¡Bienvenido a MirMeet!';

        $body = "Le enviamos este correo para informarle de que está a punto de crear su cuenta en MirMeet, @$this->nom_usuari.
        <br><br>
        Para continuar, solo debe pulsar en el siguiente enlace (o puede copiarlo y pegarlo en cualquier navegador web):
        <br>
        <a href='http://localhost:88/PHP/validate-email.php?hash=$this->hash'>http://localhost:88/PHP/validate-email.php?hash=$this->hash</a>
        <br><br>
        Deseamos que disfrute mucho de la experiencia.
        <br><br>
        Cordialmente,
        <br>
        El equipo de MirMeet.";

        $alt = "Le enviamos este correo para informarle de que está a punto de crear su cuenta en MirMeet, @$this->nom_usuari.
        Para continuar, solo debe pulsar en el siguiente enlace (o puede copiarlo y pegarlo en cualquier navegador web):
        http://localhost:88/PHP/validate-email.php?hash=$this->hash
        Deseamos que disfrute mucho de la experiencia.
        Cordialmente,
        El equipo de MirMeet.";

        $mail = new Mail($this->email, $this->nom, $subject, $body, $alt);
        $mail->send();
    }

    public function send_email_recovery() {
        $this->nom = (isset($this->nom)) ? $this->nom : $this->nom_usuari;

        $subject = 'Intento de recuperar la contraseña';

        $body = "Le enviamos este correo para informarle que se ha solicitado un cambio de contraseña para su cuenta de MirMeet, @$this->nom_usuari.
        <br><br>
        Para continuar, solo debe pulsar en el siguiente enlace (o puede copiarlo y pegarlo en cualquier navegador web):
        <br>
        <a href='http://localhost:88/HTML/Recovery-2?hash=$this->hash'>http://localhost:88/HTML/Recovery-2?hash=$this->hash</a>
        <br><br>
        Si usted no ha solicitado el cambio de contraseña, puede ignorar este correo.
        <br><br>
        Cordialmente,
        <br>
        El equipo de MirMeet.";

        $alt = "Le enviamos este correo para informarle que se ha solicitado un cambio de contraseña para su cuenta de MirMeet, @$this->nom_usuari.
        Para continuar, solo debe pulsar en el siguiente enlace (o puede copiarlo y pegarlo en cualquier navegador web):
        http://localhost:88/HTML/Recovery-2?hash=$this->hash
        Si usted no ha solicitado el cambio de contraseña, puede ignorar este correo.
        Cordialmente,
        El equipo de MirMeet.";

        $mail = new Mail($this->email, $this->nom, $subject, $body, $alt);
        return $mail->send();
    }

    public function validate_email() {
        // Connectem a la base de dades
        include 'connect.php';

        // Recuperem la informació necessària
        $hash = $this->hash;

        // Fem la sentència per recuperar el correu 
        $emailQuery = $conn->prepare("UPDATE Usuari SET CorreuValidat = 1 WHERE HashCorreuValidar = ?");
        $emailQuery->bind_param('s', $hash);
        $emailQuery->execute();

        $conn->close();
    }

    public function login() {
        // Connectem a la base de dades
        include_once 'connect.php';

        // Recuperem la informació necessària
        $username = $this->nom_usuari;
        $password = $this->contrasenya;

        // Fem la sentència per recuperar el nom d'usuari 
        $passwordQuery = $conn->prepare("SELECT Contrasenya FROM Usuari WHERE NomUsuari = ?");
        $passwordQuery->bind_param('s', $username);
        $passwordQuery->execute();

        // Guardem el resultat en una variable
        $passwordResult = $passwordQuery->get_result();

        // Recuperem la contrasenya de la base de dades, i si no hi ha res, tornarem null
        $passwordHashed = $passwordResult->fetch_all(MYSQLI_ASSOC)[0]['Contrasenya'] ?? '';
        
        // Retornem si coincideix la contrasenya amb el hash (si l'usuari és incorrecte, també donarà false)
        return password_verify($password, $passwordHashed);

        //tancar connexioDB
        $conn->close();
    } 

    public function validate() {
        include_once 'connect.php';
        
        // Recuperem la informació necessària
        $userID = $this->id;

        // Busquem si l'usuari existeix
        $existsQuery = $conn->prepare("SELECT Id FROM Usuari WHERE Id = ? AND Acceptat = 0");
        $existsQuery->bind_param('i', $userID);
        $existsQuery->execute();

        // Guardem el resultat en una variable
        $existsResult = $existsQuery->get_result();

        // Si existeix l'usuari
        if ($existsResult->num_rows > 0) {
            // Actualitza EstatVerificacio, perquè està verificat i retorna true
            $updateQuery = $conn->prepare("UPDATE Usuari SET Acceptat = 1 WHERE Id = ?");
            $updateQuery->bind_param('i', $userID);
            $updateQuery->execute();
            return true;
        }
        // Si no, retorna false
        return false;

        //tancar connexioDB
        $conn->close();
    }

    public function discard() {
        include_once 'connect.php';
        
        // Recuperem la informació necessària
        $userID = $this->id;

        // Busquem si l'usuari existeix
        $existsQuery = $conn->prepare("SELECT Id FROM Usuari WHERE Id = ? AND Acceptat = 0");
        $existsQuery->bind_param('i', $userID);
        $existsQuery->execute();

        // Guardem el resultat en una variable
        $existsResult = $existsQuery->get_result();

        // Si existeix l'usuari
        if ($existsResult->num_rows > 0) {
            // Actualitza EstatVerificacio, perquè està verificat i retorna true
            $updateQuery = $conn->prepare("DELETE FROM Usuari WHERE Id = ?");
            $updateQuery->bind_param('i', $userID);
            $updateQuery->execute();
            return true;
        }
        // Si no, retorna false
        return false;

        //tancar connexioDB
        $conn->close();
    }
    
    // Recuperar contraseña: https://programacion.net/articulo/sistema_de_recuperacion_de_contrasenas_con_php_y_mysql_1707

    public function recovery(){
        include_once 'connect.php';
    
        // Recuperem la informació necessària 
        $email = $this->email;

        // Creem un hash per canviar la contrasenya
        $hash = bin2hex(random_bytes(32));
        $this->hash = $hash;
    
        // Busquem l'email a la nostra base de dades amb la següent sentència
        $existsQuery = $conn->prepare("SELECT NomUsuari, Nom FROM Usuari WHERE CorreuElectronic = ?");
        $existsQuery->bind_param('s', $email);
        $existsQuery->execute();

        // Executem la sentència y la guardem a una variable
        $existsResult = $existsQuery->get_result();

        //tancar connexioDB
        $conn->close();        $data = $existsResult->fetch_all(MYSQLI_ASSOC)[0];
        $this->nom = $data['Nom'];
        $this->nom_usuari = $data['NomUsuari'];

        if ($existsResult->num_rows > 0) {
            // Assigna un hash de recuperació de contrasenya
            $updateQuery = $conn->prepare("UPDATE Usuari SET HashCanviContrasenya = ? WHERE CorreuElectronic = ?");
            $updateQuery->bind_param('ss', $hash, $email);
            $updateQuery->execute();

            return $this->send_email_recovery();
        }

        return false;
    }

    public function change_password_recovery($password) {
        include '../PHP/connect.php';

        // Recuperem la informació necessària 
        $hash = $this->hash;

        // Actualitzem la contrasenya i eliminem el hash de canvi de contrasenya
        $updateQuery = $conn->prepare("UPDATE Usuari SET Contrasenya = ?, HashCanviContrasenya = NULL WHERE HashCanviContrasenya = ?");
        $updateQuery->bind_param('ss', $password, $hash);
        $status = $updateQuery->execute();

        $conn->close();

        return $status;
    }

    public function exists_user() {
        include 'connect.php';

        // Recuperem la informació necessària 
        $email = $this->email;

        // Busquem l'email a la nostra base de dades amb la següent sentència
        $existsQuery = $conn->prepare("SELECT CorreuElectronic FROM Usuari WHERE CorreuElectronic = ?");
        $existsQuery->bind_param('s', $email);
        $existsQuery->execute();

        // Executem la sentència i guardem el resultat a una variable
        return $existsQuery->get_result()->num_rows > 0;

        //tancar connexioDB
        $conn->close();
    }

    public function create_user_from_google() {
        // Connectem a la base de dades
        include 'connect.php';

        // Recuperem la informació necessària
        $email = $this->email;

        // Fes un insert d'aquest usuari i torna true
        $insertQuery = $conn->prepare("INSERT INTO Usuari (CorreuElectronic, IdTipusUsuari, Acceptat) VALUES (?, 1, 0)");
        $insertQuery->bind_param('s', $email);
        return $insertQuery->execute();

        //tancar connexioDB
        $conn->close();
    }

    public static function get_users_not_verified($nom_usuari) {
        include_once '../../PHP/connect.php';

        // Recuperem tots els usuaris sense verificar
        $selectQuery = $conn->prepare("SELECT Id, NomUsuari, CorreuElectronic FROM Usuari WHERE Acceptat = 0");
        $selectQuery->execute();

        $result = $selectQuery->get_result();

        // Si hi ha usuaris, retornem la llista. Del contrari, retornarem false
        return ($result->num_rows > 0) ? $result->fetch_all(MYSQLI_ASSOC) : false;

        //tancar connexioDB
        $conn->close();
    }
    
    public function update_to_verify_user($nom_usuari){
        include '../../PHP/connect.php';

        //Establim la consula a la base de dades
        $sql = "UPDATE `Usuari` SET `Verificat` = '1' WHERE `Usuari`.`NomUsuari` = '$nom_usuari'";

        //Executem la consulta
        $query_run = $conn->query($sql);
       
        //tancar connexioDB
        $conn->close(); 
    }

    public function update_to_not_verify_user($nom_usuari){
        include '../../PHP/connect.php';
        //Establim la consula a la base de dades
        $sql = "UPDATE `Usuari` SET `Verificat` = '0' WHERE `Usuari`.`Id` = '$nom_usuari'";
        //Executem la consulta
        $query_run = $conn->query($sql);
        
        //tancar connexioDB
        $conn->close();

        return $query_run;     
    }

    public function change_mail($usermail){
        include '../PHP/connect.php';
        //Establim la consula a la base de dades
        $sql = "UPDATE Usuari SET Usuari.CorreuElectronic = '$usermail' WHERE Usuari.Id = $this->id;";
        //Executem la consulta
        $query_run = $conn->query($sql);
        
        //tancar connexioDB
        $conn->close();

        return $query_run;

    }

    public function change_password($password){
        include '../PHP/connect.php';

        $password = password_hash($password, PASSWORD_DEFAULT);
        //Establim la consula a la base de dades
        $sql = "UPDATE Usuari SET Usuari.Contrasenya = '$password' WHERE Usuari.Id = $this->id;";
        //Executem la consulta
        $query_run = $conn->query($sql); 
        
        //tancar connexioDB
        $conn->close();

        return $query_run;        

    }

    public static function check_verify_user(){
        include_once '../../PHP/connect.php';
        //Establim la consula a la base de dades
        $sql = "SELECT Usuari.NomUsuari, Usuari.Verificat FROM `Usuari` WHERE Verificat = 1;"        ;
        //Executem la consulta
        $query_run = $conn->query($sql);
        
        //tancar connexioDB
        $conn->close();

        return $query_run;     
    }

    public static function check_not_verify_user(){
        include_once '../../PHP/connect.php';
        
        //Establim la consula a la base de dades
        $sql = "SELECT Usuari.NomUsuari, Usuari.Verificat FROM `Usuari` WHERE Verificat = 0";

        $query_run = mysqli_query($conn, $sql);
        
        //tancar connexioDB
        $conn->close();

        return $query_run;     

    }
    public static function get_users_not_verified2() {
        include_once '../../PHP/connect.php';

        // Recuperem tots els usuaris sense verificar
        $sql = "SELECT NomUsuari as 'user' FROM Usuari WHERE Acceptat = 0";
        
        $query_run = mysqli_query($conn, $sql);
        
        //tancar connexioDB
        $conn->close();

        return $query_run;     

    }
}
?>