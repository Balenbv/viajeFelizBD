<?php
include_once 'persona.php';
include_once 'ResponsableV.php';
include_once 'Pasajero.php';
include_once 'Empresa.php';
include_once 'Viaje.php'; // Asumiendo que existe una clase Viaje
include_once 'bdViajeFeliz.php'; // Asumiendo que existe una clase para manejar la base de datos

$bd = new bdViajeFeliz();

$datosEmpresa = [
    'idEmpresa' => '1',
    'enombre' => 'empresa1',
    'edireccion' => 'Lagos del Rios'
];
$datosPasajero = [
    ['nombre' => 'Jorge', 'apellido' => 'Messi', 'documento' => '1', 'ptelefono' => '1556', 'idViaje' => '1'],
    ['nombre' => 'Luis', 'apellido' => 'Suarez', 'documento' => '2', 'ptelefono' => '1557', 'idViaje' => '1'],
    ['nombre' => 'Neymar', 'apellido' => 'Jr', 'documento' => '3', 'ptelefono' => '1558', 'idViaje' => '1'],
    ['nombre' => 'Kylian', 'apellido' => 'Mbappe', 'documento' => '4', 'ptelefono' => '1559', 'idViaje' => '1'],
    ['nombre' => 'Lionel', 'apellido' => 'Messi', 'documento' => '5', 'ptelefono' => '1560', 'idViaje' => '1'],
    ['nombre' => 'Cristiano', 'apellido' => 'Ronaldo', 'documento' => '6', 'ptelefono' => '1561', 'idViaje' => '1'],
    ['nombre' => 'Robert', 'apellido' => 'Lewandowski', 'documento' => '7', 'ptelefono' => '1562', 'idViaje' => '1'],
    ['nombre' => 'Kevin', 'apellido' => 'De Bruyne', 'documento' => '8', 'ptelefono' => '1563', 'idViaje' => '1'],
    ['nombre' => 'Golo', 'apellido' => 'Kante', 'documento' => '9', 'ptelefono' => '1564', 'idViaje' => '1'],
    ['nombre' => 'Mohamed', 'apellido' => 'Salah', 'documento' => '10', 'ptelefono' => '1565', 'idViaje' => '1']
];

$datosResonsable = [
    'documento' => '93284672',
    'rnumeroEmpleado' => 3,
    'rnumeroLicencia' => 1,
    'nombre' => 'Homero',
    'apellido' => 'Simpson',
    'ptelefono' => 77
];

$datosViaje = [
    'idViaje' => '1',
    'destino' => 'Cordoba',
    'cantidadMaximaPasajeros' => '100',
    'idEmpresa' => '1',
    'numeroEmpleado' => '3',
    'coleccionPasajeros' => $datosPasajero
];


function viajePredefinido($datosEmpresa, $datosPasajero, $datosResonsable, $datosViaje){
    $bd = new bdViajeFeliz();

    if ($bd->iniciar()) {
        $objEmpresa = new Empresa();
        $objEmpresa->cargar($datosEmpresa);
        $objEmpresa->insertar();

        $objPersona = new Persona();

        $objResponsable = new ResponsableV();
        $objResponsable->cargar($datosResonsable);
        $objResponsable->insertar();

        $objViaje = new Viaje();
        $objViaje->cargar($datosViaje);
        $objViaje->insertar();

        foreach ($datosPasajero as $pasajero) {
            $objPasajero = new Pasajero();
            $objPasajero->cargar($pasajero);
            $objPasajero->insertar();
        }
    } else {
            echo "Conexion fallida";
    }
}

function eliminarViajePredefinido($datosPasajero, $datosResonsable, $datosViaje, $datosEmpresa){
    $bd = new bdViajeFeliz();

    if ($bd->iniciar()) {
        $objEmpresa = new Empresa();
        $objEmpresa->cargar($datosEmpresa);
        $objViaje = new Viaje();
        $objViaje->cargar($datosViaje);
        $objResponsable = new ResponsableV();
        $objResponsable->cargar($datosResonsable);
        $objPasajero = new Pasajero();
        $objPersona = new Persona();
      
        
        for ($i = 1; $i <= count($datosPasajero); $i++) {
            $objPersona->cargar(['nombre'=>'leonel',
            'apellido' => 'messi',
            'documento'=> "$i",
            'ptelefono'=> "1222",
            'idViaje'=> "1"]);
            $objPersona->eliminar();
        }
        $objResponsable->eliminar();
        $objViaje->eliminar();
        $objEmpresa->eliminar();
   
    } else {
        echo "Conexion fallida";
    }
}
//viajePredefinido($datosEmpresa, $datosPasajero, $datosResonsable, $datosViaje);
eliminarViajePredefinido($datosPasajero, $datosResonsable, $datosViaje, $datosEmpresa);