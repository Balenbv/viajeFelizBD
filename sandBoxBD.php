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

    


    
    // $consultaInsertar = "INSERT INTO empresa(enombre, edireccion) VALUES ('jauncho','av libertad 123')";
    // echo $bd->devuelveIDInsercion($consultaInsertar);

    $datosEmpresa = ['idEmpresa'=> null,'enombre' => 'fiat', 'edireccion' => 'av sanjuan', 'coleccionViajes' => []];
    $objEmpresa->cargar($datosEmpresa);
    echo "\033[42mse cargo la empresa✅\033[0m\n";
    $objEmpresa->insertar();
    echo "\033[42mse inserto la empresa✅\033[0m\n";


    $datosResponsable = ['documento' => '123456', 'rnumeroEmpleado' => null, 'rnumeroLicencia' => '159', 'nombre' => 'valentin', 'apellido' => 'bustos', 'ptelefono' => '123456789'];
    $objResponsable->cargar($datosResponsable);
    echo "\033[42mse cargo el responsable✅\033[0m\n";
    $objResponsable->insertar();
    echo "\033[42mse inserto el responsable✅\033[0m\n";

    //echo $objEmpresa;

    $datosViaje = ['idViaje' => null, 'destino' => 'londres', 'cantidadMaximaPasajeros' => 10, 'objEmpresa' => $objEmpresa, 'objEmpleado' => $objResponsable, 'coleccionPasajeros' => []];
    
    $objViaje->cargar($datosViaje);
    echo "se cargo el viaje\n";
    $objViaje->insertar();
    echo "se inserto el viaje\n";
    echo $objViaje->getIdViaje();

    $coleccionPasajeros = [
        // ['nombre' => 'Jorge', 'apellido' => 'Messi', 'documento' => '1', 'ptelefono' => '1556', 'idViaje' => $objViaje->getIdViaje()],
        // ['nombre' => 'Luis', 'apellido' => 'Suarez', 'documento' => '2', 'ptelefono' => '1557', 'idViaje' => $objViaje->getIdViaje()],
        // ['nombre' => 'Neymar', 'apellido' => 'Jr', 'documento' => '3', 'ptelefono' => '1558', 'idViaje' => $objViaje->getIdViaje()],
        // ['nombre' => 'Kylian', 'apellido' => 'Mbappe', 'documento' => '4', 'ptelefono' => '1559', 'idViaje' => $objViaje->getIdViaje()],
        // ['nombre' => 'Lionel', 'apellido' => 'Messi', 'documento' => '5', 'ptelefono' => '1560', 'idViaje' => $objViaje->getIdViaje()],
        // ['nombre' => 'Cristiano', 'apellido' => 'Ronaldo', 'documento' => '6', 'ptelefono' => '1561', 'idViaje' => $objViaje->getIdViaje()],
        // ['nombre' => 'Robert', 'apellido' => 'Lewandowski', 'documento' => '7', 'ptelefono' => '1562', 'idViaje' => $objViaje->getIdViaje()],
        // ['nombre' => 'Kevin', 'apellido' => 'De Bruyne', 'documento' => '8', 'ptelefono' => '1563', 'idViaje' => $objViaje->getIdViaje()],
        // ['nombre' => 'Golo', 'apellido' => 'Kante', 'documento' => '9', 'ptelefono' => '1564', 'idViaje' =>$objViaje->getIdViaje()],
        // ['nombre' => 'Mohamed', 'apellido' => 'Salah', 'documento' => '10', 'ptelefono' => '1565', 'idViaje' => $objViaje->getIdViaje()],
        ['nombre' => 'Sadio', 'apellido' => 'Mane', 'documento' => '11', 'ptelefono' => '1566', 'idViaje' => $objViaje->getIdViaje()],
        ['nombre' => 'Virgil', 'apellido' => 'Van Dijk', 'documento' => '12', 'ptelefono' => '1567', 'idViaje' => $objViaje->getIdViaje()],
        ['nombre' => 'Alisson', 'apellido' => 'Becker', 'documento' => '13', 'ptelefono' => '1568', 'idViaje' => $objViaje->getIdViaje()],
        ['nombre' => 'Thiago', 'apellido' => 'Alcantara', 'documento' => '14', 'ptelefono' => '1569', 'idViaje' => $objViaje->getIdViaje()],
        ['nombre' => 'Frenkie', 'apellido' => 'De Jong', 'documento' => '15', 'ptelefono' => '1570', 'idViaje' => $objViaje->getIdViaje()],
        ['nombre' => 'Luka', 'apellido' => 'Modric', 'documento' => '16', 'ptelefono' => '1571', 'idViaje' => $objViaje->getIdViaje()],
        ['nombre' => 'Karim', 'apellido' => 'Benzema', 'documento' => '17', 'ptelefono' => '1572', 'idViaje' => $objViaje->getIdViaje()],
        ['nombre' => 'Eden', 'apellido' => 'Hazard', 'documento' => '18', 'ptelefono' => '1573', 'idViaje' => $objViaje->getIdViaje()],
        ['nombre' => 'Sergio', 'apellido' => 'Ramos', 'documento' => '19', 'ptelefono' => '1574', 'idViaje' => $objViaje->getIdViaje()],
        ['nombre' => 'Thibaut', 'apellido' => 'Courtois', 'documento' => '20', 'ptelefono' => '1575', 'idViaje' => $objViaje->getIdViaje()],
    ];
    foreach ($coleccionPasajeros as $pasajero) {
        $objPasajero->cargar($pasajero);
        $objPasajero->insertar();
    }


    





    if ($objEmpresa->listar()){
        echo "\033[42mSe cargo correctamente✅\033[0m\n";
        echo "los datos de la empresa y el viaje creado son:\n";
        echo $objEmpresa->listar()[0];
        echo "\033[42mSe cargo correctamente✅\033[0m\n";
        echo $objViaje->listar()[0];
                
       $pasajeros = $objPasajero->listar("idviaje = " . $objViaje->getIdViaje());
        foreach ($pasajeros as $pasajero) {
            echo $pasajero;
        }
    } else {
        echo "\033[41mNo se cargo\033[0m\n";
    }
    























} else {
    echo $bd->getError();
}