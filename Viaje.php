<?php

class Viaje
{
    private $idViaje;                                       //idviaje varchar AUTO_INCREMENT,
    private $destino;                                       //vdestino varchar(150),
    private $cantidadMaximaPasajeros;                       //vcantmaxpasajeros int,
    private $objEmpresa;                                     //objEmpresa varchar,
    private $objResponsableV;                               //rnumeroempleado varchar,                                      
    private $ColeccionObjsPasajeros;                        
    private $mensajeoperacion;                    

    public function __construct()
    {
        $this->objResponsableV ='' ;
        $this->idViaje = '';
        $this->destino = '';
        $this->cantidadMaximaPasajeros ='';
        $this->ColeccionObjsPasajeros = [];
    }

    public function cargar($datos)
    {
        $this->setIdViaje($datos['idViaje']);
        $this->setDestino($datos['destino']);
        $this->setCantidadMaximaPasajeros($datos['cantidadMaximaPasajeros']);
        $this->setobjEmpresa($datos['objEmpresa']);
        $this->setResponsableV($datos['objEmpleado']);
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

    public function getobjEmpresa()
    {
        return $this->objEmpresa;
    }  

    public function setColeccionPasajero($newColeccionPasajero){
        $this->ColeccionObjsPasajeros = $newColeccionPasajero;
    }
    
    public function setobjEmpresa($newobjEmpresa)
    {
        $this->objEmpresa = $newobjEmpresa;
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
                if ($row2 = $base->Registro()){
                    $objResponsableV = new ResponsableV();
                    $objEmpresa = new Empresa();
                    $objPasajero = new Pasajero();
                    
                    $objEmpresa->Buscar($row2['idempresa']);
                    $objResponsableV->Buscar($row2['rnumeroempleado']);
                    $objPasajero->Buscar("idviaje = " . $row2['idviaje']);

                    $this->setIdViaje($idViaje);
                    $this->setDestino($row2['vdestino']);
                    $this->setCantidadMaximaPasajeros($row2['vcantmaxpasajeros']);
                    $this->setobjEmpresa($objEmpresa);
                    $this->setResponsableV($objResponsableV); 
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
                $arreglo = [];
                
                $obj = new Viaje();
                $objResponsableV = new ResponsableV();
                $objEmpresa = new Empresa();
                $objPasajero = new Pasajero();

                while ($row2 = $base->Registro()) {
                    $objResponsableV->Buscar($row2['rnumeroempleado']);
                    $objEmpresa->Buscar($row2['idempresa']);

                    $datos = [
                        'idViaje' => $row2['idviaje'],
                        'destino' => $row2['vdestino'],
                        'cantidadMaximaPasajeros' => $row2['vcantmaxpasajeros'],
                        'objEmpresa' => $objEmpresa,
                        'objEmpleado' => $objResponsableV,
                        'coleccionPasajeros' =>  $objPasajero->Listar("idviaje = " . $row2['idviaje'])
                    ];

                    $obj->cargar($datos);
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
        $consultaInsertar = "INSERT INTO viaje(idviaje,vdestino, vcantmaxpasajeros,objEmpresa,rnumeroempleado) VALUES 
        ('"  . $this->getIdViaje() . "','" . $this->getDestino() . "','" . $this->getCantidadMaximaPasajeros() . "','" . $this->getobjEmpresa() . "','" . $this->getResponsableV(). "')";
        
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
        $consultaModifica = "UPDATE viaje SET vdestino ='{$this->getDestino()}', vcantmaxpasajeros = {$this->getCantidadMaximaPasajeros()}, objEmpresa = {$this->getobjEmpresa()} WHERE idviaje = {$this->getIdViaje()}";
        //UPDATE viaje SET vdestino = 'londres', vcantmaxpasajeros = 80, objEmpresa = 1 where idviaje = 1
        
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

    public function eliminarViajes()
    {
        $base = new bdViajeFeliz();
        $resp = false;

        if ($base->Iniciar()) {
            $consultaBorra = "DELETE FROM viaje where 1";
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

    public function existePersona($dni){
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

    public function devuelveIDInsercion($consulta){
        $resp = null;
        unset($this->ERROR);
        $this->QUERY = $consulta;
        if ($this->RESULT = mysqli_query($this->CONEXION,$consulta)){
            $id = mysqli_insert_id();
            $resp =  $id;
        } else {
            $this->ERROR =mysqli_errno( $this->CONEXION) . ": " . mysqli_error( $this->CONEXION);
           
        }
    return $resp;
    }

    public function eliminarPasajero($datos){
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
        return "\n************\nNumero del encargado de este viaje: {$this->getResponsableV()}\nDatos del viaje:\ncodigo del viaje: {$this->getIdViaje()}\ndestino: {$this->getDestino()}\ncantidad Maxima de pasajeros: {$this->getCantidadMaximaPasajeros()}\n************\n";
    }
    
}