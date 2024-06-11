<?php

include_once 'bdViajeFeliz.php';
//include_once 'Viaje.php';
include_once 'persona.php';
include_once 'ResponsableV.php';
//include_once 'Pasajero.php';
include_once 'Empresa.php';


/** Persona(nrodoc, apellido, nombre, telefono)  */
$bd = new bdViajeFeliz();
$objEmpresa = new Empresa();
$objResponsable = new ResponsableV();
$objPersona = new Persona();
$datos = ['documento'=>'93284672',
          'rnumeroEmpleado' => 3,
          'rnumeroLicencia' =>1,
          'nombre' => 'peruanin',
          'apellido' => 'roman',
          'ptelefono' =>77];


if ($bd->iniciar()){
    $objResponsable->listar();
    $objResponsable->cargar($datos);
    $objResponsable->eliminar();
    $objResponsable->listar();
} else {
    echo "Conexion fallida";
}