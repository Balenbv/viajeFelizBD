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

    do {
        echo 'Ingrese los datos';
        $opcion = trim(fgets(STDIN));
        switch($opcion){
            case 1:
                $datosEmpresa = ['idEmpresa' => '2','enombre' => 'empresa1','edireccion' => 'Lagos del Rios', 'coleccionViajes' => []];
                $datosPasajero = [
                    ['nombre' => 'Jorge', 'apellido' => 'Messi', 'documento' => '11', 'ptelefono' => '1556', 'idViaje' => '2'],
                    ['nombre' => 'Luis', 'apellido' => 'Suarez', 'documento' => '12', 'ptelefono' => '1557', 'idViaje' => '2'],
                    ['nombre' => 'Neymar', 'apellido' => 'Jr', 'documento' => '13', 'ptelefono' => '1558', 'idViaje' => '2'],
                    ['nombre' => 'Kylian', 'apellido' => 'Mbappe', 'documento' => '14', 'ptelefono' => '1559', 'idViaje' => '2'],
                    ['nombre' => 'Lionel', 'apellido' => 'Messi', 'documento' => '15', 'ptelefono' => '1560', 'idViaje' => '2'],
                    ['nombre' => 'Cristiano', 'apellido' => 'Ronaldo', 'documento' => '16', 'ptelefono' => '1561', 'idViaje' => '2'],
                    ['nombre' => 'Robert', 'apellido' => 'Lewandowski', 'documento' => '17', 'ptelefono' => '1562', 'idViaje' => '2'],
                    ['nombre' => 'Kevin', 'apellido' => 'De Bruyne', 'documento' => '18', 'ptelefono' => '1563', 'idViaje' => '2'],
                    ['nombre' => 'Golo', 'apellido' => 'Kante', 'documento' => '19', 'ptelefono' => '1564', 'idViaje' => '2'],
                    ['nombre' => 'Mohamed', 'apellido' => 'Salah', 'documento' => '20', 'ptelefono' => '1565', 'idViaje' => '2']];
                
                    $datosResonsable = ['documento' => '93284673','rnumeroEmpleado' => '7','rnumeroLicencia' => '1','nombre' => 'Homero','apellido' => 'Simpson','ptelefono' => '77'];
                    
                    $datosViaje = ['idViaje' => '2','destino' => 'Cordoba','cantidadMaximaPasajeros' => '100','idEmpresa' => '2','numeroEmpleado' => '7','coleccionPasajeros' => $datosPasajero];
            
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
                break;
            case 2:
                echo 'ingrese la empresa de la que quiere saber sus viajes';
                $idEmpresa = trim(fgets(STDIN));
                print_r($objViaje->Buscar($idEmpresa));
                echo 'ingrese el id del viaje que quiere ver';
                $idViaje = trim(fgets(STDIN));
                print_r($objPasajero->listar("idViaje = $idViaje"));
                break;
            case 3:
            }

        } while ($opcion != 0);
}



