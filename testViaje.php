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
            if ($objEmpresa->listar()){
                echo "*********************************\n";
                echo "\033[32mLa empresa que está cargada es:\n" . $objEmpresa->listar()[0] . " y sus vuelos son:\033[0m";

                $viajes = $objViaje->listar("idempresa = 1");
                $txt = "";
                foreach($viajes as $viaje){
                    $txt .= $viaje . "\n";
                }
                echo $txt;
                
                
            } else {
                echo "CARGAMOS LA EMPRESA PRECARGADA\n";
            
                $datosPasajero = [
                    ['nombre' => 'Jorge', 'apellido' => 'Messi', 'documento' => 11, 'ptelefono' => '1556', 'idViaje' => 1],
                    ['nombre' => 'Luis', 'apellido' => 'Suarez', 'documento' => 12, 'ptelefono' => '1557', 'idViaje' => 1],
                    ['nombre' => 'Neymar', 'apellido' => 'Jr', 'documento' => 13, 'ptelefono' => '1558', 'idViaje' => 1],
                    ['nombre' => 'Kylian', 'apellido' => 'Mbappe', 'documento' => 14, 'ptelefono' => '1559', 'idViaje' => 1 ],
                    ['nombre' => 'Lionel', 'apellido' => 'Messi', 'documento' => 15, 'ptelefono' => '1560', 'idViaje' => 1],
                    ['nombre' => 'Cristiano', 'apellido' => 'Ronaldo', 'documento' => 16, 'ptelefono' => '1561', 'idViaje' => 1],
                    ['nombre' => 'Robert', 'apellido' => 'Lewandowski', 'documento' => 17, 'ptelefono' => '1562', 'idViaje' => 1],
                    ['nombre' => 'Kevin', 'apellido' => 'De Bruyne', 'documento' => 18, 'ptelefono' => '1563', 'idViaje' => 1],
                    ['nombre' => 'Golo', 'apellido' => 'Kante', 'documento' => 19, 'ptelefono' => '1564', 'idViaje' => 1],
                    ['nombre' => 'Mohamed', 'apellido' => 'Salah', 'documento' => 20, 'ptelefono' => '1565', 'idViaje' => 1]];
                
                    $datosResponsable = ['documento' => 93284673,'rnumeroEmpleado' => 1,'rnumeroLicencia' => '1','nombre' => 'Homero','apellido' => 'Simpson','ptelefono' => '77'];
                    
                    $datosViaje = ['idViaje' => 1,'destino' => 'Cordoba','cantidadMaximaPasajeros' => 100,'idEmpresa' => 1,'numeroEmpleado' => 1,'coleccionPasajeros' => $datosPasajero];
                  
                    $datosEmpresa = ['idEmpresa' => 1,'enombre' => 'empresa1','edireccion' => 'Lagos del Rios', 'coleccionViajes' => []];
                    $objEmpresa->cargar($datosEmpresa);
                    $objEmpresa->insertar();

                    $objResponsable->cargar($datosResponsable);
               
                    $objResponsable->insertar();

                    
                    $objViaje->cargar($datosViaje);
                   
                    $objViaje->insertar();
                    
                    foreach ($datosPasajero as $pasajero) {
                        $objPasajero->cargar($pasajero);
                
                        $objPasajero->insertar();
                    }
                    
                    if ($objEmpresa->listar()){
                        echo "\033[32mSe cargó correctamente\033[0m\n";
                        
                    } else {
                        "\033[31mNo se cargó\033[0m\n";
                    }
                    
                    echo "*********************************\n";
                    echo "\033[32mLa empresa que está cargada es:\n" . $objEmpresa->listar()[0] . " y sus vuelos son:\033[0m";
    
                    $viajes = $objViaje->listar("idempresa = 1");
                    $txt = "";
                    foreach($viajes as $viaje){
                        $txt .= $viaje . "\n";
                    }
                    echo $txt; 
            }
                do{
                echo "Ingrese el ID del viaje para encontrar sus datos:";
                $idViaje = trim(fgets(STDIN));
                if ($idViaje < 0 || !is_numeric($idViaje) || $objViaje->buscar($idViaje) == false){
                    echo "\033[31mNo se encontro el viaje 😥\033[0m\n";
                }
                } while($idViaje < 0 || !is_numeric($idViaje) || $objViaje->buscar($idViaje) == false);

            do {
                
                menuEmpresa();
                $opcionDatos = trim(fgets(STDIN));
                
                switch($opcionDatos) {

                    case 1: /* menu viaje */
                        do {
                        if($objViaje->Buscar($idViaje)){
                            echo $objViaje->listar()[0];
                        } else{
                            echo "\033[/////////////////////////////// \033[0m";
                            echo "\nNo se encontro el viaje\n";
                            echo "\033[/////////////////////////////// \033[0m";
                        }

                        menuViaje();
                        $opcionViaje = trim(fgets(STDIN));
                        
                        switch ($opcionViaje) {
                            
                            case 1: /// ELIMINAR VIAJE PRE CARGADO
                                echo "1) Eliminar el viaje:\n";
                                echo "Para eliminar el viaje ,vamos a tener que borrar el responsable y los pasajeros";
                                
                                $coleccionPasajeros = $objPasajero->listar(" idviaje = '". $idViaje."'");
                                foreach ($coleccionPasajeros as $pasajeroUnico) {
                                    $objPasajero->Buscar($pasajeroUnico->getDocumento());
                                    $objPasajero->eliminar();
                                }

                                $objResponsable->eliminar();
                                $objPersona->eliminar();
                           
                                if($objViaje->eliminar()){
                                    echo "\033[32mSe eliminó el viaje y el responsable correctamente !!\033[0m";
                                }else{
                                    echo "\033[31mNo se pudo eliminar\033[0m\n";
                                }
                                
                                break;
                        
                            case 2:
                                echo "2) Modificar viaje:\n";
                                
                                do{
                                    echo "Ingrese el destino del viaje nuevo: ";
                                    $destinoNuevo = trim(fgets(STDIN));
                                    echo "Ingrese la cantidad maxima de pasajeros nuevo: ";
                                    $cantidadMaximaPasajerosNueva = trim(fgets(STDIN));
                                    echo "Ingrese el ID empresa nuevo:\n"; //CHEQUEAR
                                    $idEmpresaNuevo = trim(fgets(STDIN));
                                    if ($idEmpresaNuevo < 1 || $objEmpresa->buscar($idEmpresaNuevo) == false || $cantidadMaximaPasajerosNueva < 0 || !is_numeric($cantidadMaximaPasajerosNueva)){
                                        echo "No se encontro la empresa y/o hay datos invalidos en la capacidad de pasajeros 🙁\n";
                                    }
                                } while ($idEmpresaNuevo < 1 || $objEmpresa->buscar($idEmpresaNuevo) == false);
                                $datosNuevos = ['idViaje'=> $idViaje ,'destino'=>$destinoNuevo, 'cantidadMaximaPasajeros'=> $cantidadMaximaPasajerosNueva, 'idEmpresa' => $idEmpresaNuevo, 'numeroEmpleado' =>1, 'coleccionPasajeros' => []];
                                echo "Se modifico el viaje correctamente !!\n";
                                $objViaje->cargar($datosNuevos);

                                if($objViaje->modificar()){
                                    echo "Se modifico el viaje correctamente !!";
                                
                                }else{
                                    echo "Probablemente no existe una empresa creada \n";
                                }
                             break;
                        }

                        } while ($opcionViaje != 3);
                        break;

                    case 2: /*Cargar Pasajero*/
                        do {
                            menuPasajero();
                            $texto = "-------------------\n";

                            $coleccionPasajeros = $objPasajero->listar();
                            foreach ($coleccionPasajeros as $pasajero) {
                                $texto .= $pasajero . "\n--------------------\n";
                            }
                            echo $texto;

                            menuPasajero();
                            $opcionPasajero = trim(fgets(STDIN));

                            switch ($opcionPasajero) {
                                case 1:
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
                                            if ($documentoPasajero < 0 || !is_numeric($documentoPasajero) || $objPersona->buscar($documentoPasajero)){
                                                echo "El documento ya existe o es invalido\n";
                                            }
                                        } while ($documentoPasajero < 0 || !is_numeric($documentoPasajero) || $objPersona->buscar($documentoPasajero));
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
                                    echo "2) Eliminar pasajero\n";
                                    echo "Ingrese el DNI del pasajero que quiere eliminar:";
                                    $dniPasajero = trim(fgets(STDIN));
                                    $objPasajero->Buscar($dniPasajero);
                                    $objPasajero->eliminar();
                                    break;
                                case 3:
                                    echo "3) Modificar pasajero:\n";
                                    echo "Ingrese el DNI del pasajero que quiera modificar:";
                                    $dniPasajero = trim(fgets(STDIN));

                                    if ($objPersona->buscar($dniPasajero)) {
                                        echo "Ingrese el nuevo nombre:";
                                        $nuevoNombre = trim(fgets(STDIN));
                                        echo "Ingrese el nuevo apellido:";
                                        $nuevoApellido = trim(fgets(STDIN));
                                        echo "Ingrese el nuevo numero de telefono:";
                                        $nuevoNumTelefono = trim(fgets(STDIN));
                                        $datosPersona = ['nombre' => $nuevoNombre, 'apellido' => $nuevoApellido, 'documento' => $dniPasajero, 'ptelefono' => $nuevoNumTelefono, 'idViaje' => $idViaje];

                                        $objPersona->cargar($datosPersona);
                                        $objPersona->modificar();
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
                        menuResponsable();
                        do {
                            $txt ='';
                            $coleccionResponsables = $objResponsable->listar();
                            foreach($coleccionResponsables as $responsable){
                                $txt .= $responsable . "\n";
                            }
                            echo $txt;
                            echo "-------------------\n";

                            menuResponsable();
                            $opcionResponsable = trim(fgets(STDIN));      
                   
                            switch ($opcionResponsable) {
                                case 1:
                                    echo "Modificar Responsable\n";
                                    echo "Ingrese el DNI del responsable que quiere modificar:";
                                    $dniPersona = trim(fgets(STDIN));
                                    
                                    if ($objPersona->buscar($dniPersona)) {
                                        
                                        do{
                                        echo "Ingrese el nuevo nombre:";
                                        $nuevoNombre = trim(fgets(STDIN));
                                        echo "Ingrese el nuevo apellido:";
                                        $nuevoApellido = trim(fgets(STDIN));
                                        echo "Ingrese el nuevo numero de telefono:";
                                        $nuevoNumTelefono = trim(fgets(STDIN));
                                        echo "Ingrese el numero de licencia nuevo:";
                                        $nuevaLicencia = trim(fgets(STDIN));
                                        if ($nuevoNumTelefono < 0 || !is_numeric($nuevoNumTelefono) || $nuevaLicencia < 0 || !is_numeric($nuevaLicencia) || $nuevoNombre == "" || $nuevoApellido == "" || $dniPersona == "" || is_numeric($nuevoNombre) || is_numeric($nuevoApellido)){
                                            echo "Datos invalidos\n";
                                        }
                                        } while($nuevoNumTelefono < 0 || !is_numeric($nuevoNumTelefono) || $nuevaLicencia < 0 || !is_numeric($nuevaLicencia) || $nuevoNombre == "" || $nuevoApellido == "" || $dniPersona == "" || is_numeric($nuevoNombre) || is_numeric($nuevoApellido));
                                        
                                        $datosPersona = ['nombre' => $nuevoNombre, 'apellido' => $nuevoApellido, 'documento' => $dniPersona, 'ptelefono' => $nuevoNumTelefono, 'rnumeroLicencia' => $nuevaLicencia, 'rnumeroEmpleado' => null];
                                        
                                        $objResponsable->cargar($datosPersona);
                                        $objResponsable->modificar();
                                    } else {
                                        echo "\033[41mNo se encontró el DNI del responsable\n\033[0m";
                                    }
                                    echo "\n";
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
            //print_r($objEmpresa->listar());
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
                echo "Ingrese el ID de la empresa: ";
                $idEmpresa = trim(fgets(STDIN));
                echo "Ingrese la direccion de la empresa: ";
                $direccionEmpresa = trim(fgets(STDIN));
                if ($idEmpresa < 0 || $nombreEmpresa == "" || $direccionEmpresa == "" || !is_numeric($idEmpresa) || is_numeric($nombreEmpresa)) {
                    echo "\033[31mDatos inválidos\nLos datos deben ser numéricos mayores a 0 😕\033[0m\n";
                }
            } while ($idEmpresa < 0 || $nombreEmpresa == "" || $direccionEmpresa == "" || !is_numeric($idEmpresa) || is_numeric($nombreEmpresa));

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
                //verificaciones de numeros 
                echo "Ingrese su numero documento: ";
                $numeroDocumentoResponsable = trim(fgets(STDIN));
                echo "Ingrese su numero empleado: ";
                $numeroEmpleadoResponsable = trim(fgets(STDIN));
                echo "Ingrese su numero de licencia: ";
                $numeroLicenciaResponsable = trim(fgets(STDIN));
                if ($numeroTelefonoResponsable < 0 || !is_numeric($numeroTelefonoResponsable) || $numeroDocumentoResponsable < 0 || !is_numeric($numeroDocumentoResponsable) || $numeroEmpleadoResponsable < 0 || !is_numeric($numeroEmpleadoResponsable) || $numeroLicenciaResponsable < 0 || !is_numeric($numeroLicenciaResponsable)) {
                    echo "\033[41mDatos inválidos\nLos datos deben ser numéricos mayores a 0 😕\033[0m\n";
                }
            } while (!is_numeric($numeroTelefonoResponsable) || $numeroTelefonoResponsable < 0 || $numeroDocumentoResponsable < 0 || !is_numeric($numeroDocumentoResponsable) || $numeroEmpleadoResponsable < 0 || !is_numeric($numeroEmpleadoResponsable) || $numeroLicenciaResponsable < 0 || !is_numeric($numeroLicenciaResponsable));

            echo "\033[44m----| CARGAMOS EL VIAJE |----\033[0m\n";
            do {
                echo "Ingrese su destino: ";
                $destinoViaje = trim(fgets(STDIN));
                echo "Ingrese el ID del viaje: ";
                $idViaje = trim(fgets(STDIN));
                echo "Ingrese la cantidad maxima de pasajeros: ";
                $cantidadMaximaPasajerosViaje = trim(fgets(STDIN));

                if ($cantidadMaximaPasajerosViaje < 0 || !is_numeric($cantidadMaximaPasajerosViaje) || $idViaje < 0 || !is_numeric($idViaje) || $destinoViaje == "" || is_numeric($destinoViaje) || $objViaje->buscar($idViaje)) {
                    echo "Datos invalidos\n";
                }
            } while ($cantidadMaximaPasajerosViaje < 0 || !is_numeric($cantidadMaximaPasajerosViaje) || $idViaje < 0 || !is_numeric($idViaje) || $destinoViaje == "" || is_numeric($destinoViaje) || $objViaje->buscar($idViaje));

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
                echo "Ingrese su nombre: ";
                $nombrePasajero = trim(fgets(STDIN));
                echo "Ingrese su apellido: ";
                $apellidoPasajero = trim(fgets(STDIN));
                echo "Ingrese su telefono: ";
                $numeroTelefonoPasajero = trim(fgets(STDIN));
                //verificar
                do {
                    echo "Ingrese su numero documento:";
                    $documentoPasajero = trim(fgets(STDIN));
                    if ($documentoPasajero == $numeroDocumentoResponsable) {
                        echo "ese es el documento del responsable que estas queriendo ingresar 😅\n";
                    }
                } while ($documentoPasajero == $numeroDocumentoResponsable);
                $datosPasajero = ['nombre' => $nombrePasajero, 'apellido' => $apellidoPasajero, 'documento' => $documentoPasajero, 'ptelefono' => $numeroTelefonoPasajero, 'idViaje' => $idViaje];
                array_push($coleccionPasajeros, $datosPasajero);
            }

            $datosEmpresa = ['idEmpresa' => 1, 'enombre' => $nombreEmpresa, 'edireccion' => $direccionEmpresa, 'coleccionViajes' => []];
            $datosResponsable = ['documento' => $numeroDocumentoResponsable, 'rnumeroEmpleado' => $numeroEmpleadoResponsable, 'rnumeroLicencia' => $numeroLicenciaResponsable, 'nombre' => $nombreResponsable, 'apellido' => $apellidoResponsable, 'ptelefono' => $numeroTelefonoResponsable];
            $datosViaje = ['idViaje' => $idViaje, 'destino' => $destinoViaje, 'cantidadMaximaPasajeros' => $cantidadMaximaPasajerosViaje, 'idEmpresa' => 1, 'numeroEmpleado' => $numeroEmpleadoResponsable, 'coleccionPasajeros' => $coleccionPasajeros];

            $objEmpresa->cargar($datosEmpresa);
            $objEmpresa->insertar();

            $objResponsable->cargar($datosResponsable);
            $objResponsable->insertar();

            $objViaje->cargar($datosViaje);
            $objViaje->insertar();

            foreach ($coleccionPasajeros as $pasajero) {
                $objPasajero->cargar($pasajero);
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
                
                echo "*********************************\n";
                echo "\033[44mLa empresa que esta cargada es:\n". $objEmpresa->listar()[0] . "\033[0m";
                $viajes = $objViaje->listar("idviaje = 1");
                $txt = "";
                foreach($viajes as $viaje){
                    $txt .= $viaje . "\n";
                }
                echo $txt;

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
                                echo "\033[/////////////////////////////// \033[0m";
                                echo "\nNo se encontro el viaje\n";
                                echo "\033[//////////////////////////////// \033[0m";
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

                                $objPersona->buscar($numeroDocumentoResponsable);
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

                                echo "2) Modificar viaje:\n";
                                
                                echo "Ingrese el destino del viaje nuevo: ";
                                $destinoNuevo = trim(fgets(STDIN));
                                echo "Ingrese la cantidad máxima de pasajeros nuevo: ";
                                $cantidadMaximaPasajerosNueva = trim(fgets(STDIN));
                                
                                $datosNuevos = ['idViaje'=> $idViaje ,'destino'=>$destinoNuevo, 'cantidadMaximaPasajeros'=> $cantidadMaximaPasajerosNueva, 'idEmpresa' => null, 'numeroEmpleado' =>null, 'coleccionPasajeros' => []];
                            
                                $objViaje->cargar($datosNuevos);
                                $objViaje->modificar();
                                break;
                        }
                        } while ($opcionViaje != 4);
                        break;

                    case 2: /*Cargar Pasajero*/

                        do {
                            
                            $texto = "-------------------\n";

                            $coleccionPasajeros = $objPasajero->listar('idviaje = '. $idViaje);
                            foreach ($coleccionPasajeros as $pasajero) {
                                $texto .= $pasajero . "\n--------------------\n";
                            }
                            echo $texto;
                            
                            menuPasajero();
                            $opcionPasajero = trim(fgets(STDIN));

                            if($opcionPasajero == "1"){
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
                                    if($objPersona->buscar($documentoPasajero)){
                                        echo "\033[41mEl documento pertenece a otra persona\033[0m\n";
                                    } else {
                                        $datosPasajero = ['nombre' => $nombrePasajero, 'apellido' => $apellidoPasajero, 'documento' => $documentoPasajero, 'ptelefono' => $telefonoPasajero, 'idViaje' => $idViaje];
                                        $objViaje->crearPasajero($datosPasajero);
                                    }
                                } else {
                                    echo "No se pueden agregar mas pasajeros\n";
                                }
                                
                            }else if($opcionPasajero == "2"){
                                echo "2) Eliminar pasajero\n";
                                echo "Ingrese el DNI del pasajero que quiere eliminar:";
                                $dniPasajero = trim(fgets(STDIN));
                                $objPasajero->Buscar($dniPasajero);
                                $objPasajero->eliminar();
                                
                            }else if($opcionPasajero == "3"){
                                echo "3) Modificar pasajero:\n";
                                echo "Ingrese el DNI del pasajero que quiera modificar:";
                                $dniPasajero = trim(fgets(STDIN));

                                if($objPersona->buscar($dniPasajero)){
                                    echo "Ingrese el nuevo nombre:";
                                    $nuevoNombre = trim(fgets(STDIN));
                                    echo "Ingrese el nuevo apellido:";
                                    $nuevoApellido = trim(fgets(STDIN));
                                    echo "Ingrese el nuevo numero de telefono:";
                                    $nuevoNumTelefono = trim(fgets(STDIN));
                                    $datosPersona = ['nombre' => $nuevoNombre, 'apellido' => $nuevoApellido, 'documento' => $dniPasajero, 'ptelefono' => $nuevoNumTelefono, 'idViaje' => $idViaje];
                                    
                                    $objPersona->cargar($datosPersona);
                                    $objPersona->modificar();
                                }else{
                                    echo "No se encontro el DNI del pasajero\n";
                                }
                            }

                        } while ($opcionPasajero != 4);
                        break;
                        
                    case 3:/*Cargar Responsable*/
                        do {
                            
                            if($objViaje->Buscar($idViaje)){
                                echo $objViaje->mostrarResponsable();
                            }
                            echo "\n-------------------\n";

                            menuResponsable();
                            $opcionResponsable = trim(fgets(STDIN));      
                    
                            if($opcionResponsable == 1){
                                echo "Modificar Responsable\n";
                                $objResponsable->listar();
                                echo "Ingrese el DNI del responsable que quiere modificar:";
                                $dniPersona = trim(fgets(STDIN));
                                
                                if($objPersona->buscar($dniPersona)){
                                    
                                    echo "Ingrese el nuevo nombre:";
                                    $nuevoNombre = trim(fgets(STDIN));
                                    echo "Ingrese el nuevo apellido:";
                                    $nuevoApellido = trim(fgets(STDIN));
                                    echo "Ingrese el nuevo numero de telefono:";
                                    $nuevoNumTelefono = trim(fgets(STDIN));
                                    echo "Ingrese el numero de licencia nuevo:";
                                    $nuevaLicencia = trim(fgets(STDIN));
                                    
                                    $datosPersona = ['nombre' => $nuevoNombre, 'apellido' => $nuevoApellido, 'documento' => $dniPersona, 'ptelefono' => $nuevoNumTelefono, 'rnumeroLicencia' => $nuevaLicencia, 'rnumeroEmpleado' => null];
                                    
                                    $objResponsable->cargar($datosPersona);
                                    $objResponsable->modificar();
                                }else{
                                    echo "No se encontro el DNI del pasajero\n";
                                }
                                echo "\n";  
                            }
                        } while ($opcionResponsable != 2);
                        break;
                }
            } while ($opcionDatos != 4);
            break;

        case 3: 
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
                echo "\nIngrese el ID de la empresa que va a pertenecer el Viaje";
                $idEmpresa = trim(fgets(STDIN));
                if ($idEmpresa < 0 || !is_numeric($idEmpresa) || $objEmpresa->buscar($idEmpresa) == false){
                    echo "Datos invalidos\n";
                }
                } while ($idEmpresa < 0 || !is_numeric($idEmpresa) || $objEmpresa->buscar($idEmpresa) == false);
                echo "\033 CREACION DEL RESPONSABLE\033\n";

                do{
                echo " ingrese el DNI del responsable a cargo\n";
                $numDocumento = trim(fgets(STDIN));
                
                } while ($numDocumento < 0 || !is_numeric($numDocumento));
                if (!$objResponsable->buscar($numDocumento)){

                    echo "ese dni no pertenece a ningun responsable\n";
                    echo "\033[1;33mVamos a crear un Responsable con ese dni\033\n";
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
                    if ($idViaje < 0 || !is_numeric($idViaje) || $objViaje->buscar($idViaje)){
                        echo "Datos invalidos\n";
                    }
                } while($idViaje < 0 || !is_numeric($idViaje) || $objViaje->buscar($idViaje));

                do {
                    echo "Ingrese su destino:";
                    $destinoViaje = trim(fgets(STDIN));
                    echo "Ingrese la cantidad maxima de pasajeros:";
                    $cantidadMaximaPasajerosViaje = trim(fgets(STDIN));
    
                    if ($cantidadMaximaPasajerosViaje < 0 || !is_numeric($cantidadMaximaPasajerosViaje)  || $destinoViaje == "" || is_numeric($destinoViaje)){
                        echo "Datos invalidos\n";
                    }
                } while ($cantidadMaximaPasajerosViaje < 0 || !is_numeric($cantidadMaximaPasajerosViaje) || $idViaje < 0 || !is_numeric($idViaje) || $destinoViaje == "" || is_numeric($destinoViaje) || $objViaje->buscar($idViaje));
    
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

                    if ($documentoPasajero > 0 && is_numeric($documentoPasajero) && $objPersona->buscar($documentoPasajero) == false){
                        $datosPasajero = ['nombre'=>$nombrePasajero,'apellido'=>$apellidoPasajero,'documento'=>$documentoPasajero,'ptelefono'=>$numeroTelefonoPasajero,'idViaje'=>$idViaje];
                        $objPasajero->cargar($datosPasajero);
                        $objPasajero->insertar();
                        array_push($coleccionPasajeros, $datosPasajero);
                        $i++;
                    } else {
                        echo "Datos invalidos\n";
                    }
                    
                } while ($i < $cantPasajeros);
    


                  do{//MENU VIAJE CON LAS MODIFICACIONES CORRESPONDIENTES
                    menuViaje();
                    
                    $opcion = trim(fgets(STDIN));

                    switch ($opcion) {
                        case 1: // agregar viaje -> eliminar VIAJE 
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
                            
                            //$objResponsable->buscar();
                            //////////////////////////////////////////////////////////////////////////////revisar $datosPasajero =  $objPasajero->listar('idviaje = '. $idViajeEliminar);
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

                        case 2: // agregar viaje -> modificar VIAJE
                            echo "2) Modificar viaje:\n";   
                            do{
                                echo "Ingrese el destino del viaje nuevo: ";
                                $destinoNuevo = trim(fgets(STDIN));
                                echo "Ingrese la cantidad maxima de pasajeros nuevo: ";
                                $cantidadMaximaPasajerosNueva = trim(fgets(STDIN));
                                echo "Ingrese el ID empresa nuevo:\n";
                                $idEmpresaNuevo = trim(fgets(STDIN));

                                if ($idEmpresaNuevo < 1 || $objEmpresa->buscar($idEmpresaNuevo) == false){
                                    echo "No se encontro la empresa y/o hay datos invalidos en la capacidad de pasajeros 🙁\n";
                                }
                                
                            } while ($idEmpresaNuevo < 1 || $objEmpresa->buscar($idEmpresaNuevo) == false);
                            
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
                    echo "No hay empresas cargadas\n";
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