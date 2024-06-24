<?php
include_once 'bdViajeFeliz.php';
include_once 'Viaje.php';
include_once 'persona.php';
include_once 'ResponsableV.php';
include_once 'Pasajero.php';
include_once 'Empresa.php';

/**Correcciones
 * 
Clase Responsable
    
alta --> Cuando hacen el alta para obtener el id deben usar el metodo devuelveIDInsercion.

 -  TestViaje ///

Si me piden que ingrese un valor para buscar informacion (Como un id). Muestren los id's que estan disponibles. Cuando me piden que ingrese el id de un viaje para buscar un viaje, el usuario no va a recordar todos los id's.
Cuando se cargan datos nuevos, el usuario no debe ingresar el id (O cualquier valor que se asigne con auto_increment), se lo asigna la bd. */

$bd = new bdViajeFeliz();
if ($bd->Iniciar()){
    $objPersona = new Persona();
    $objViaje = new Viaje();
    $objResponsable = new ResponsableV();
    $objPasajero = new Pasajero();
    $objEmpresa = new Empresa();
    $coleccionPasajeros = [];

    $datosEmpresa = ['enombre' => 'fiat', 'edireccion' => 'av sanjuan', 'coleccionViajes' => []];
    $objEmpresa->cargar($datosEmpresa);
    $objEmpresa->insertar();


    $datosResponsable = ['documento' => '123', 'rnumeroEmpleado' => null, 'rnumeroLicencia' => '159', 'nombre' => 'valentin', 'apellido' => 'bustos', 'ptelefono' => '123456789'];
    $objResponsable->cargar($datosResponsable);
    $objResponsable->insertar();



    $datosViaje = ['idViaje' => null, 'destino' => 'londres', 'cantidadMaximaPasajeros' => 10, 'objEmpresa' => $objEmpresa, 'objEmpleado' => $objResponsable, 'coleccionPasajeros' => $coleccionPasajeros];
    
    $objViaje->cargar($datosViaje);
    echo "se cargo el viaje\n";
    $objViaje->insertar();
    echo "se inserto el viaje\n";
    echo $objViaje->getIdViaje();



    foreach ($coleccionPasajeros as $pasajero) {
        $objPasajero->cargar($pasajero);
        $objPasajero->insertar();
    }



    if ($objEmpresa->listar()){
        echo "\033[42mSe cargo correctamente✅\033[0m\n";
        echo "los datos de la empresa y el viaje creado son:\n";
        echo $objEmpresa->listar()[0];
        echo $objViaje->listar()[0];
                

    } else {
        echo "\033[41mNo se cargo\033[0m\n";
    }
    






















} else {
    echo $bd->getError();
}