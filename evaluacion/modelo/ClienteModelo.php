<?php

/**
 * Description of ClienteDAO
 *
 * @author 
 */
class ClienteModelo {

    //Propiedades de le entidad
    private $idCliente;
    private $nombreCliente;
    private $numeroTelefono;
    private $fechaCita;
    private $horaCita;
    private $Servicio;
    private $Total;

    function getIdCliente() {
        return $this->idCliente;
    }

    function getNombreCliente() {
        return $this->nombreCliente;
    }

    function getNumeroTelefono() {
        return $this->numeroTelefono;
    }

    function getFechaCita() {
        return $this->fechaCita;
    }

    function getHoraCita() {
        return $this->horaCita;
    }

    function getServicio() {
        return $this->Servicio;
    }

    function getTotal() {
        return $this->Total;
    }

    function setIdCliente($idCliente) {
        $this->idCliente = $idCliente;
    }

    function setNombreCliente($nombreCliente) {
        $this->nombreCliente = $nombreCliente;
    }

    function setNumeroTelefono($numeroTelefono) {
        $this->numeroTelefono = $numeroTelefono;
    }

    function setFechaCita($fechaCita) {
        $this->fechaCita = $fechaCita;
    }

    function setHoraCita($horaCita) {
        $this->horaCita = $horaCita;
    }

    function setServicio($Servicio) {
        $this->Servicio = $Servicio;
    }

    function setTotal($Total) {
        $this->Total = $Total;
    }

}
