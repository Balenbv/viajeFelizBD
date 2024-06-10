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
$datos = ['documento'=>'777',
          'rnumeroEmpleado' => 37,
          'rnumeroLicencia' =>1,
          'nombre' => 'pedro',
          'apellido' => 'roman',
          'ptelefono' => 22222];

if ($bd->iniciar()){
    $objResponsable->cargar($datos);
    // $objResponsable->insertar();
    print_r($objResponsable->listar());
    $objResponsable->modificar();
    print_r($objResponsable->listar());
} else {
    echo "Conexion fallida";
}