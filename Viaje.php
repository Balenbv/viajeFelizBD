<?php

class Viaje
{
    private $idViaje;                                       //idviaje bigint AUTO_INCREMENT,
    private $destino;                                       //vdestino varchar(150),
    private $cantidadMaximaPasajeros;                       //vcantmaxpasajeros int,
    private $idEmpresa;                                     //idempresa bigint,
    private $objResponsableV;                               //rnumeroempleado bigint,                                      //vimporte float,
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
        $this->setColeccionPasajero($datos['coleccionPasajeros']);
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

    public function setColeccionPasajero($newColeccionPasajero){
        $this->ColeccionObjsPasajeros = $newColeccionPasajero;
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

    public function setmensajeoperacion($newMensajeOperacion)
    {
        $this->mensajeoperacion = $newMensajeOperacion;
    }

    public function cantidadPasajerosActual(){
        return count($this->ColeccionObjsPasajeros);
    }

    /*metodos de sql*/
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
        $consultaInsertar = "INSERT INTO viaje(idviaje,vdestino, vcantmaxpasajeros,idempresa,rnumeroempleado) VALUES 
        ('" . $this->getIdViaje() . "','" . $this->getDestino() . "','" . $this->getCantidadMaximaPasajeros() . "','" . $this->getIdEmpresa() . "','" . $this->getResponsableV(). "')";
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
        $consultaModifica = "UPDATE viaje SET vdestino='" . $this->getDestino() . "', vcantmaxpasajeros= " . $this->getCantidadMaximaPasajeros() . " WHERE idviaje = '" . $this->getIdViaje()."'";
        
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

    /*fin de los metodos de sql*/
    /*Pasajero*/   
    
    public function hayPasajesDisponibles(){
        //TESTEADO
        $base = new bdViajeFeliz();
        $consulta = "SELECT count(*) as cantidadPasajes FROM pasajero WHERE idviaje = '" . $this->getIdViaje()."'";
        $resp = false;

        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                if ($row2 = $base->Registro()) {
                    if ($row2['cantidadPasajes'] < $this->getCantidadMaximaPasajeros()) {

                        $resp = true;
                    }
                }
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
    }

    public function mostrarPasajeros(){
        //TESTEADO 
        $base = new bdViajeFeliz();
        $consulta = "SELECT * FROM pasajero WHERE idviaje = '" . $this->getIdViaje()."'";
        $resp = false;
        $coleccionPasajero = [];

        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                $pasajero = new Pasajero();
                $coleccionPasajero = $pasajero->listar();
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $coleccionPasajero;
    }

    public function existePersona($dni){
        //TESTEADO
        $base = new bdViajeFeliz();
        $consulta = "SELECT * FROM persona WHERE documento = " . $dni;
        $resp = false;

        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                if ($row2 = $base->Registro()) {
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
        
        

    public function crearPasajero($datos){
        //TESTEADO
        $base = new bdViajeFeliz();
        $booleano = true;
        $pasajero = new Pasajero();

        if($base->Iniciar()){
            $pasajero->cargar($datos);

            if ($pasajero->insertar()) {
                $coleccionPasajeros = $this->getColeccionObjsPasajeros();
                array_push($coleccionPasajeros, $pasajero);
                $this->setColeccionPasajero($coleccionPasajeros);
                $booleano = true;

            } else {

                $booleano = false;

            }
        }else{
            $this->setmensajeoperacion($base->getError());
        }
        return $booleano;
    }

    public function modificarPasajero($datos){
        //TESTEADO
        $base = new bdViajeFeliz();
        $bandera = false;

        if($base->iniciar()){

            $pasajero = new Pasajero();
            $pasajero->cargar($datos);

            if($pasajero->modificar()){
                $bandera = true;
            }else{
                $this->setmensajeoperacion($base->getError());
            }

        }else{
            $this->setmensajeoperacion($base->getError());
        }

        return $bandera;
    }

    public function eliminarPasajero($datos){
        //TESTEADO
        $base = new bdViajeFeliz();
        $resp = false;
        $pasajero = new Pasajero();

        if ($base->Iniciar()) {
            $pasajero->cargar($datos);
            $pasajero->eliminar();

        } else {
            $this->setmensajeoperacion($base->getError());
        }

        return $resp;
    }

    /*--- RESPONSABLE ---*/
    public function crearResponsableV($datos){
        //TESTEADO
        $base = new bdViajeFeliz();
        $booleano = true;
        $responsable = new ResponsableV();

        if($base->Iniciar()){
            $responsable->cargar($datos);
            if ($responsable->insertar()) {
                $this->setResponsableV($responsable);
                $booleano = true;
            } else {
                $booleano = false;
                $this->setmensajeoperacion($base->getError());
            }
        }else{
            $this->setmensajeoperacion($base->getError());
        }

        return $booleano;
    } 

    
    
    public function modificarResponsable($datos){
        //TESTEADO
        $base = new bdViajeFeliz();
        $bandera = false;

        if($base->iniciar()){
            $responsable = new ResponsableV();
            $responsable->cargar($datos);

            if($responsable->modificar()){
                $bandera = true;
            }else{
                $this->setmensajeoperacion($base->getError());
            }

        }else{
            $this->setmensajeoperacion($base->getError());
        }

        return $bandera;
    }

    public function mostrarResponsable(){
        //TESTEADO
        //
        $base = new bdViajeFeliz();
        $objResponsableV = null;
        
        if($base->iniciar()){
            $responsable = new ResponsableV();
            if($coleccionResponsables = $responsable->listar()){
                $i=0;
                while($objResponsableV == null && $i<count($coleccionResponsables)){
                    if($coleccionResponsables[$i]->getNumeroEmpleado() == $this->getResponsableV()){
                        $objResponsableV = $coleccionResponsables[$i];  
                    }
                    $i++;
                }
            }else{
                $this->setmensajeoperacion($base->getError());
            }
        }else{
            $this->setmensajeoperacion($base->getError());
        }
        
    return $objResponsableV;
    }
        
    public function eliminarResponsable($datos){
       // CASI TESTEADO
        $base = new bdViajeFeliz();
        $resp = false;
        $responsable = new responsableV();
    
        if ($base->Iniciar()) {
            $responsable->cargar($datos);
            $responsable->eliminar();
        } else {
            $this->setmensajeoperacion($base->getError());
        }
    
        return $resp;
    }

    public function __toString()
    {
        return "\n************\nNumero del encargado de este viaje: {$this->getResponsableV()} \nDatos del viaje: codigo del destino: {$this->getIdViaje()}\ndestino: {$this->getDestino()}\ncantidad Maxima de pasajeros: {$this->getCantidadMaximaPasajeros()}\n************\n";
    }
    
}