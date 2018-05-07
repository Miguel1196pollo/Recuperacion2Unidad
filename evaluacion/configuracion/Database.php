<?php

class Database {

    private static $instance = Null; //Instancia unica
    private $host = Null;
    private $database = Null;
    private $usuario = Null;
    private $password = Null;
    private $con = Null;

    /*
     * Metodo queda obsoleto por la implementacion de singleton.
     */

    public function getConexion() {
        $this->con = null;
        try {
            $this->con = new PDO('mysql:host=' .
                    $this->host . ';dbname=' . $this->database, $this->usuario, $this->password);
        } catch (PDOException $e) {
            echo 'No puede conectarse con la base de datos' .
            $e->getMessage();
        }
        return $this->con;
    }

    /*
     * Se crea metodo para extraer la configuracion de la conexión.
     */

    private function readXML() {
        $xmlFile = __DIR__ . "\configuracion.xml"; //Archivo xml de configuración.
        if (file_exists($xmlFile)) {
            $xmlFile = simplexml_load_file($xmlFile); // Cargar del archivo xml.
        } else {
            exit('Fallo al abrir el archivo de [configuración.xml]');
        }

        $this->host = $xmlFile->mysql[0]->host;
        $this->database = $xmlFile->mysql[0]->database;
        $this->usuario = $xmlFile->mysql[0]->user;
        $this->password = $xmlFile->mysql[0]->password;
    }

    /*
     * Se crea constructor de la clase para la incialización de Bd.[singleton].
     */

    private function __construct() {
        try {
            $this->readXML();
            $this->con = new PDO('mysql:host=' .
                    $this->host . ';dbname=' . $this->database, $this->usuario, $this->password);
        } catch (PDOException $e) {
            echo 'No puede conectarse con la base de datos' .
            $e->getMessage();
        }
    }

    /*
     * Metodo statico que regresa la unica instancia de la clase.
     * @return type Objeto de BD.
     */

    public static function getInstance() {
        if (!(self::$instance instanceof Database)) {
            self::$instance = new Database();
        }

        return self::$instance;
    }

    /*
     * Extrae la conexion de la BD.
     * @Return type Conection.
     */

    public function getConnection() {
        return $this->con;
    }

}

?>
        