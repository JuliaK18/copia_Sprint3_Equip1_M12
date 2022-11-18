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
    
    public function __construct($id) {
		$params = func_get_args(); // paràmetres
		$num_params = func_num_args(); // nombre de paràmetres

        // Construïm el nom de la funció
		$funcion_constructor ='__construct'.$num_params;
		// Si existeix
		if (method_exists($this,$funcion_constructor)) {
			// Cridem la funció
			call_user_func_array(array($this,$funcion_constructor),$params);
		}
    }

    public function __construct1($id) {
        $this->id = $id;
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

    public function create() {
        // Connectem a la base de dades
        include_once 'connect.php';

        // Recuperem la informació necessària
        $username = $this->nom_usuari;
        $email = $this->email;
        $password = $this->contrasenya;

        // Fem la sentència per veure si existeix un usuari amb aquestes dades
        $existsQuery = $conn->prepare("SELECT Id FROM Usuari WHERE NomUsuari = ? OR CorreuElectronic = ?");
        $existsQuery->bind_param('ss', $username, $email);
        $existsQuery->execute();

        // Creem un hash per verificar el correu després
        $hash = bin2hex(random_bytes(32));
        $this->hash_verificacio_email = $hash;
        
        // Guardem el resultat a una variable
        $existsResult = $existsQuery->get_result();

        // Si no existeix cap usuari...
        if ($existsResult->num_rows == 0) {
            // Fes un insert d'aquest usuari i torna true
            $insertQuery = $conn->prepare("INSERT INTO Usuari (NomUsuari, CorreuElectronic, Contrasenya, HashCorreuValidar, IdTipusUsuari, Acceptat) VALUES (?, ?, ?, ?, 1, 0)");
            $insertQuery->bind_param('ssss', $username, $email, $password, $hash);
            $insertQuery->execute();

            // Recuperem la id d'aquest usuari i la guardem
            return true;
        }
        // Del contrari, torna false
        return false;
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

    public static function get_users_not_verified() {
        include_once '../../PHP/connect.php';

        // Recuperem tots els usuaris sense verificar
        $selectQuery = $conn->prepare("SELECT Id, NomUsuari, CorreuElectronic FROM Usuari WHERE Acceptat = 0");
        $selectQuery->execute();

        $result = $selectQuery->get_result();

        // Si hi ha usuaris, retornem la llista. Del contrari, retornarem false
        return ($result->num_rows > 0) ? $result->fetch_all(MYSQLI_ASSOC) : false;
    }
}



?>