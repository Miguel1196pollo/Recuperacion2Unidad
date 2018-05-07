<?php

include 'Database.php';

abstract class DAO {

    /**
     * Variable que almacena la conexion hacia la BD
     */
    private $con = null;

    /**
     * Constructor que inicializa la conexion hacia la BD
     */
    function __construct() {
        $instancia = Database::getInstance();

        $this->con = $instancia->getConexion();
    }

    /**
     * Este metodo realiza un registro en la BD de una tabla
     * @param type $query
     * @return type
     */
    public function create($query) {
        //Se verifica que el query tenga datos
        if (is_null($query) || $query == "") {
            exit("La consulta viene vacia");
            return;
        }

        //Se concatena el insert
        $query = "INSERT INTO " . $this->tabla . $query;

        //Se imprime la consulta a ejecutar (SOLO EN PRUEBAS)
//        echo '<script type="text/javascript"> console.log("' . $query . '");</script>';
        //Se prepara la consulta pasando el query
        $sentencia = $this->con->prepare($query);

        //Dependiendo de la inserccion se retorna true o false
        return $sentencia->execute();
    }

    /**
     * Este metodo consulta los datos de una tabla
     * @param cadena $nombreCampo columna de la tabla
     * @param cadena $id dato a comparar con la columna
     * @return arreglo de datos encontrados
     */
    public function readTabla() {
        $query = 'SELECT * FROM ' . $this->tabla;


        

        $sentencia = $this->con->prepare($query);

        $sentencia->execute();

        return $sentencia;
    }

    /**
     * Este metodo actualiza uno o varios valores de una tabla
     * @param cadena $query datos que se actualizaran
     * @return boolean de la ejecucion del metodo
     */
    public function update($query) {
        //Se imprime la consulta a ejecutar (SOLO EN PRUEBAS)
        echo '<script type="text/javascript"> console.log("' . $query . '");</script>';

        $sentencia = $this->con->prepare($query);

        //Dependiendo de la inserccion se retorna true o false
        return $sentencia->execute();
    }

    /**
     * Este metodo elimina uno o varios registros de una tabla
     * @param cadena $nombreCliente columna de la tabla
     * @param cadena $id dato a comparar con la columna
     * @return type
     */
    public function delete($id) {
        $query = "DELETE FROM " . $this->tabla . " WHERE idCliente = " . $id;

        //Se imprime la consulta a ejecutar (SOLO EN PRUEBAS)
//        echo '<script type="text/javascript"> console.log("' . $query . '");</script>';

        $sentencia = $this->con->prepare($query);

        //Dependiendo de la inserccion se retorna true o false
        return $sentencia->execute();
    }

}
