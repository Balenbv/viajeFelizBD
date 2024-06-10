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
$datos = ['documento'=>'93284672',
          'numeroEmpleado' => 78,
          'numeroLicencia' =>1,
          'nombre' => 'jorge',
          'apellido' => 'morale',
          'ptelefono' => 92837465];

if ($bd->iniciar()){
    $objResponsable->cargar($datos);
    if($objResponsable->insertar()){
        echo $objResponsable->listar();
        echo $objResponsable;
        echo "*****************************************************************************entro";
    }else{
        echo "*****************************************************************************no entro";
    }

} else {
    echo "Conexion fallida";
}