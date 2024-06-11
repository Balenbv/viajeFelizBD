<?php

include_once 'bdViajeFeliz.php';
include_once 'Viaje.php';
include_once 'persona.php';
include_once 'ResponsableV.php';
//include_once 'Pasajero.php';
include_once 'Empresa.php';


/** Persona(nrodoc, apellido, nombre, telefono)  */
/*VIAJE(idviaje,vdestino,vcantmaxpasajeros,idempresa,rnumeroempleado,vimporte,)*/
$bd = new bdViajeFeliz();
$objResponsable = new ResponsableV();
$objPersona = new Persona();
$datos = ['documento'=>'93284672','rnumeroEmpleado' => 3,'rnumeroLicencia' =>1,'nombre' => 'peruanin','apellido' => 'roman','ptelefono' =>77];
$objViaje = new Viaje();
$datosViaje = ['idViaje' => 1,'destino' => 'Cordoba','cantidadMaximaPasajeros' => 10,'idEmpresa' => 1,'numeroEmpleado' => 3 ,'importe' => 1.34, 'ColeccionObjsPasajeros' => null,'mensajeoperacion' => null];

if ($bd->iniciar()){
    $objViaje->cargar($datosViaje);
    // $objViaje->insertar();
    print_r($objViaje->listar());
} else {
    echo "Conexion fallida";
}