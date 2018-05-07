<?php

include_once '../configuracion/DAO.php';
include_once '../modelo/UsuarioModelo.php';

class UsuarioDao extends DAO {

    protected $tabla = 'usuario'; //Mapeo a tabla

    public function insertarUsuario(UsuarioModelo $usuario) {
        $consulta = "(email, password) ";

        $consulta = $consulta . "values ('" . $usuario->getEmail() . "', '" . $usuario->getPassword() . "')";

        return $this->create($consulta);
    }

    /**
     * Método que imprime el grid de los registros de cliente
     */
    public function gridHtml() {
        $tableHtml = "";

        $registros = $this->readTabla();

        if ($registros->rowCount() > 0) {
            while ($row = $registros->fetch(PDO::FETCH_ASSOC)) {

                $tableHtml = $tableHtml . "<tr>" .
                        "<td>" . $row['id'] . "</td>" .
                        "<td>" . $row['email'] . "</td>" .
                        "</tr>";
            }
            return $tableHtml;
        }
    }

    /**
     * 
     * @param type $idCliente
     * @return \UsuarioModelo
     */
    public function readNombreUsuario($nombreUsuario) {
        //Objeto tipo usuario para retornar el usuario buscado
        $usuario = null;

        $registros = $this->readTabla();

        if ($registros->rowCount() > 0) {
            while ($row = $registros->fetch(PDO::FETCH_ASSOC)) {
                if ($nombreUsuario == $row['email']) {
                    $usuario = new UsuarioModelo();

                    $usuario->setId($row['id']);
                    $usuario->setEmail($nombreUsuario);
                    $usuario->setPassword($row['password']);
                }
            }
        }
        return $usuario;
    }

    /**
     * Método que modifica el registro en la base de datos
     * @return boolean True exitosamente y False no exitoso
     */
    public function updateUsuario(UsuarioModelo $usuario) {
        $update = "UPDATE " . $this->tabla .
                " SET " .
                " email= '" . $usuario->getEmail() . "', " .
                " password= '" . $usuario->getPassword() . "'" .
                " where id= " . $$usuario->getId();

        return $this->update($update);
    }

    public function deleteUsuario($id) {
        return $this->delete($id);
    }

}
