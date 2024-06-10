<?php

include_once 'bdViajeFeliz.php';
//include_once 'Viaje.php';
//include_once 'persona.php';
//include_once 'ResponsableV.php';
//include_once 'Pasajero.php';
include_once 'Empresa.php';


/** Persona(nrodoc, apellido, nombre, telefono)  */
$bd = new bdViajeFeliz();
$objEmpresa = new Empresa();

$datosEmpresa = (['idEmpresa' => 2, 'enombre' => '45674', 'edireccion' => 'Call423 5']);

if ($bd->iniciar()){
   $objEmpresa->cargar($datosEmpresa);
   $objEmpresa->insertar();
   print_r($objEmpresa->listar());

} else {
    echo "Conexion fallida";
}