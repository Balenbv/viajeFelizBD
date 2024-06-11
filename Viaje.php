<?php

class Viaje
{
    private $idViaje;                                       //idviaje bigint AUTO_INCREMENT,
    private $destino;                                       //vdestino varchar(150),
    private $cantidadMaximaPasajeros;                       //vcantmaxpasajeros int,
    private $idEmpresa;                                     //idempresa bigint,
    private $objResponsableV;                               //rnumeroempleado bigint,
    private $importe;                                       //vimporte float,
    private $ColeccionObjsPasajeros;
    private $mensajeoperacion;                    

    public function __construct()
    {
        $this->objResponsableV ='' ;
        $this->idViaje = '';
        $this->destino = '';
        $this->cantidadMaximaPasajeros ='' ;
        $this->ColeccionObjsPasajeros = [];
    }

    public function cargar($datos)
    {
        $this->setIdViaje($datos['idViaje']);
        $this->setDestino($datos['destino']);
        $this->setCantidadMaximaPasajeros($datos['cantidadMaximaPasajeros']);
        $this->setIdEmpresa($datos['idEmpresa']); 
        $this->setResponsableV($datos['numeroEmpleado']);
        $this->setImporte($datos['importe']);
        $this->setColeccionObjsPasajeros($datos['ColeccionObjsPasajeros']);
        $this->setmensajeoperacion($datos['mensajeoperacion']);
    }
    
    public function getIdViaje()
    {
        return $this->idViaje;
    }

    public function getDestino()
    {
        return $this->destino;
    }

    public function getCantidadMaximaPasajeros()
    {
        return $this->cantidadMaximaPasajeros;
    }

    public function getResponsableV()
    {
        return $this->objResponsableV;
    }

    public function getImporte()
    {
        return $this->importe;
    }

    public function getColeccionObjsPasajeros()
    {
        return $this->ColeccionObjsPasajeros;
    }

    public function getmensajeoperacion()
    {
        return $this->mensajeoperacion;
    }

    public function getIdEmpresa()
    {
        return $this->idEmpresa;
    }  
    
    public function setIdEmpresa($newIdEmpresa)
    {
        $this->idEmpresa = $newIdEmpresa;
    }

    public function setIdViaje($newIdViaje)
    {
        $this->idViaje = $newIdViaje;
    }

    public function setDestino($newDestino)
    {
        $this->destino = $newDestino;
    }

    public function setCantidadMaximaPasajeros($newCantidadMaximaPasajeros)
    {
        $this->cantidadMaximaPasajeros = $newCantidadMaximaPasajeros;
    }

    public function setResponsableV($newResponsableV)
    {
        $this->objResponsableV = $newResponsableV;
    }

    public function setImporte($newImporte)
    {
        $this->importe = $newImporte;
    }

    public function setColeccionObjsPasajeros($newColeccionObjsPasajeros)
    {
        $this->ColeccionObjsPasajeros = $newColeccionObjsPasajeros;
    }

    public function setmensajeoperacion($newMensajeOperacion)
    {
        $this->mensajeoperacion = $newMensajeOperacion;
    }

    public function Buscar($idViaje)
    {
        $base = new bdViajeFeliz();
        $consultaViaje = "SELECT * FROM viaje WHERE idviaje=" . $idViaje;
        $resp = false;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaViaje)) {
                if ($row2 = $base->Registro()) {
                    $this->setIdViaje($idViaje);
                    $this->setDestino($row2['vdestino']);
                    $this->setCantidadMaximaPasajeros($row2['vcantmaxpasajeros']);
                    $this->setResponsableV($row2['rnumeroempleado']);
                    $this->setImporte($row2['vimporte']);
                    $resp = true;
                }
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
    }

    public function listar($condicion = "")
    {
        $arreglo = null;
        $base = new bdViajeFeliz();
        $consulta = "SELECT * FROM viaje ";
        if ($condicion != "") {
            $consulta = $consulta . ' WHERE ' . $condicion;
        }
        $consulta .= " order by idviaje";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                $arreglo = array();
                while ($row2 = $base->Registro()) {
                    $obj = new Viaje();
                    $obj->Buscar($row2['idviaje']);
                    array_push($arreglo, $obj);
                }
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $arreglo;
    }
    

    public function insertar()
    {
        $base = new bdViajeFeliz();
        $resp = false;
        $consultaInsertar = "INSERT INTO viaje(idviaje,vdestino, vcantmaxpasajeros,idempresa,rnumeroempleado,vimporte) VALUES 
        (" . $this->getIdViaje() . ",'" . $this->getDestino() . "'," . $this->getCantidadMaximaPasajeros() . "," . $this->getIdEmpresa() . "," . $this->getResponsableV(). "," . $this->getImporte() . ")";
        //consulta de delegacion con getResponsableV
        
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaInsertar)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
    }

    public function modificar()
    {
        $resp = false;
        $base = new bdViajeFeliz();
        $consultaModifica = "UPDATE viaje SET vdestino='" . $this->getDestino() . "', vcantmaxpasajeros=" . $this->getCantidadMaximaPasajeros() . ", rnumeroempleado=" . $this->getResponsableV() . ", vimporte=" . $this->getImporte() . " WHERE idviaje=" . $this->getIdViaje();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaModifica)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
    }

    public function eliminar()
    {
        $base = new bdViajeFeliz();
        $resp = false;
        if ($base->Iniciar()) {
            $consultaBorra = "DELETE FROM viaje WHERE idviaje=" . $this->getIdViaje();
            if ($base->Ejecutar($consultaBorra)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
    }
    

    
    public function __toString()
    {
        return "
{$this->getResponsableV()}
************
Datos del viaje:
codigo del destino: {$this->getIdViaje()}
destino: {$this->getDestino()}
cantidad Maxima de pasajeros: {$this->getCantidadMaximaPasajeros()}
************
{$this->mostrarPasajeros()}";
    }
}