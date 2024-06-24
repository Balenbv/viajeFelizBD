<?php
include_once 'bdViajeFeliz.php';
include_once 'Viaje.php';
include_once 'persona.php';
include_once 'ResponsableV.php';
include_once 'Pasajero.php';
include_once 'Empresa.php';


$bd = new bdViajeFeliz();
if ($bd->Iniciar()){
    $objPersona = new Persona();
    $objViaje = new Viaje();
    $objResponsable = new ResponsableV();
    $objPasajero = new Pasajero();
    $objEmpresa = new Empresa();

    $objViaje->Buscar(9);
    echo $objViaje->getobjEmpresa();
    echo false;
    
} else {
    echo $bd->getError();
}