<?php
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
    private $hash_verificacio_email;
    private $hash_recuperacio_contrasenya;
    
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
        } else {
            $this->email = $input;
        }
    }

    public function __construct2($nom_usuari, $contrasenya) {
        $this->nom_usuari = $nom_usuari;
        $this->contrasenya = $contrasenya;
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
        $this->hash_verificacio_email = $hash;

        // Fes un insert d'aquest usuari i torna true
        $insertQuery = $conn->prepare("INSERT INTO Usuari (NomUsuari, CorreuElectronic, Contrasenya, HashCorreuValidar, IdTipusUsuari, Acceptat) VALUES (?, ?, ?, ?, 1, 0)");
        $insertQuery->bind_param('ssss', $username, $email, $password, $hash);
        $insertQuery->execute();

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

        return true;
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
    }
    
    // Recuperar contraseña: https://programacion.net/articulo/sistema_de_recuperacion_de_contrasenas_con_php_y_mysql_1707

    public function recovery(){
        include_once 'connect.php';
    
        // Recuperem la informació necessària 
        $email = $this->email;
        $password = $this->contrasenya;
    
        // Busquem l'email a la nostra base de dades amb la següent sentència
        $existsQuery = $conn->prepare("SELECT CorreuElectronic FROM Usuari WHERE CorreuElectronic = ?");
        $existsQuery->bind_param('s', $email);
        $insertQuery->execute();

        // Executem la sentència y la guardem a una variable
        $existsResult = $existsQuery->get_result();


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
    }

    public static function get_users_not_verified($nom_usuari) {
        include_once '../../PHP/connect.php';

        // Recuperem tots els usuaris sense verificar
        $selectQuery = $conn->prepare("SELECT Id, NomUsuari, CorreuElectronic FROM Usuari WHERE Acceptat = 0");
        $selectQuery->execute();

        $result = $selectQuery->get_result();

        // Si hi ha usuaris, retornem la llista. Del contrari, retornarem false
        return ($result->num_rows > 0) ? $result->fetch_all(MYSQLI_ASSOC) : false;
    }
    
    public function update_to_verify_user($nom_usuari){
        include '../../PHP/connect.php';

        //Establim la consula a la base de dades
        $sql = "UPDATE `Usuari` SET `Verificat` = '1' WHERE `Usuari`.`NomUsuari` = '$nom_usuari'";

        //Executem la consulta
        $query_run = $conn->query($sql);
       
        mysqli_close($conn); 
    }

    public function update_to_not_verify_user($nom_usuari){
        include '../../PHP/connect.php';
        //Establim la consula a la base de dades
        $sql = "UPDATE `Usuari` SET `Verificat` = '0' WHERE `Usuari`.`Id` = '$nom_usuari'";
        //Executem la consulta
        $query_run = $conn->query($sql);
        mysqli_close($conn);  
    }

    public function change_mail($usermail){
        include '../PHP/connect.php';
        //Establim la consula a la base de dades
        $sql = "UPDATE Usuari SET Usuari.CorreuElectronic = '$usermail' WHERE Usuari.Id = $this->id;";
        //Executem la consulta
        $query_run = $conn->query($sql);
        mysqli_close($conn);
        return $query_run;

    }

    public function change_password($password){
        include '../PHP/connect.php';

        $password = password_hash($password, PASSWORD_DEFAULT);
        //Establim la consula a la base de dades
        $sql = "UPDATE Usuari SET Usuari.Contrasenya = '$password' WHERE Usuari.Id = $this->id;";
        //Executem la consulta
        $query_run = $conn->query($sql); 
        mysqli_close($conn);
        return $query_run;        

    }

    public static function check_verify_user(){
        include_once '../../PHP/connect.php';
        //Establim la consula a la base de dades
        $sql = "SELECT Usuari.NomUsuari, Usuari.Verificat FROM `Usuari` WHERE Verificat = 1;"        ;
        //Executem la consulta
        $query_run = $conn->query($sql);
        mysqli_close($conn);
        return $query_run;     
    }

    public static function check_not_verify_user(){
        include_once '../../PHP/connect.php';
        
        //Establim la consula a la base de dades
        $sql = "SELECT Usuari.NomUsuari, Usuari.Verificat FROM `Usuari` WHERE Verificat = 0";

        $query_run = mysqli_query($conn, $sql);
        mysqli_close($conn);
        return $query_run;     

    }
    public static function get_users_not_verified2() {
        include_once '../../PHP/connect.php';

        // Recuperem tots els usuaris sense verificar
        $sql = "SELECT NomUsuari as 'user' FROM Usuari WHERE Acceptat = 0";
        
        $query_run = mysqli_query($conn, $sql);
        mysqli_close($conn);
        return $query_run;     

    }
}
?>