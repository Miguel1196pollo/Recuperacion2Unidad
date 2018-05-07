<?php

include_once '../configuracion/DAO.php';
include_once '../modelo/ClienteModelo.php';

class ClienteDao extends DAO {

    protected $tabla = 'cliente'; //Mapeo a tabla

    public function insertarCliente(ClienteModelo $cliente) {
        $consulta = "(nombreCliente, numeroTelefono, fechaCita, horaCita, Servicio, Total) ";

        $consulta = $consulta . "values ('" . $cliente->getNombreCliente() . "', '"
                . $cliente->getNumeroTelefono() . "', '" . $cliente->getFechaCita()
                . "', '" . $cliente->getHoraCita() . "', '" . $cliente->getServicio()
                . "', '" . $cliente->getTotal() . "'); ";

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
                $idCliente = $row['idCliente'];

                $tableHtml = $tableHtml . "<tr>" .
                        "<td>" . $idCliente . "</td>" .
                        "<td>" . $row['nombreCliente'] . "</td>" .
                        "<td>" . $row['numeroTelefono'] . "</td>" .
                        "<td>" . $row['fechaCita'] . "</td>" .
                        "<td>" . $row['horaCita'] . "</td>" .
                        "<td>" . $row['Servicio'] . "</td>" .
                        "<td>" . $row['Total'] . "</td>" .
                        "<td><a href='read_cliente.php?id=" . $idCliente . "' class='btn btn-primary left-margin'>"
                        . "<span class='glyphicon glyphicon-list'></span>Leer</a></td>" .
                        "<td><a href='update_cliente.php?id=" . $idCliente . "' class='btn btn-info left-margin'>"
                        . "<span class='glyphicon glyphicon-edit'></span>Editar</a></td>" .
                        "<td><a href='delete_cliente.php?id=" . $idCliente . "' class='btn btn-danger delete-object' onclick='return confirmation()'>"
                        . "<span class='glyphicon glyphicon-remove'></span>Eliminar</a></td>" .
                        "</tr>";
            }
            return $tableHtml;
        }
    }

    /**
     * 
     * @param type $idCliente
     * @return \ClienteModelo
     */
    public function readId($idCliente) {
        //Objeto tipo cliente para retornar el cliente buscado
        $cliente = null;

        $registros = $this->readTabla();

        if ($registros->rowCount() > 0) {
            while ($row = $registros->fetch(PDO::FETCH_ASSOC)) {
                if ($idCliente == $row['idCliente']) {
                    $cliente = new ClienteModelo();

                    $cliente->setFechaCita($row['fechaCita']);
                    $cliente->setHoraCita($row['horaCita']);
                    $cliente->setIdCliente($row['idCliente']);
                    $cliente->setNombreCliente($row['nombreCliente']);
                    $cliente->setNumeroTelefono($row['numeroTelefono']);
                    $cliente->setServicio($row['Servicio']);
                    $cliente->setTotal($row['Total']);
                }
            }
        }
        return $cliente;
    }

    /**
     * Método que modifica el registro en la base de datos
     * @return boolean True exitosamente y False no exitoso
     */
    public function updateCliente(ClienteModelo $cliente) {
        $update = "UPDATE " . $this->tabla .
                " SET " .
                " nombreCliente='" . $cliente->getNombreCliente() . "'," .
                " numeroTelefono='" . $cliente->getNumeroTelefono() . "'," .
                " fechaCita='" . $cliente->getFechaCita() . "'," .
                " horaCita='" . $cliente->getHoraCita() . "'," .
                " Servicio='" . $cliente->getServicio() . "'," .
                " Total=" . $cliente->getTotal() .
                " where idCliente=" . $cliente->getIdCliente();

        return $this->update($update);
    }

    public function deleteCliente($id) {
        return $this->delete($id);
    }

}

?>
