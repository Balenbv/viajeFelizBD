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

    public function __construct($objResponsableV, $idViaje, $destino, $cantidadMaximaPasajeros, $ColeccionObjsPasajeros)
    {
        $this->objResponsableV = $objResponsableV;
        $this->idViaje = $idViaje;
        $this->destino = $destino;
        $this->cantidadMaximaPasajeros = $cantidadMaximaPasajeros;
        $this->ColeccionObjsPasajeros = $ColeccionObjsPasajeros;
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
        $consulta = "SELECT * FROM viaje WHERE idviaje = " . $idViaje;
        $resp = false;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
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
        $arregloViaje = null;
        $base = new bdViajeFeliz();
        $consulta = "SELECT * FROM viaje ";
        if ($condicion != "") {
            $consulta = $consulta . ' WHERE ' . $condicion;
        }
        $consulta .= " order by idviaje";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                $arregloViaje = array();
                while ($row2 = $base->Registro()) {
                    $obj = new Viaje();
                    $obj->Buscar($row2['idviaje']);
                    array_push($arregloViaje, $obj);
                }
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $arregloTeatro;
    }

    public function insertar()
    {
        $base = new BaseDatos();
        $resp = false;
        $nombre = $this->getNombre();
        $direccion = $this->getDireccion();

        $consulta_insertar = "INSERT INTO teatro(nombre, direccion)
		VALUES ('{$nombre}', '{$direccion}')";

        //debbugin
        //echo "\n".$consulta_insertar."\n";
        if ($base->Iniciar()) {
            if ($id = $base->devuelveIDInsercion($consulta_insertar)) {
                $this->setIdTeatro($id);
                $resp = true;
            } else {
                $this->setMensajeOperacion($base->getError());
            }
        } else {
            $this->setMensajeOperacion($base->getError());
        }
        return $resp;
    }

    public function modificar($id_teatro)
    {
        $resp = false;
        $base = new BaseDatos();
        $consultaModifica = "UPDATE teatro SET nombre = '" . $this->getNombre() . "', direccion = '" . $this->getDireccion() . "' WHERE id_teatro = " . $id_teatro;
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
        $base = new BaseDatos();
        $resp = false;
        if ($base->Iniciar()) {
            $consultaBorra = "DELETE FROM teatro WHERE id_teatro = " . $this->getIdTeatro();
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
    */
    public function encontrarPosicionPasajero($dniParaRastrear)
    {
        $existePasajero = -1;
        $seEncontro = false;
        for ($i = 0; $i < $this->cantidadActualPasajeros() && $seEncontro != true; $i++) {
            if ($this->getPasajeros()[$i]->getNumeroDocumento() == $dniParaRastrear) {
                $existePasajero = $i;
                $seEncontro = true;
            }
        }
        return $existePasajero;
    }

    public function modificarPasajero($numeroDniPasajero, $newNombre, $newApellido, $newNuevoTelefono)
    {
        $pasajero = 'no hay pasajero con ese dni';

        if ($this->encontrarPosicionPasajero($numeroDniPasajero) != -1) {
            $this->getPasajeros()[$this->encontrarPosicionPasajero($numeroDniPasajero)]->setNombre($newNombre);
            $this->getPasajeros()[$this->encontrarPosicionPasajero($numeroDniPasajero)]->setApellido($newApellido);
            $this->getPasajeros()[$this->encontrarPosicionPasajero($numeroDniPasajero)]->setNumeroTelefono($newNuevoTelefono);

            $pasajero = $this->getPasajeros()[$this->encontrarPosicionPasajero($numeroDniPasajero)];
        }
        return $pasajero;
    }

    public function cambiarResponsable($numeroLicencia, $numEmpleado, $nombre, $apellido)
    {
        $responsable = 'no hay responsable con ese numero de licencia';
        if ($this->getResponsableV()->getNumeroLicencia() == $numeroLicencia) {
            $this->getResponsableV()->setNombre($nombre);
            $this->getResponsableV()->setApellido($apellido);
            $this->getResponsableV()->setNumeroEmpleado($numEmpleado);
            $responsable = $this->getResponsableV();
        }
        return $responsable;
    }

    public function mostrarPasajeros()
    {
        $texto = "";
        $i=1;
        foreach ($this->getPasajeros() as $pasajeroIndividual) {
            $texto .= "pasajero ". $i .": ". $pasajeroIndividual . "\n";
            $i++;
        }

        return $texto;
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