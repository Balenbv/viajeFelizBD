<?php

class ResponsableV extends Persona
{
    private $numeroEmpleado;         //rnumeroempleado bigint AUTO_INCREMENT,
    private $numeroLiciencia;        //rnumerolicencia bigint,

    public function __construct()
    {
        parent::__construct();          //nombre varchar(150), apellido varchar(150), documento bigint, ptelefono bigint
        $this->numeroEmpleado = '';
        $this->numeroLiciencia = '';
    }

    public function cargar($datos)
    {
        parent::cargar($datos);
        $this->setNumeroEmpleado($datos['rnumeroEmpleado']);  //en la base de datos esta como rnumeroempleado
        $this->setNumeroLicencia($datos['rnumeroLicencia']);  //en la base de datos esta como rnumerolicencia
    }

    public function getNumeroEmpleado()
    {
        return $this->numeroEmpleado;
    }

    public function getNumeroLicencia()
    {
        return $this->numeroLiciencia;
    }

    public function getmensajeoperacion(){
        return $this->mensajeoperacion;
    }

    public function setmensajeoperacion($mensajeoperacion)
    {
        $this->mensajeoperacion = $mensajeoperacion;
    }

    public function setNumeroEmpleado($newNumeroEmpleado)
    {
        $this->numeroEmpleado = $newNumeroEmpleado;
    }

    public function setNumeroLicencia($newNumeroLicencia)
    {
        $this->numeroLiciencia = $newNumeroLicencia;
    }

    public function Buscar($documento)
	{
		$base = new bdViajeFeliz();
		$consultaPersona = "SELECT * from responsable where rdocumento=" . $documento;
		$resp = false;
		if ($base->Iniciar()) {
			if ($base->Ejecutar($consultaPersona)) {
				if ($row2 = $base->Registro()) {
					parent::Buscar($documento);
                    $this->setNumeroEmpleado($row2['rnumeroempleado']);
                    $this->setNumeroLicencia($row2['rnumerolicencia']);
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

    public function listar($condicion=""){
        $arreglo = null;
        $base = new bdViajeFeliz();
        $consulta = "SELECT * FROM responsable ";
        if ($condicion!=""){
            $consulta=$consulta.' WHERE '.$condicion;
        }
        $consulta.=" order by rdocumento ";
        if($base->iniciar()){
            if($base->ejecutar($consulta)){
                $arreglo= array();
                while($row2=$base->Registro()){
                    $responsable = new ResponsableV();
                    $responsable->Buscar($row2['rdocumento']);
                    array_push($arreglo,$responsable);
                }
            }	else {
                $this->setmensajeoperacion($base->getError());
            }
        }	else {
            $this->setmensajeoperacion($base->getError());
        }
        return $arreglo;
    }

    public function insertar(){
        $base=new bdViajeFeliz();
        $resp= false;
        if(parent::insertar()){
            $consultaInsertar = "INSERT INTO responsable(rdocumento, rnumeroempleado, rnumerolicencia) 
            VALUES (".parent::getDocumento().",".$this->getNumeroEmpleado().",".$this->getNumeroLicencia().")";
            if($base->Iniciar()){
                if($base->Ejecutar($consultaInsertar)){
                    $resp=  true;
                } else {
                    $this->setmensajeoperacion($base->getError());
                }
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        }
        return $resp;
    }

    public function modificar(){
        $resp = false;
        $base = new bdViajeFeliz();
        if (parent::modificar()){
            $consultaModifica = "UPDATE Responsable SET rnumerolicencia=".$this->getNumeroLicencia()." WHERE rdocumento= ".parent::getDocumento();
            if ($base->Iniciar()){
                if ($base->Ejecutar($consultaModifica)){
                    $resp =  true;
                } else {
                    $this->setmensajeoperacion($base->getError());
                }
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        }
        return $resp;
    }

    public function eliminar(){
        $base = new bdViajeFeliz();
        $resp = false;
        if ($base->Iniciar()){
            $consultaBorra = "DELETE FROM Responsable WHERE rdocumento='". parent::getDocumento()."'";
            if ($base->Ejecutar($consultaBorra)){
                if (parent::eliminar()){
                    $resp =  true;
                }
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
    }
}