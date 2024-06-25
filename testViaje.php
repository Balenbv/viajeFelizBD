<?php


include 'bdViajeFeliz.php'; 
include 'Empresa.php';
include 'Viaje.php'; 
include 'Persona.php';
include 'ResponsableV.php';
include 'Pasajero.php';

$bd = new bdViajeFeliz();

if ($bd->Iniciar()){
    $objPersona = new Persona();
    $objViaje = new Viaje();
    $objResponsable = new ResponsableV();
    $objPasajero = new Pasajero();
    $objEmpresa = new Empresa();

function menuPrincipal(){
    echo "
    |*************************************************************************|                                                                         
    |                         MENU PRINCIPAL                                  |
    |                  1) Cargar empresa precargada.                          |
    |                  2) Crear una empresa desde 0.                          |
    |                  3) Agregar Viaje (necesita una empresa cargarda).      |          
    |                  4) Cerrar programa.                                    |       
    |                                                                         |
    |*************************************************************************|
    \n";
}

function menuEmpresa(){
    echo "
    |*************************************************************************|                                                                         
    |                           MENU DE LA EMPRESA                            |
    |                        1) MENU del viaje:                               |
    |                        2) MENU del pasajero:                            |      
    |                        3) MENU del responsable:                         |
    |                        4) Volver:                                       | 
    |                                                                         |
    |*************************************************************************|
    \n";
}

function menuViaje(){
    echo "
    |*************************************************************************|                                                                         
    |                   Modificar | eliminar el viaje                         |
    |                   1) Eliminar viaje:                                    |
    |                   2) Modificar viaje:                                   |
    |                   3) Volver:                                            |
    |                                                                         |
    |*************************************************************************|
    \n";
}


function menuResponsable(){
    echo "
    |*************************************************************************|                                                                         
    |                        MENU RESPONSABLE                                 |
    |                        1 ) Modificar al resposanble:                    |
    |                        2 ) Volver:                                      | 
    |                                                                         |
    |*************************************************************************|
    \n";
}

function menuPasajero(){
    echo "
    |*************************************************************************|                                                                         
    |                        MENU PASAJERO                                    |
    |                        1) Agregar pasajero:                             |
    |                        2) Eliminar el pasajero:                         |
    |                        3) Modificar el pasajero:                        |
    |                        4) Volver:                                       | 
    |                                                                         |
    |*************************************************************************|
    \n";
}

