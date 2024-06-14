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
    ['nombre' => 'Jorge', 'apellido' => 'Messi', 'documento' => '5', 'ptelefono' => '1556', 'idViaje' => '1'],
    ['nombre' => 'Luis', 'apellido' => 'Suarez', 'documento' => '10', 'ptelefono' => '1557', 'idViaje' => '1'],
    ['nombre' => 'Neymar', 'apellido' => 'Jr', 'documento' => '15', 'ptelefono' => '1558', 'idViaje' => '1'],
    ['nombre' => 'Kylian', 'apellido' => 'Mbappe', 'documento' => '20', 'ptelefono' => '1559', 'idViaje' => '1'],
    ['nombre' => 'Lionel', 'apellido' => 'Messi', 'documento' => '25', 'ptelefono' => '1560', 'idViaje' => '1'],
    ['nombre' => 'Cristiano', 'apellido' => 'Ronaldo', 'documento' => '30', 'ptelefono' => '1561', 'idViaje' => '1'],
    ['nombre' => 'Robert', 'apellido' => 'Lewandowski', 'documento' => '35', 'ptelefono' => '1562', 'idViaje' => '1'],
    ['nombre' => 'Kevin', 'apellido' => 'De Bruyne', 'documento' => '40', 'ptelefono' => '1563', 'idViaje' => '1'],
    ['nombre' => 'Golo', 'apellido' => 'Kante', 'documento' => '45', 'ptelefono' => '1564', 'idViaje' => '1'],
    ['nombre' => 'Mohamed', 'apellido' => 'Salah', 'documento' => '50', 'ptelefono' => '1565', 'idViaje' => '1']
];

$datosViaje = [
    'idViaje' => '1',
    'destino' => 'Cordoba',
    'cantidadMaximaPasajeros' => '100',
    'idEmpresa' => '1',
    'numeroEmpleado' => '3',
    'coleccionPasajeros' => $datosPasajero
];



$datosResonsable = [
    'documento' => '93284672',
    'rnumeroEmpleado' => 3,
    'rnumeroLicencia' => 1,
    'nombre' => 'Homero',
    'apellido' => 'Simpson',
    'ptelefono' => 77
];
if ($bd->iniciar()) {
    $objEmpresa = new Empresa();
    $objEmpresa->cargar($datosEmpresa);
    $objEmpresa->insertar();

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

    $objViaje->listar(); // Asumiendo que existe un método para listar la información del viaje
    echo "Desea eliminar los datos? 1-Si 2-No";
$opcion = trim(fgets(STDIN));
if ($opcion == 1) {
    
    for ($i = 1; $i <= 10; $i++) {
        $objPersona->cargar(['nombre'=>'leonel',
        'apellido' => 'messi',
        'documento'=> "$i",
        'ptelefono'=> "1222",
        'idViaje'=> "1"]);
        $objPersona->eliminar();
    }
    $objEmpresa->eliminar();
    $objResponsable->eliminar();
}else{
    echo "Bueno♥";
}
} else {
    echo "Conexion fallida";
}
