<?php

class Empresa{
    private $idEmpresa;             //idempresa bigint AUTO_INCREMENT,
    private $nombre;                //enombre varchar(150),
    private $direccion;             //edireccion varchar(150),
    private $coleccionViajes;       
    private $mensajeoperacion;

    public function __construct()
    {
        $this->idEmpresa = '';
        $this->nombre = '';
        $this->direccion = '';
        $this->coleccionViajes = [];
    }

    public function getIdEmpresa()
    {
        return $this->idEmpresa;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function getColeccionViajes()
    {
        return $this->coleccionViajes;
    }

    public function getMensajeOperacion()
    {
        return $this->mensajeoperacion;
    }

    public function setIdEmpresa($newIdEmpresa)
    {
        $this->idEmpresa = $newIdEmpresa;
    }

    public function setNombre($newNombre)
    {
        $this->nombre = $newNombre;
    }

    public function setDireccion($newDireccion)
    {
        $this->direccion = $newDireccion;
    }

    public function setColeccionViajes($newColeccionViajes)
    {
        $this->coleccionViajes = $newColeccionViajes;
    }

    public function setMensajeOperacion($newMensajeOperacion)
    {
        $this->mensajeoperacion = $newMensajeOperacion;
    }

    public function cargar($datos)
    {
        $this->setIdEmpresa($datos['idEmpresa']);
        $this->setNombre($datos['enombre']);
        $this->setDireccion($datos['edireccion']);
    }

    public function buscar($idEmpresa){
        $base = new bdViajeFeliz();
        $consulta = "SELECT * FROM empresa WHERE idempresa = " . $idEmpresa;
        $resp = false;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                if ($row2 = $base->Registro()) {
                    $this->setIdEmpresa($idEmpresa);
                    $this->setNombre($row2['enombre']);
                    $this->setDireccion($row2['edireccion']);
                    $resp = true;
                }
            } else {
                $this->setMensajeOperacion($base->getError());
            }
        } else {
            $this->setMensajeOperacion($base->getError());
        }
        return $resp;
    }

    public function listar($consulta = ''){

        $arregloEmpresas = null;
        $base = new bdViajeFeliz();
        $consultaEmpresas = "SELECT * FROM empresa ";
        if ($consulta != "") {
            $consultaEmpresas = $consultaEmpresas . ' WHERE ' . $consulta;
        }
        $consultaEmpresas .= " order by idempresa";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                $arregloEmpresas = array();
                while ($row2 = $base->Registro()) {
                    $obj = new Empresa();
                    $obj->Buscar($row2['idempresa']);
                    array_push($arregloEmpresas, $obj);
                }
            } else {
                $this->setMensajeOperacion($base->getError());
            }
        } else {
            $this->setMensajeOperacion($base->getError());
        }
        return $arregloEmpresas;
    }

    public function insertar(){
        $base = new bdViajeFeliz();
        $resp = false;
        $consultaInsertar = "INSERT INTO empresa(idempresa, enombre, edireccion) VALUES ('". $this->getIdEmpresa(). "','" . $this->getNombre() . "','" . $this->getDireccion() . "')";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaInsertar)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion($base->getError());
            }
        } else {
            $this->setMensajeOperacion($base->getError());
        }
        return $resp;
    }

    public function modificar(){
        $resp = false;
        $base = new bdViajeFeliz();
        $consultaModificar = "UPDATE empresa SET enombre = '" . $this->getNombre() . "', edireccion = '" . $this->getDireccion() . "' WHERE idempresa = " . $this->getIdEmpresa();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaModificar)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion($base->getError());
            }
        } else {
            $this->setMensajeOperacion($base->getError());
        }
        return $resp;
    }

    public function eliminar(){
        $base = new bdViajeFeliz();
        $resp = false;
        if ($base->Iniciar()) {
            $consultaBorrar = "DELETE FROM empresa WHERE idempresa = " . $this->getIdEmpresa();
            if ($base->Ejecutar($consultaBorrar)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion($base->getError());
            }
        } else {
            $this->setMensajeOperacion($base->getError());
        }
        return $resp;
    }
}