do {
    menuPrincipal();
    $opcionPrincipal = trim(fgets(STDIN));
    
    switch ($opcionPrincipal) {
        case 1: //CARGAR EMPRESA RECARGADA
            /////////////////////////////////
            //DATOS PRECARGADOS
            ////////////////////////////////
            if ($coleccionEmpresas = $objEmpresa->listar()){
                $textoEmpresas = '';
                $i=0;
                foreach ($coleccionEmpresas as $empresa) {
                    if($i % 2 == 0){
                        echo "\033[36mEmpresa numero $i\n" . $empresa . "-------------------\n" . "y sus vuelos son:" . $empresa->mostrarViajes() . "\033[0m";
                    } else {
                        echo "\033[35mEmpresa numero $i\n" . $empresa . "-------------------\n" . "y sus vuelos son:" . $empresa->mostrarViajes() . "\033[0m";
                    }
                   $i++;
                }
            } else {
                echo "\033[42mCARGAMOS LA EMPRESA PRECARGADA\n\033[0m";
                
                    $datosEmpresa = ['idEmpresa' => null,'enombre' => 'empresa1','edireccion' => 'Lagos del Rios', 'coleccionViajes' => []];
                    $objEmpresa->cargar($datosEmpresa);
                    $objEmpresa->insertar();

                    $datosResponsable = ['documento' => 93284673,'rnumeroEmpleado' => null,'rnumeroLicencia' => '1','nombre' => 'Homero','apellido' => 'Simpson','ptelefono' => '77'];
                    $objResponsable->cargar($datosResponsable);
                    $objResponsable->insertar();

                    
                    $datosViaje = ['idViaje' => null,'destino' => 'Cordoba','cantidadMaximaPasajeros' => 100,'objEmpresa' => $objEmpresa, 'objEmpleado' => $objResponsable,'coleccionPasajeros' => []];
                    $objViaje->cargar($datosViaje);
                    $objViaje->insertar();
                    
                    $coleccionPasajeros = [
                        ['nombre' => 'Jorge', 'apellido' => 'Messi', 'documento' => '1', 'ptelefono' => '1556', 'idViaje' => $objViaje->getIdViaje()],
                        ['nombre' => 'Luis', 'apellido' => 'Suarez', 'documento' => '2', 'ptelefono' => '1557', 'idViaje' => $objViaje->getIdViaje()],
                        ['nombre' => 'Neymar', 'apellido' => 'Jr', 'documento' => '3', 'ptelefono' => '1558', 'idViaje' => $objViaje->getIdViaje()],
                        ['nombre' => 'Kylian', 'apellido' => 'Mbappe', 'documento' => '4', 'ptelefono' => '1559', 'idViaje' => $objViaje->getIdViaje()],
                        ['nombre' => 'Lionel', 'apellido' => 'Messi', 'documento' => '5', 'ptelefono' => '1560', 'idViaje' => $objViaje->getIdViaje()],
                        ['nombre' => 'Cristiano', 'apellido' => 'Ronaldo', 'documento' => '6', 'ptelefono' => '1561', 'idViaje' => $objViaje->getIdViaje()],
                        ['nombre' => 'Robert', 'apellido' => 'Lewandowski', 'documento' => '7', 'ptelefono' => '1562', 'idViaje' => $objViaje->getIdViaje()],
                        ['nombre' => 'Kevin', 'apellido' => 'De Bruyne', 'documento' => '8', 'ptelefono' => '1563', 'idViaje' => $objViaje->getIdViaje()],
                        ['nombre' => 'Golo', 'apellido' => 'Kante', 'documento' => '9', 'ptelefono' => '1564', 'idViaje' =>$objViaje->getIdViaje()],
                        ['nombre' => 'Mohamed', 'apellido' => 'Salah', 'documento' => '10', 'ptelefono' => '1565', 'idViaje' => $objViaje->getIdViaje()],
                        ['nombre' => 'Sadio', 'apellido' => 'Mane', 'documento' => '11', 'ptelefono' => '1566', 'idViaje' => $objViaje->getIdViaje()],
                        ['nombre' => 'Virgil', 'apellido' => 'Van Dijk', 'documento' => '12', 'ptelefono' => '1567', 'idViaje' => $objViaje->getIdViaje()],
                        ['nombre' => 'Alisson', 'apellido' => 'Becker', 'documento' => '13', 'ptelefono' => '1568', 'idViaje' => $objViaje->getIdViaje()],
                        ['nombre' => 'Thiago', 'apellido' => 'Alcantara', 'documento' => '14', 'ptelefono' => '1569', 'idViaje' => $objViaje->getIdViaje()],
                        ['nombre' => 'Frenkie', 'apellido' => 'De Jong', 'documento' => '15', 'ptelefono' => '1570', 'idViaje' => $objViaje->getIdViaje()],
                        ['nombre' => 'Luka', 'apellido' => 'Modric', 'documento' => '16', 'ptelefono' => '1571', 'idViaje' => $objViaje->getIdViaje()],
                        ['nombre' => 'Karim', 'apellido' => 'Benzema', 'documento' => '17', 'ptelefono' => '1572', 'idViaje' => $objViaje->getIdViaje()],
                        ['nombre' => 'Eden', 'apellido' => 'Hazard', 'documento' => '18', 'ptelefono' => '1573', 'idViaje' => $objViaje->getIdViaje()],
                        ['nombre' => 'Sergio', 'apellido' => 'Ramos', 'documento' => '19', 'ptelefono' => '1574', 'idViaje' => $objViaje->getIdViaje()]
                    ];

                    foreach ($coleccionPasajeros as $pasajero) {
                        $objPasajero->cargar($pasajero);
                        $objPasajero->insertar();
                    }

                    $objViaje->setColeccionPasajero($objPasajero->listar("idviaje = ". $objViaje->getIdViaje()));
                    if ($objEmpresa->listar()){
                        $viajes = $objEmpresa->getColeccionViajes();
                        array_push($viajes, $objViaje);
                        $objEmpresa->setColeccionViajes($viajes);
                    } else {
                        "\033[31mNo se cargó\033[0m\n";
                    }
                    
                    echo "\033[32m*********************************\nLa empresa que está cargada es:\n" . $objEmpresa . "y sus viajes son:\033[0m";
                    echo $objEmpresa->mostrarViajes();
            }
                do{

                echo "\033[33mIngrese el ID del viaje para cargar sus datos:\033[0m\n";
                $idViaje = trim(fgets(STDIN));

                if ($idViaje < 0 || !is_numeric($idViaje) || $objViaje->Buscar($idViaje) == false){
                    echo "\033[31mNo se encontro el viaje 😥\033[0m\n";
                } else{
                    $objViaje->Buscar($idViaje);
                    echo "\033[32mSe encontro el viaje 😁\033[0m\n";
                }
                } while($idViaje < 0 || !is_numeric($idViaje) || $objViaje->Buscar($idViaje) == false);

            do {
                
                menuEmpresa();
                $opcionDatos = trim(fgets(STDIN));
                
                switch($opcionDatos) {

                    case 1: /* menu viaje */
                        do {
                            if ($objViaje->Buscar($idViaje)) {
                                $viaje = $objViaje->listar()[0];
                                echo "\033[0;33m************\nDatos del viaje:\ncodigo del viaje: {$viaje->getIdViaje()}\ndestino: {$viaje->getDestino()}\ncantidad Maxima de pasajeros: {$viaje->getCantidadMaximaPasajeros()}\n************\033[0m";

                                menuViaje();
                                $opcionViaje = trim(fgets(STDIN));

                                switch ($opcionViaje) {
                                    case 1: 
                                           /// ELIMINAR VIAJE PRE CARGADO
                                           /////////////////////////////////////
                                           //Cargar empresa precargada -> menu viaje -> eliminar viaje
                                           /////////////////////////////////////

                                        echo "1) Eliminar el viaje:\n";
                                        echo "Para eliminar el viaje, vamos a tener que borrar el responsable y los pasajeros";

                                        foreach ($objViaje->getColeccionObjsPasajeros() as $pasajero) {
                                            $objPasajero->Buscar($pasajero->getDocumento());
                                            $objPasajero->eliminar();
                                        }
                                        $objResponsable->Buscar($objViaje->getResponsableV()->getDocumento());
                                        $objResponsable->eliminar();
                                        $objViaje->eliminar();

                                        break;
                                    case 2:
                                           /////////////////////////////////////
                                           //Cargar empresa precargada -> menu viaje -> modificar viaje
                                           /////////////////////////////////////

                                           echo "2) Modificar viaje:\n";
                                        do {
                                            echo "Ingrese el destino del viaje nuevo: ";
                                            $destinoNuevo = trim(fgets(STDIN));
                                            echo "Ingrese la cantidad maxima de pasajeros nuevo: ";
                                            $cantidadMaximaPasajerosNueva = trim(fgets(STDIN));

                                            if ($cantidadMaximaPasajerosNueva < 0 || !is_numeric($cantidadMaximaPasajerosNueva)) {
                                                echo "datos invalidos en la capacidad de pasajeros 🙁\n";
                                            }
                                        } while ($cantidadMaximaPasajerosNueva < 0 || !is_numeric($cantidadMaximaPasajerosNueva));

                                        $datosNuevos = ['idViaje' => $idViaje, 'destino' => $destinoNuevo, 'cantidadMaximaPasajeros' => $cantidadMaximaPasajerosNueva, 'objEmpresa' => $objViaje->getobjEmpresa(), 'objEmpleado' => $objViaje->getResponsableV(), 'coleccionPasajeros' => $objViaje->getColeccionObjsPasajeros()];
                                        $objViaje->cargar($datosNuevos);

                                        if ($objViaje->modificar()) {
                                            echo "\033[32mSe modifico el viaje correctamente 😁, sus nuevos datos son:\n\033[0m";
                                        } else {
                                            echo "Probablemente no existe una empresa creada \n";
                                        }
                                        break;
                                }
                            } else {
                                echo "\033[/////////////////////////////// \033[0m";
                                echo "\nNo existen viajes con ese id\n";
                                echo "\033[/////////////////////////////// \033[0m";
                            }
                        } while ($opcionViaje != 3 || !$objViaje->Buscar($idViaje));
                        break;

                    case 2: /*Cargar Pasajero*/
                        do {
                            echo $objViaje->mostrarPasajeros();

                            menuPasajero();
                            $opcionPasajero = trim(fgets(STDIN));

                            switch ($opcionPasajero) {
                                        /////////////////////////////////////
                                        //Cargar empresa precargada -> menu pasajero
                                        /////////////////////////////////////
                                case 1:
                                        /////////////////////////////////////
                                        //Cargar empresa precargada -> menu pasajero -> agregar pasajero
                                        /////////////////////////////////////

                                    $objViaje->Buscar($idViaje);
                                    echo "1 - Agregar a un pasajero \n";
                                    if ($objViaje->cantidadPasajerosActual() < $objViaje->getCantidadMaximaPasajeros()) {
                                        do {
                                        echo "Ingrese el nombre del pasajero: ";
                                        $nombrePasajero = trim(fgets(STDIN));
                                        echo "Ingrese el apellido del pasajero: ";
                                        $apellidoPasajero = trim(fgets(STDIN));
                                        do{
                                            echo "Ingrese el documento del pasajero: ";
                                            $documentoPasajero = trim(fgets(STDIN));
                                            if ($documentoPasajero < 0 || !is_numeric($documentoPasajero) || $objPersona->Buscar($documentoPasajero)){
                                                echo "El documento ya existe o es invalido\n";
                                            }
                                        } while ($documentoPasajero < 0 || !is_numeric($documentoPasajero) || $objPersona->Buscar($documentoPasajero));
                                        echo "Ingrese el telefono del pasajero: ";
                                        $telefonoPasajero = trim(fgets(STDIN));
                                        if($telefonoPasajero < 0 || !is_numeric($telefonoPasajero) || $nombrePasajero == "" || $apellidoPasajero == "" || $documentoPasajero == "" || $telefonoPasajero == "" || is_numeric($nombrePasajero) || is_numeric($apellidoPasajero)){
                                            echo "Datos invalidos\n";
                                        }
                                      } while ($telefonoPasajero < 0 || !is_numeric($telefonoPasajero) || $nombrePasajero == "" || $apellidoPasajero == "" || $documentoPasajero == "" || $telefonoPasajero == "" || is_numeric($nombrePasajero) || is_numeric($apellidoPasajero));
                                        $datosPasajero = ['nombre' => $nombrePasajero, 'apellido' => $apellidoPasajero, 'documento' => $documentoPasajero, 'ptelefono' => $telefonoPasajero, 'idViaje' => $idViaje];
                                        $objViaje->crearPasajero($datosPasajero);
                                    } else {
                                        echo "No se pueden agregar mas pasajeros\n";
                                    }
                                    break;
                                case 2:
                                        /////////////////////////////////////
                                        //Cargar empresa precargada -> menu pasajero -> Eliminar pasajero
                                        /////////////////////////////////////

                                    echo "2) Eliminar pasajero\n";
                                    echo "Ingrese el DNI del pasajero que quiere eliminar:";
                                    $dniPasajero = trim(fgets(STDIN));
                                    if($objPersona->buscar($dniPasajero)){
                                        if($objViaje->eliminarPasajero($dniPasajero)){
                                            echo "\033[42mSe eliminó el pasajero correctamente\n\033[0m";
                                        } else {
                                            echo "\033[41m No se encontró el DNI del pasajero \n \033[0m";
                                        }
                                    } else {
                                        echo "\033[41m No se encontró el DNI del pasajero \n \033[0m";
                                    }

                                    break;
                                case 3:
                                        /////////////////////////////////////
                                        //Cargar empresa precargada -> menu pasajero -> Modificar pasajero
                                        /////////////////////////////////////

                                    echo "3) Modificar pasajero:\n";
                                    echo "Ingrese el DNI del pasajero que quiera modificar:";
                                    $dniPasajero = trim(fgets(STDIN));

                                    if ($objPersona->Buscar($dniPasajero)) {
                                        echo "Ingrese el nuevo nombre:";
                                        $nuevoNombre = trim(fgets(STDIN));
                                        echo "Ingrese el nuevo apellido:";
                                        $nuevoApellido = trim(fgets(STDIN));
                                        echo "Ingrese el nuevo numero de telefono:";
                                        $nuevoNumTelefono = trim(fgets(STDIN));
                                        $datosPasajero = ['nombre' => $nuevoNombre, 'apellido' => $nuevoApellido, 'documento' => $dniPasajero, 'ptelefono' => $nuevoNumTelefono, 'idViaje' => $idViaje];
                                        $objViaje->modificarPasajero($datosPasajero);

                                    } else {
                                        echo "\033[41m No se encontró el DNI del pasajero \n \033[0m";
                                    }
                                    break;
                                case 4:
                                    break;
                            }

                        } while ($opcionPasajero != 4);
                        break;
                        
                        
                    case 3:/*Cargar Responsable*/
                          /////////////////////////////////////
                          //Cargar empresa precargada -> menu responsable
                          /////////////////////////////////////

                        do {
                           echo "\033[34m".$objViaje->getResponsableV()."\033[0m";

                            menuResponsable();
                            $opcionResponsable = trim(fgets(STDIN));      
                   
                            switch ($opcionResponsable) {
                                case 1:
                                       /////////////////////////////////////
                                       //Cargar empresa precargada -> menu responsable -> modificar responsable 
                                       /////////////////////////////////////

                                    echo "\033[34m".$objViaje->getResponsableV()."\033[0m";
                                    echo "\033[33m\nModificar Responsable\n\033[0m";
                                        do{
                                        echo "Ingrese el nuevo nombre:";
                                        $nuevoNombre = trim(fgets(STDIN));
                                        echo "Ingrese el nuevo apellido:";
                                        $nuevoApellido = trim(fgets(STDIN));
                                        echo "Ingrese el nuevo numero de telefono:";
                                        $nuevoNumTelefono = trim(fgets(STDIN));
                                        echo "Ingrese el numero de licencia nuevo:";
                                        $nuevaLicencia = trim(fgets(STDIN));
                                        if ($nuevoNumTelefono < 0 || !is_numeric($nuevoNumTelefono) || $nuevaLicencia < 0 || !is_numeric($nuevaLicencia) || $nuevoNombre == "" || $nuevoApellido == ""  || is_numeric($nuevoNombre) || is_numeric($nuevoApellido)){
                                            echo "Datos invalidos\n";
                                        }
                                        } while($nuevoNumTelefono < 0 || !is_numeric($nuevoNumTelefono) || $nuevaLicencia < 0 || !is_numeric($nuevaLicencia) || $nuevoNombre == "" || $nuevoApellido == ""  || is_numeric($nuevoNombre) || is_numeric($nuevoApellido));
                                        
                                        $datosResponsable = ['nombre' => $nuevoNombre, 'apellido' => $nuevoApellido, 'documento' => $objViaje->getResponsableV()->getDocumento(), 'ptelefono' => $nuevoNumTelefono, 'rnumeroLicencia' => $nuevaLicencia, 'rnumeroEmpleado' => $objViaje->getResponsableV()->getNumeroEmpleado()];
                                        
                                        $objResponsable->cargar($datosResponsable);
                                        $objResponsable->modificar();
                                        $objViaje->setResponsableV($objResponsable);

                                    break;
                                default:
                                    break;
                            }
                        } while ($opcionResponsable != 2);
                        break;
                    case 4:
                        break;
                }
            } while ($opcionDatos != 4);
            break;

        case 2: 
            
        /////////////////////////////////////
        //crear empresa desde 0     
        /////////////////////////////////////

            /*elimina el viaje el precargado*/
            if ($objEmpresa->listar()) {
                $consulta = 'DELETE FROM pasajero WHERE 1';
                if ($bd->Ejecutar($consulta)) {
                    $consulta = 'DELETE FROM responsable WHERE 1';
                    if ($bd->Ejecutar($consulta)) {
                        $consulta = 'DELETE FROM persona WHERE 1';
                        if ($bd->Ejecutar($consulta)) {
                            $consulta = 'DELETE FROM viaje WHERE 1';
                            if ($bd->Ejecutar($consulta)) {
                                $consulta = 'DELETE FROM empresa WHERE 1';
                                if ($bd->Ejecutar($consulta)) {
                                    echo "\033[42mSe eliminaron los datos precargados\n\033[0m";
                                    $objEmpresa->eliminarEmpresas();
                                } else {
                                    echo "\033[41mNo se eliminaron los datos precargados\n\033[0m";
                                }
                            }
                        }
                    }
                    echo "\033[42mSe eliminaron los datos precargados\n\033[0m";
                } else {
                    echo "\033[41mNo se eliminaron los datos precargados\n\033[0m";
                }
            }







            echo "\033[42mSe eliminaron los datos precargados\n\033[0m";
            
            echo "\033[44m----| LA BASE DE DATOS ESTÁ EN VACÍA |----\033[0m\n";
            
            echo "CREEMOS LA BASE DE DATOS 😁\n";
            do {
                echo "Ingrese el nombre de la empresa: ";
                $nombreEmpresa = trim(fgets(STDIN));
                echo "Ingrese la direccion de la empresa: ";
                $direccionEmpresa = trim(fgets(STDIN));
                if ($direccionEmpresa == "" || is_numeric($nombreEmpresa)) {
                    echo "\033[31mDatos inválidos\nLos datos deben ser numéricos mayores a 0 😕\033[0m\n";
                }
            } while ($nombreEmpresa == "" || $direccionEmpresa == "" || is_numeric($nombreEmpresa));

            echo "\033[44m----| CARGAMOS EL RESPONSABLE DEL VIAJE: |----\033[0m\n";
            do {
                echo "Ingrese su nombre: ";
                $nombreResponsable = trim(fgets(STDIN));
                echo "Ingrese su apellido: ";
                $apellidoResponsable = trim(fgets(STDIN));

                if ($nombreResponsable == "" || $apellidoResponsable == "" || is_numeric($nombreResponsable) || is_numeric($apellidoResponsable)) {
                    echo "\033[41mDatos inválidos\nLos datos deben ser texto 😕\033[0m\n";
                }
            } while ($nombreResponsable == "" || $apellidoResponsable == "" || is_numeric($nombreResponsable) || is_numeric($apellidoResponsable));
            do {
                echo "Ingrese su telefono: ";
                $numeroTelefonoResponsable = trim(fgets(STDIN));
                echo "Ingrese su numero documento: ";
                $numeroDocumentoResponsable = trim(fgets(STDIN));
                echo "Ingrese su numero de licencia: ";
                $numeroLicenciaResponsable = trim(fgets(STDIN));
                
                if ($numeroTelefonoResponsable < 0 || !is_numeric($numeroTelefonoResponsable) || $numeroDocumentoResponsable < 0 || !is_numeric($numeroDocumentoResponsable) || $numeroLicenciaResponsable < 0 || !is_numeric($numeroLicenciaResponsable)) {
                    echo "\033[41mDatos inválidos\nLos datos deben ser numéricos mayores a 0 😕\033[0m\n";
                }
            } while (!is_numeric($numeroTelefonoResponsable) || $numeroTelefonoResponsable < 0 || $numeroDocumentoResponsable < 0 || !is_numeric($numeroDocumentoResponsable) || $numeroLicenciaResponsable < 0 || !is_numeric($numeroLicenciaResponsable));

            echo "\033[44m----| CARGAMOS EL VIAJE |----\033[0m\n";
            do {
                echo "Ingrese su destino: ";
                $destinoViaje = trim(fgets(STDIN));
                
                echo "\033[44mIngrese la cantidad maxima de pasajeros: \033[0m\n";
                $cantidadMaximaPasajerosViaje = trim(fgets(STDIN));

                if ($cantidadMaximaPasajerosViaje < 0 || !is_numeric($cantidadMaximaPasajerosViaje) || $destinoViaje == "" || is_numeric($destinoViaje) ) {
                    echo "Datos invalidos\n";
                }
            } while ($cantidadMaximaPasajerosViaje < 0 || !is_numeric($cantidadMaximaPasajerosViaje) || $destinoViaje == "" || is_numeric($destinoViaje));

                
            $datosEmpresa = ['idEmpresa' => null,'enombre' => $nombreEmpresa, 'edireccion' => $direccionEmpresa, 'coleccionViajes' => []];
            $objEmpresa->cargar($datosEmpresa);
            $objEmpresa->insertar();


            $datosResponsable = ['documento' => $numeroDocumentoResponsable, 'rnumeroEmpleado' => null, 'rnumeroLicencia' => $numeroLicenciaResponsable, 'nombre' => $nombreResponsable, 'apellido' => $apellidoResponsable, 'ptelefono' => $numeroTelefonoResponsable];
            $objResponsable->cargar($datosResponsable);
            $objResponsable->insertar();


            $datosViaje = ['idViaje' => null, 'destino' => $destinoViaje, 'cantidadMaximaPasajeros' => $cantidadMaximaPasajerosViaje, 'objEmpresa' => $objEmpresa, 'objEmpleado' => $objResponsable, 'coleccionPasajeros' => []];
            $objViaje->cargar($datosViaje);
            $objViaje->insertar();

            
            echo "\033[44m----| CARGAMOS EL PASAJERO DEL VIAJE |----\033[0m\n";
            $coleccionPasajeros = [];

            echo "Cuantos pasajeros quiere ingresar?\n";
            $cantPasajeros = trim(fgets(STDIN));

            while ($cantPasajeros < 0 || $cantPasajeros > $cantidadMaximaPasajerosViaje) {
                echo "Ingrese un numero valido\n";
                $cantPasajeros = trim(fgets(STDIN));
            }

            for ($i = 0; $i < $cantPasajeros; $i++) {
                echo "\n";
                do{
                    echo "Ingrese su nombre: ";
                    $nombrePasajero = trim(fgets(STDIN));
                    echo "Ingrese su apellido: ";
                    $apellidoPasajero = trim(fgets(STDIN));
                    echo "Ingrese su telefono: ";
                    $numeroTelefonoPasajero = trim(fgets(STDIN));
                    if($nombrePasajero == "" || $apellidoPasajero == "" || $numeroTelefonoPasajero < 0 || !is_numeric($numeroTelefonoPasajero) || is_numeric($nombrePasajero) || is_numeric($apellidoPasajero)){
                        echo "Datos invalidos\n";
                    }
                } while ($nombrePasajero == "" || $apellidoPasajero == "" || $numeroTelefonoPasajero < 0 || !is_numeric($numeroTelefonoPasajero) || is_numeric($nombrePasajero) || is_numeric($apellidoPasajero));
                
                //verificar
                do {
                    echo "Ingrese su numero documento:";
                    $documentoPasajero = trim(fgets(STDIN));
                    if ($documentoPasajero == $numeroDocumentoResponsable || !is_numeric($documentoPasajero)) {
                        echo "documento invalido o repetido 😅\n";
                    }
                } while ($documentoPasajero == $numeroDocumentoResponsable || !is_numeric($documentoPasajero));

                $datosPasajero = ['nombre' => $nombrePasajero, 'apellido' => $apellidoPasajero, 'documento' => $documentoPasajero, 'ptelefono' => $numeroTelefonoPasajero, 'idViaje' => $objViaje->getIdViaje()];

                //no tengo idea porque esta esto
                array_push($coleccionPasajeros, $datosPasajero);

                $objPasajero->cargar($datosPasajero);
                $objPasajero->insertar();

            }

            
            if ($objEmpresa->listar()){
                echo "\033[42mSe cargó correctamente✅\033[0m\n";
                echo "los datos de la empresa y el viaje creado son:\n";
                echo $objEmpresa->listar()[0];
                echo $objViaje->listar()[0];
            } else {
                echo "\033[41mNo se cargó\033[0m\n";
            }

            do {
                echo "\n";
                echo "*********************************\n";
                echo "La empresa que esta cargada es:\n";
                echo $objEmpresa->mostrarViajes();
                

                echo "Ingrese el ID del viaje para encontrar sus datos:";
                $idViaje = trim(fgets(STDIN));
                
                menuEmpresa();
                $opcionDatos = trim(fgets(STDIN));
                switch ($opcionDatos) {

                    case 1: /*carga VIAJE*/
                        do {
                            if($objViaje->Buscar($idViaje)){
                                echo $objViaje->listar()[0];
                            } else{
                                echo "\n";
                                echo "\033[41m/////////////////////////////// \033[0m";
                                echo "\033[31mNo se encontro el viaje\n\033[0m";
                                echo "\033[41m//////////////////////////////// \033[0m";
                            }
                        menuViaje();
                        $opcionViaje = trim(fgets(STDIN));
                        switch($opcionViaje){
                            case 1:
                                //////////////////////////////////////////////////////////
                                /// 2- empresa desde 0 ---> menu viaje -> eliminar Viaje
                                //////////////////////////////////////////////////////////

                                echo "3) Eliminar el viaje:\n";
                                echo "Para eliminar el viaje, vamos a tener que borrar el responsable y los pasajeros";

                                $objPersona->Buscar($numeroDocumentoResponsable);
                                $objPersona->eliminar();

                                $coleccionPasajeros = $objPasajero->listar("idviaje = '". $idViaje."'");

                                foreach ($coleccionPasajeros as $pasajeroUnico) {
                                    $objPasajero->Buscar($pasajeroUnico->getDocumento());
                                    $objPasajero->eliminar();
                                }

                                if($objViaje->eliminar()){
                                    echo "\nSe eliminó el viaje y el responsable correctamente!! ✅";
                                }else{
                                    echo "No se pudo eliminar\n";
                                }
                                break;

                            case 2: 
                                //////////////////////////////////////////////////////////
                                /// 2- empresa desde 0 ---> menu viaje -> modificar Viaje
                                //////////////////////////////////////////////////////////
                                echo "2) Modificar viaje:\n";

                                        do {
                                            echo "Ingrese el destino del viaje nuevo: ";
                                            $destinoNuevo = trim(fgets(STDIN));
                                            echo "Ingrese la cantidad maxima de pasajeros nuevo: ";
                                            $cantidadMaximaPasajerosNueva = trim(fgets(STDIN));

                                            if ($cantidadMaximaPasajerosNueva < 0 || !is_numeric($cantidadMaximaPasajerosNueva)) {
                                                echo "datos invalidos en la capacidad de pasajeros 🙁\n";
                                            }
                                        } while ($cantidadMaximaPasajerosNueva < 0 || !is_numeric($cantidadMaximaPasajerosNueva));

                                        $datosNuevos = ['idViaje' => $idViaje, 'destino' => $destinoNuevo, 'cantidadMaximaPasajeros' => $cantidadMaximaPasajerosNueva, 'objEmpresa' => $objViaje->getobjEmpresa(), 'objEmpleado' => $objViaje->getResponsableV(), 'coleccionPasajeros' => $objViaje->getColeccionObjsPasajeros()];
                                        $objViaje->cargar($datosNuevos);

                                        if ($objViaje->modificar()) {
                                            echo "\033[32mSe modifico el viaje correctamente 😁, sus nuevos datos son:\n\033[0m";
                                        } else {
                                            echo "Probablemente no existe una empresa creada \n";
                                        }

                            break;
                        }
                        } while ($opcionViaje != 3);
                        break;

                    case 2: 
                        //////////////////////////////////////////////////////////
                        /// 2) empresa desde 0 ---> menu pasajero 
                        //////////////////////////////////////////////////////////
                        do {
                            
                            $texto = "-------------------\n";

                            //comentado por falta de funcionalidad - $coleccionPasajeros = $objPasajero->listar('idviaje = '. $idViaje);

                            echo $objViaje->mostrarPasajeros();
                            
                            menuPasajero();
                            $opcionPasajero = trim(fgets(STDIN));


                            if($opcionPasajero == "1"){
                            //////////////////////////////////////////////////////////
                            /// 2) empresa desde 0 ---> menu pasajero -> agregar pasajero
                            //////////////////////////////////////////////////////////

                                $objViaje->Buscar($idViaje);
                                echo "1) Agregar a un pasajero \n";
                                if ($objViaje->cantidadPasajerosActual() < $objViaje->getCantidadMaximaPasajeros()){
                                    echo "Ingrese el nombre del pasajero: ";
                                    $nombrePasajero = trim(fgets(STDIN));
                                    echo "Ingrese el apellido del pasajero: ";
                                    $apellidoPasajero = trim(fgets(STDIN));
                                    echo "Ingrese el documento del pasajero: ";
                                    $documentoPasajero = trim(fgets(STDIN));
                                    echo "Ingrese el telefono del pasajero: ";
                                    $telefonoPasajero = trim(fgets(STDIN));
                                    if($objPersona->Buscar($documentoPasajero)){
                                        echo "\033[41mEl documento pertenece a otra persona\033[0m\n";
                                    } else {
                                        $datosPasajero = ['nombre' => $nombrePasajero, 'apellido' => $apellidoPasajero, 'documento' => $documentoPasajero, 'ptelefono' => $telefonoPasajero, 'idViaje' => $idViaje];
                                        $objViaje->crearPasajero($datosPasajero);
                                    }
                                } else {
                                    echo "No se pueden agregar mas pasajeros\n";
                                }
                                
                            }else if($opcionPasajero == "2"){
                            //////////////////////////////////////////////////////////
                            /// 2) empresa desde 0 ---> menu pasajero -> eliminar pasajero
                            //////////////////////////////////////////////////////////

                                echo "2) Eliminar pasajero\n";
                                echo "Ingrese el DNI del pasajero que quiere eliminar:";
                                $dniPasajero = trim(fgets(STDIN));
                                $objPasajero->Buscar($dniPasajero);
                                $objPasajero->eliminar();
                                
                            }else if($opcionPasajero == "3"){
                             //////////////////////////////////////////////////////////
                            /// 2) empresa desde 0 ---> menu pasajero -> modficar pasajero
                            //////////////////////////////////////////////////////////
                                echo "3) Modificar pasajero:\n";
                                echo "Ingrese el DNI del pasajero que quiera modificar:";
                                $dniPasajero = trim(fgets(STDIN));

                                if($objPersona->Buscar($dniPasajero)){
                                    echo "Ingrese el nuevo nombre:";
                                    $nuevoNombre = trim(fgets(STDIN));
                                    echo "Ingrese el nuevo apellido:";
                                    $nuevoApellido = trim(fgets(STDIN));
                                    echo "Ingrese el nuevo numero de telefono:";
                                    $nuevoNumTelefono = trim(fgets(STDIN));
                                    $datosPersona = ['nombre' => $nuevoNombre, 'apellido' => $nuevoApellido, 'documento' => $dniPasajero, 'ptelefono' => $nuevoNumTelefono, 'idViaje' => $idViaje];
                                    $objViaje->modificarPasajero($datosPersona);
                                }else{
                                    echo "No se encontro el DNI del pasajero\n";
                                }
                            }
                        } while ($opcionPasajero != 4);
                        break;

                    case 3:/*Cargar Responsable*/
                             //////////////////////////////////////////////////////////
                            /// 2) empresa desde 0 ---> menu responsable 
                            //////////////////////////////////////////////////////////
                        do {
                            

                            echo $objViaje->getResponsableV();
                            //echo $objViaje->mostrarResponsable();
                            
                            echo "\n-------------------\n";

                            menuResponsable();
                            $opcionResponsable = trim(fgets(STDIN));      
                    
                            if($opcionResponsable == 1){
                            //////////////////////////////////////////////////////////
                            /// 2) empresa desde 0 ---> menu responsable -> modificar responsable 
                            //////////////////////////////////////////////////////////

                            echo "\033[34m".$objViaje->getResponsableV()."\033[0m";
                            echo "\033[33m\nModificar Responsable\n\033[0m";

                                do{
                                   echo "Ingrese el nuevo nombre:";
                                   $nuevoNombre = trim(fgets(STDIN));
                                   echo "Ingrese el nuevo apellido:";
                                   $nuevoApellido = trim(fgets(STDIN));
                                   echo "Ingrese el nuevo numero de telefono:";
                                   $nuevoNumTelefono = trim(fgets(STDIN));
                                   echo "Ingrese el numero de licencia nuevo:";
                                   $nuevaLicencia = trim(fgets(STDIN));

                                if ($nuevoNumTelefono < 0 || !is_numeric($nuevoNumTelefono) || $nuevaLicencia < 0 || !is_numeric($nuevaLicencia) || $nuevoNombre == "" || $nuevoApellido == ""  || is_numeric($nuevoNombre) || is_numeric($nuevoApellido)){
                                    echo "Datos invalidos\n";
                                }
                                } while($nuevoNumTelefono < 0 || !is_numeric($nuevoNumTelefono) || $nuevaLicencia < 0 || !is_numeric($nuevaLicencia) || $nuevoNombre == "" || $nuevoApellido == ""  || is_numeric($nuevoNombre) || is_numeric($nuevoApellido));
                                
                                $datosResponsable = ['nombre' => $nuevoNombre, 'apellido' => $nuevoApellido, 'documento' => $objViaje->getResponsableV()->getDocumento(), 'ptelefono' => $nuevoNumTelefono, 'rnumeroLicencia' => $nuevaLicencia, 'rnumeroEmpleado' => $objViaje->getResponsableV()->getNumeroEmpleado()];
                                
                                $objResponsable->cargar($datosResponsable);
                                $objResponsable->modificar();
                                $objViaje->setResponsableV($objResponsable);

                            }

                        } while ($opcionResponsable != 2);
                        break;
                }
            } while ($opcionDatos != 4);
            break;

        case 3: 
        /////////////////////////
        /// 3) agregar viaje  
        /////////////////////////
            /** CREAR VIAJE*/
            if ($objEmpresa->listar()){

                echo "*********************************\n";
                echo "Las empresas creadas son:\n";
                $empresas = $objEmpresa->listar();
                $txt = "";
                foreach($empresas as $empresa){
                    $txt .= $empresa . "\n";
                }
                echo $txt;


                do{
                echo "Ingrese el ID de la empresa que va a pertenecer el Viaje:\n";
                $idEmpresa = trim(fgets(STDIN));
                if ($idEmpresa < 0 || !is_numeric($idEmpresa) || $objEmpresa->Buscar($idEmpresa) == false){
                    echo "Datos invalidos\n";
                }
                } while ($idEmpresa < 0 || !is_numeric($idEmpresa) || $objEmpresa->Buscar($idEmpresa) == false);
                echo "CREACION DEL RESPONSABLE\n";

                do{
                
                //no anda1
                echo $objViaje->getResponsableV();

                print_r($objViaje->listar());
                
                echo " ingrese el DNI del responsable a cargo\n";
                $numDocumento = trim(fgets(STDIN));
                
                } while ($numDocumento < 0 || !is_numeric($numDocumento));
                if (!$objResponsable->Buscar($numDocumento)){

                    echo "ese dni no pertenece a ningun responsable\n";
                    echo "\033[1;33mVamos a crear un Responsable con ese dni[\033\n";
                        echo "Ingrese su nombre:";
                        $nombreResponsable = trim(fgets(STDIN));
                        echo "Ingrese su apellido:";
                        $apellidoResponsable = trim(fgets(STDIN));
                        echo "Ingrese su telefono:";
                        $numeroTelefonoResponsable = trim(fgets(STDIN));
                        echo "Ingrese su numero empleado:";
                        $numeroEmpleadoResponsable = trim(fgets(STDIN));
                        echo "Ingrese su numero de licencia:";
                        $numeroLicenciaResponsable = trim(fgets(STDIN));
                        $datosResponsable = ['documento' => $numDocumento,'rnumeroEmpleado' => $numeroEmpleadoResponsable,'rnumeroLicencia' => $numeroLicenciaResponsable,'nombre' => $nombreResponsable,'apellido' => $apellidoResponsable,'ptelefono' => $numeroTelefonoResponsable];
                        $objResponsable->cargar($datosResponsable);
                        $objResponsable->insertar();
                   
                } else {
                    echo "El empleado es\n";
                    echo $objResponsable->listar("rdocumento =". $numDocumento)[0] ."\n";
                    $numeroEmpleadoResponsable = $objResponsable->listar("rdocumento =". $numDocumento)[0]->getNumeroEmpleado();
                    // si existe queda ese empleado con ese ID
                }
                
                do {
                    echo "\033[1;33mCREACION DEL VIAJE\033\n";
                    echo "ingrese el id del viaje que quiere crear\n";
                    $idViaje = trim(fgets(STDIN));
                    if ($idViaje < 0 || !is_numeric($idViaje) || $objViaje->Buscar($idViaje)){
                        echo "Datos invalidos\n";
                    }
                } while($idViaje < 0 || !is_numeric($idViaje) || $objViaje->Buscar($idViaje));

                do {
                    echo "Ingrese su destino:";
                    $destinoViaje = trim(fgets(STDIN));
                    echo "Ingrese la cantidad maxima de pasajeros:";
                    $cantidadMaximaPasajerosViaje = trim(fgets(STDIN));
    
                    if ($cantidadMaximaPasajerosViaje < 0 || !is_numeric($cantidadMaximaPasajerosViaje)  || $destinoViaje == "" || is_numeric($destinoViaje)){
                        echo "Datos invalidos\n";
                    }
                } while ($cantidadMaximaPasajerosViaje < 0 || !is_numeric($cantidadMaximaPasajerosViaje) || $idViaje < 0 || !is_numeric($idViaje) || $destinoViaje == "" || is_numeric($destinoViaje) || $objViaje->Buscar($idViaje));
    
                echo "\033[44m----| CARGAMOS EL PASAJERO DEL VIAJE |----\033[0m\n";
                $coleccionPasajeros = [];
    
    
                echo "Cuantos pasajeros quiere ingresar?\n";
                $cantPasajeros = trim(fgets(STDIN));
    
                while ($cantPasajeros < 0 || $cantPasajeros > $cantidadMaximaPasajerosViaje){
                    echo "Ingrese un numero valido\n";
                    $cantPasajeros = trim(fgets(STDIN));
                }

                echo "VAMOS A CREAR A LOS PASAJEROS\n";
                
                $datosViaje = ['idViaje' => $idViaje,'destino' => $destinoViaje,'cantidadMaximaPasajeros' => $cantidadMaximaPasajerosViaje,'idEmpresa' => $idEmpresa,'numeroEmpleado' => $numeroEmpleadoResponsable,'coleccionPasajeros' => []];
                
                
                $objViaje->cargar($datosViaje);
                $objViaje->insertar();

                $i=0;
                do{
                    echo "\n";
                    echo "Ingrese su nombre:";
                    $nombrePasajero = trim(fgets(STDIN));
                    echo "Ingrese su apellido:";
                    $apellidoPasajero = trim(fgets(STDIN));
                    echo "Ingrese su telefono:";
                    $numeroTelefonoPasajero = trim(fgets(STDIN));
                    echo "Ingrese su numero documento:";
                    $documentoPasajero = trim(fgets(STDIN));

                    if ($documentoPasajero > 0 && is_numeric($documentoPasajero) && $objPersona->Buscar($documentoPasajero) == false){
                        $datosPasajero = ['nombre'=>$nombrePasajero,'apellido'=>$apellidoPasajero,'documento'=>$documentoPasajero,'ptelefono'=>$numeroTelefonoPasajero,'idViaje'=>$idViaje];
                        $objPasajero->cargar($datosPasajero);
                        $objPasajero->insertar();
                        array_push($coleccionPasajeros, $datosPasajero);
                        $i++;
                    } else {
                        echo "Datos invalidos\n";
                    }
                    
                } while ($i < $cantPasajeros);
    


                  do{
                    menuViaje();
                    
                    $opcion = trim(fgets(STDIN));

                    switch ($opcion) {
                    //////////////////////////////////////////////////////////
                    /// 3) agregar viaje -> menu viaje
                    //////////////////////////////////////////////////////////

                        case 1: 
                        //////////////////////////////////////////////////////////
                        /// 3) agregar viaje -> menu viaje -> eliminar viaje
                        //////////////////////////////////////////////////////////

                            echo "1) Eliminar viaje:\n";
                            
                            $viajes = $objViaje->listar();
                            $txt = "";
                            foreach($viajes as $viaje){
                                $txt .= $viaje . "\n";
                            }
                            echo $txt;
                            
                            echo "Vamos eliminar el viaje, tendremos que borrar el responsable y los pasajeros\n";
                            echo "Ingrese el ID del viaje que quiere eliminar\n";
                            $idViajeEliminar = trim(fgets(STDIN));
                            

                            if($objViaje->Buscar($idViajeEliminar)){
                                $datosPasajero =  $objPasajero->listar('idviaje = '. $idViajeEliminar);
                                foreach ($datosPasajero as $pasajero) {
                                    $objPasajero = new Pasajero();
                                    $objPasajero->eliminar();
                                }
                                $objViaje->eliminar();

                            }else {
                                echo "El viaje con ese ID NO existe\n";
                            }
                         break;

                        case 2: 
                        //////////////////////////////////////////////////////////
                        /// 3) agregar viaje -> menu viaje -> modificar viaje
                        //////////////////////////////////////////////////////////

                            echo "2) Modificar viaje:\n";   
                            do{
                                echo "Ingrese el destino del viaje nuevo: ";
                                $destinoNuevo = trim(fgets(STDIN));
                                echo "Ingrese la cantidad maxima de pasajeros nuevo: ";
                                $cantidadMaximaPasajerosNueva = trim(fgets(STDIN));
                                echo "Ingrese el ID empresa nuevo:\n";
                                $idEmpresaNuevo = trim(fgets(STDIN));

                                if ($idEmpresaNuevo < 1 || $objEmpresa->Buscar($idEmpresaNuevo) == false){
                                    echo "No se encontro la empresa y/o hay datos invalidos en la capacidad de pasajeros 🙁\n";
                                }
                                
                            } while ($idEmpresaNuevo < 1 || $objEmpresa->Buscar($idEmpresaNuevo) == false);
                            
                            $datosNuevos = ['idViaje'=> $idViaje ,'destino'=>$destinoNuevo, 'cantidadMaximaPasajeros'=> $cantidadMaximaPasajerosNueva, 'idEmpresa' => $idEmpresaNuevo, 'numeroEmpleado' =>1, 'coleccionPasajeros' => []];
                            echo "Se modifico el viaje correctamente !!\n";
                            $objViaje->cargar($datosNuevos);

                            if($objViaje->modificar()){
                                echo "Se modifico el viaje correctamente !!";
                            
                            }else{
                                echo "Probablemente no existe una empresa creada \n";
                            }
                            
                            break;
                        case 3:
                            break;
                    }
                    }while ($opcion != 4);

                } else {
                    echo "\033[31mNo hay empresas cargadas\033[0m";
                }
                
            break;
        case 4:
            echo "Gracias por usar nuestro servicio.\n";
            break;
            
    }//fin del switch    
    
} while ($opcionPrincipal != 4);
} else {
    echo "Conexion fallida";
}