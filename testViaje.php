<?php
include_once "empresa.php";
include_once "persona.php";
include_once 'ResponsableV.php';
include_once 'Viaje.php';
include_once 'Pasajero.php';
include_once 'bdViajeFeliz.php';

$objEmpresa = new Empresa();
$objPersona = new Persona();
$objResponsable = new ResponsableV();
$objViaje = new Viaje();
$objPasajero = new Pasajero();



function viajePreCargado($opcion){
$bd = new bdViajeFeliz();
$objPersona = new Persona();

//CREACION RESPONSABLE

$objResponsable = new ResponsableV();
$datosResponsable = ['documento'=>'93284672',
                     'rnumeroEmpleado' => 3,
                     'rnumeroLicencia' =>1,
                     'nombre' => 'homero',
                     'apellido' => 'simpson',
                     'ptelefono' =>77];

    if ($opcion == 1) {

        for ($i = 1; $i <= 10; $i++) {
            $objPersona->cargar(['nombre'=>'leonel',
            'apellido' => 'messi',
            'documento'=> "$i",
            'ptelefono'=> "1222",
            'idViaje'=> 1]);
            $objPasajero->cargar($datosPasajero);
            $objPersona->eliminar();
        }
        $objViaje->eliminar();
        $objEmpresa->eliminar();
        $objResponsable->eliminar();
    }

if($bd->iniciar()){
    $objResponsable->cargar($datosResponsable);
    $objResponsable->insertar();
    $objResponsable->listar();
} else {
    echo "Conexion fallida";
}
$objEmpresa = new Empresa();
$datosEmpresa = [
    'idEmpresa'=>'1',
    'enombre'=>'empresa1',
    'edireccion'=>'Lagos del Rios'
];

$datosViaje = ['idViaje'=> '1', 'destino'=>'Cordoba','cantidadMaximaPasajeros'=> '100', 'idEmpresa'=> '1','numeroEmpleado'=> '3','coleccionPasajeros'=>[]];
$datosPasajero = ['nombre'=>'jorge','apellido' => 'mes65si','documento'=> '5','ptelefono'=> '1556', 'idViaje'=> '5'];

if($bd->iniciar()){
    $objEmpresa->cargar($datosEmpresa);
    $objEmpresa->insertar();
    $objEmpresa->listar();
} else {
    echo "Conexion fallida";
}


//CREACION VIAJE
$objViaje = new Viaje();

if($bd->iniciar()){
    $objViaje->cargar($datosViaje);
    $objViaje->insertar(); 
    $objViaje->listar();
} else {
    echo "Conexion fallida";
} 

//CREACION PASAJERO

$objPasajero = new Pasajero();
$datosPasajeroD = ['nombre'=>'leonel',
                  'apellido' => 'messi',
                  'documento'=> '5',
                  'ptelefono'=> 1222,
                  'idViaje'=> 1];

if ($bd->iniciar()){
    for ($i = 1; $i < 10; $i++) {
        $datosPasajero = [
            'nombre' => 'nombre' . $i,
            'apellido' => 'apellido' . $i,
            'documento' =>  "$i",
            'ptelefono' => $i,
            'idViaje' => 1
        ];
        $objPasajero->cargar($datosPasajero);
        $objPasajero->insertar();
    }
    $objPasajero->listar();
    $objPasajero->cargar($datosPasajeroD);
    $objPasajero->listar();
} else {
    echo "Conexion fallida";
}

}
/*BORRADO DE DATOS*/


    /*BORRADO DE DATOS*/

    do {
            echo "\nIngrese una opcion:\n
            1) modificar datos de un viaje precargado\n
            2) crear desde 0 un viaje\n
            3) ver los datos actuales del viaje\n
            4) salir\n\n ";
            $opcion = trim(fgets(STDIN));
            switch ($opcion) {
                case 1:
                    do {
                        viajePreCargado(0);
                        echo "\n**************************************";
                        echo "\n1) Modificar un pasajero en especifico\n";
                        echo "2) agregar un pasajero nuevo\n";
                        echo "3) modificar el responsable del viaje\n";
                        echo "4) volver al menu principal\n";
                        echo "**************************************\n";
                        $opcionModificarCrear = trim(fgets(STDIN));
                        switch ($opcionModificarCrear) {
                            case 1:
                                
                                if ($elViajePersonalizadoEstaCreado == true) {
                                    echo "ingrese los siguientes datos:\n";
                                    echo "\nSu numero de dni para identificar al pajasero: ";
                                    $dni = trim(fgets(STDIN));
                                    if ($ObjViajeCrear->encontrarPosicionPasajero($dni) != -1) {
                                        echo "\nSu nuevo nombre: ";
                                        $nombre = trim(fgets(STDIN));
                                        echo "\nSu nuevo apellido: ";
                                        $apellido = trim(fgets(STDIN));
                                        echo "\nSu nuevo numero de telefono: ";
                                        $numTelefono = trim(fgets(STDIN));
                                        echo "\n\nse encontro el pasajero con el dni ingresado, sus nuevos datos son :" . $ObjViajeCrear->modificarPasajero($dni, $nombre, $apellido, $numTelefono);
                                    } else {
                                        echo "/////////////////////////////////////////////////////////////////\nno existe un pasajero con ese DNI, por favor intentalo de nuevo.\n/////////////////////////////////////////////////////////////////\n";
                                    }
                                } else {
                                    echo "ingrese los siguientes datos:\n";
                                    echo "\nSu numero de dni para identificar al pajasero: ";
                                    $dni = trim(fgets(STDIN));
                                    if ($ObjViajePredefinido->encontrarPosicionPasajero($dni) != -1) {
                                        echo "\nSu nuevo nombre: ";
                                        $nombre = trim(fgets(STDIN));
                                        echo "\nSu nuevo apellido: ";
                                        $apellido = trim(fgets(STDIN));
                                        echo "\nSu nuevo numero de telefono: ";
                                        $numTelefono = trim(fgets(STDIN));
                                        echo "\n\nse encontro el pasajero con el dni ingresado, sus nuevos datos son :" . $ObjViajePredefinido->modificarPasajero($dni, $nombre, $apellido, $numTelefono);
                                    } else {
                                        echo "/////////////////////////////////////////////////////////////////\nno existe un pasajero con ese DNI, por favor intentalo de nuevo.\n/////////////////////////////////////////////////////////////////\n";
                                    }
                                }
                                break;

                            case 2:
                                if ($elViajePersonalizadoEstaCreado == true) {
                                    echo "ingrese los datos del pasajero que agregar al vuelo";
                                    echo "\nNombre: ";
                                    $nombre = trim(fgets(STDIN));
                                    echo "\nApellido: ";
                                    $apellido = trim(fgets(STDIN));
                                    echo "\nnumero de telefono: ";
                                    $numTelefono = trim(fgets(STDIN));
                                    echo "\nnumero de dni: ";
                                    $dni = trim(fgets(STDIN));
                                    if ($ObjViajeCrear->cantidadActualPasajeros() + 1 < $ObjViajeCrear->getCantidadMaximaPasajeros()) {
                                        if ($ObjViajeCrear->encontrarPosicionPasajero($dni) == -1) {
                                            $newObjPasajero = new Pasajero($nombre, $apellido, $dni, $numTelefono);
                                            array_push($coleccionPasajeros, $newObjPasajero);
                                            $ObjViajePredefinido = new Viaje($objResponsableCreado, '787', 'chubut', 150, $coleccionPasajeros);
                                            
                                            echo "\nse agrego al pasajero exitosamente";
                                        } else {
                                            echo "\n/////////////////////////////////////\nya existe un pasajero con ese DNI\n/////////////////////////////////////";
                                        }
                                    } else {
                                        echo "\n/////////////////////////////////////\nno hay espacio disponible para agregar al pasajero\n/////////////////////////////////////";
                                    }
                                } else {
                                    echo "ingrese los datos del pasajero que agrega al vuelo";
                                    echo "\nNombre: ";
                                    $nombre = trim(fgets(STDIN));
                                    echo "\nApellido: ";
                                    $apellido = trim(fgets(STDIN));
                                    echo "\nnumero de telefono: ";
                                    $numTelefono = trim(fgets(STDIN));
                                    echo "\nnumero de dni: ";
                                    $dni = trim(fgets(STDIN));
                                    if ($ObjViajePredefinido->cantidadActualPasajeros() + 1 < $ObjViajePredefinido->getCantidadMaximaPasajeros()) {
                                        if ($ObjViajePredefinido->encontrarPosicionPasajero($dni) == -1) {
                                            $newObjPasajero = new Pasajero($nombre, $apellido, $dni, $numTelefono);
                                            array_push($coleccionPasajeros, $newObjPasajero);
                                            $ObjViajePredefinido = new Viaje($objResponsableCreado, '787', 'chubut', 150, $coleccionPasajeros);
                                            echo "\nse agrego al pasajero exitosamente";
                                        } else {
                                            echo "\n/////////////////////////////////////\nya existe un pasajero con ese DNI\n/////////////////////////////////////";
                                        }
                                    } else {
                                        echo "\n/////////////////////////////////////\nno hay espacio disponible para agregar al pasajero\n/////////////////////////////////////";
                                    }
                                }
                                break;
                            case 3:
                                if ($elViajePersonalizadoEstaCreado == true) {
                                    echo "ingrese los nuevos datos del responsable";
                                    echo "\nIngrese su numero de licencia para identificarlo: ";
                                    $numeroLicencia = trim(fgets(STDIN));
                                    echo "Su nuevo nombre: ";
                                    $nombre = trim(fgets(STDIN));
                                    echo "Su nuevo apellido: ";
                                    $apellido = trim(fgets(STDIN));
                                    echo "Su nuevo numero de empleado: ";
                                    $numeroEmpleado = trim(fgets(STDIN));
                                    if ($ObjViajeCrear->cambiarResponsable($numeroLicencia, $numeroEmpleado, $nombre, $apellido) != 'no hay responsable con ese numero de licencia') {
                                        echo "//////////////////////////////////////////////\nLos nuevos datos del responsable cargaron correctamente :)\n//////////////////////////////////////////////";
                                    } else {
                                        echo "//////////////////////////////////////////////\n" . $ObjViajeCrear->cambiarResponsable($numeroLicencia, $numeroEmpleado, $nombre, $apellido) . "\n//////////////////////////////////////////////";
                                    }
                                } else {
                                    echo "ingrese los nuevos datos del responsable";
                                    echo "\nIngrese su numero de licencia para identificarlo: ";
                                    $numeroLicencia = trim(fgets(STDIN));
                                    echo "Su nuevo nombre: ";
                                    $nombre = trim(fgets(STDIN));
                                    echo "Su nuevo apellido: ";
                                    $apellido = trim(fgets(STDIN));
                                    echo "Su nuevo numero de empleado: ";
                                    $numeroEmpleado = trim(fgets(STDIN));
                                    if ($ObjViajePredefinido->cambiarResponsable($numeroLicencia, $numeroEmpleado, $nombre, $apellido) != 'no hay responsable con ese numero de licencia') {
                                        echo "//////////////////////////////////////////////\nLos nuevos datos del responsable cargaron correctamente :)\n//////////////////////////////////////////////";
                                    } else {
                                        echo "//////////////////////////////////////////////\n" . $ObjViajePredefinido->cambiarResponsable($numeroLicencia, $numeroEmpleado, $nombre, $apellido) . "\n//////////////////////////////////////////////";
                                    }
                                }

                                break;
                            default:
                                echo "\nopcion no valida\n\n";
                                break;
                        }
                    } while ($opcionModificarCrear != 4);

                    break;

                case 2:
                    viajePreCargado(1);
                    echo "se borraron los datos anteriores";
                    
                    echo "\nvamos a crear un viaje desde 0, ingrese el maximo de pasajeros para este vuelo:\n";
                    $coleccionPasajeros = [];
                    $cantidadMaximaPersonas = trim(fgets(STDIN));
                    echo "\nAhora cuantos pasajeros quiere crear:\n";
                    $cantidadPasajeros = trim(fgets(STDIN));

                    do {
                        echo "ingrese los datos del pasajero:";
                        echo "\nNombre: ";
                        $nombre = trim(fgets(STDIN));
                        echo "Apellido: ";
                        $apellido = trim(fgets(STDIN));
                        echo "numero de telefono: ";
                        $numTelefono = trim(fgets(STDIN));
                        echo "numero de dni: ";
                        $dni = trim(fgets(STDIN));

                        if (count($coleccionPasajeros) == 0) {
                            array_push($coleccionPasajeros, new Pasajero($nombre, $apellido, $dni, $numTelefono));
                            $objViajeCrear = new viaje(0, 0, 0, 0, $coleccionPasajeros);

                            echo "se agrego al pasajero exitosamente :)\n";
                        } else if ($objViajeCrear->encontrarPosicionPasajero($dni) == -1) {
                            array_push($coleccionPasajeros, new Pasajero($nombre, $apellido, $dni, $numTelefono));
                            $objViajeCrear = new viaje(0, 0, 0, 0, $coleccionPasajeros);
                            
                            /*CREACION DEL Pasajeros de 0*/
                            /*
                            $bd = new bdViajeFeliz();
                            if($bd->iniciar()){
                            $objPasajero->cargar(['nombre'=> $nombre ,
                                                  'apellido'=> $apellido ,
                                                  'documento'=> $dni ,
                                                  'ptelefono'=> $numTelefono ,
                                                  'idViaje'=> $idViaje]); //falta
                            $objPasajero->insertar();
                            }else{
                            echo "Conexion fallida";
                            }
                            */

                            echo "se agrego al pasajero exitosamente :)\n";
                        } else {
                            echo "\n/////////////////////////////////////\nya existe un pasajero con ese DNI\n/////////////////////////////////////\n";
                        }
                    } while (count($coleccionPasajeros) != $cantidadPasajeros);

                    echo "\nAhora vamos a definir el responsable del viaje:\n";
                    echo "\nIngrese su numero de licencia: ";
                    $numeroLicencia = trim(fgets(STDIN));
                    echo "Ingrese el nombre: ";
                    $nombre = trim(fgets(STDIN));
                    echo "Ingrese el apellido: ";
                    $apellido = trim(fgets(STDIN));
                    echo "Ingrese el numero documento: ";
                    $dni = trim(fgets(STDIN));
                    echo "ingrese el numero de telefono:";
                    $telefono = trim(fgets(STDIN));
                    echo "Ingrese el numero de empleado: ";
                    $numeroEmpleado = trim(fgets(STDIN));

                    $objResponsableCreado = new ResponsableV($numeroEmpleado, $numeroLicencia, $nombre, $apellido);
                    
                    /*Creacion del responsable de 0*/
                    /*

                    $bd = new bdViajeFeliz();
                    if($bd->iniciar()){
                        $objResponsableCreado->cargar(['nombre'=> $nombre ,
                                                       'apellido'=> $apellido ,
                                                       'documento'=> $dni ,
                                                       'ptelefono'=> $telefono ,
                                                       'rnumeroEmpleado=> $numeroEmpleado ,
                                                       'rnumeroLicencia'=> $numeroLicencia]);
                        
                                                       $objResponsableCreado->insertar();
                    }else{
                        echo "Conexion fallida";
                    }

                    */

                    echo "\nPor ultimo vamos a crear el viaje:\n";
                    echo "\nIngrese el codigo del vuelo: ";
                    $codigoViaje = trim(fgets(STDIN));
                    echo "\nIngrese el destino del viaje: ";
                    $destino = trim(fgets(STDIN));
                    $objViajeCrear = new Viaje($objResponsableCreado, $codigoViaje, $destino, $cantidadMaximaPersonas, $coleccionPasajeros);
                    
                    /*CREACION DEL VIAJE DE 0*/
                    /*
                    $bd = new bdViajeFeliz();
                    if($bd->iniciar()){
                        $cargarViajeNuevo->cargar(['idViaje'=>$codigoViaje,
                                                   'destino'=>$destino,
                                                   'cantidadMaximaPasajeros'=>$cantidadMaximaPersonas,
                                                   'idEmpresa'=>$idEmpresa,
                                                   'coleccionPasajeros'=>$coleccionPasajeros]);
                    $objViajeCrear->insertar();
                    }else{
                        echo "Conexion fallida";
                    }

                    */

                    echo "\n//////////////////////////////////////\nSu viaje fue creado exitosamente :)\n//////////////////////////////////////";
                    $elViajePersonalizadoEstaCreado = true;
                    break;
    
                    /*FIN CASE 2*/
                    
                case 3:
                    if ($objViajeCrear->cantidadActualPasajeros() != 0) {
                        echo $objViajeCrear;
                    } else {
                        echo $ObjViajePredefinido;
                    }
                    break;
            }
    } while ($opcion != 4);


