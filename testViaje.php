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
    |                        MENU PRINCIPAL                                   |
    |                        1 ) Cargar empresa precargada.                   |
    |                        2 ) Crear una empresa desde 0.                   |
    |                        3 ) Cerrar programa.                             |
    |                                                                         |
    |*************************************************************************|
    \n";
}
function menuDatos(){
    echo "
    |*************************************************************************|                                                                         
    |                        MENU DATOS                                       |
    |                        1 ) Datos del viaje:                             |
    |                        2 ) Datos del pasajero:                          |
    |                        3 ) Datos del responsable:                       |
    |                        4 ) Volver:                                      | 
    |                                                                         |
    |*************************************************************************|
    \n";
    
}
function menuViaje(){
    echo "
    |*************************************************************************|                                                                         
    |                        MENU VIAJE                                       |
    |                        1 ) Eliminar el viaje:                           |
    |                        2 ) Modificar el viaje:                          |
    |                        3 ) Volver:                                      |
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
    |                        1 ) Agregar pasajero:                            |
    |                        2 ) Eliminar el pasajero:                        |
    |                        3 ) Modificar el pasajero:                       |
    |                        4 ) Volver:                                      | 
    |                                                                         |
    |*************************************************************************|
    \n";
}

do {
    menuPrincipal();
    $opcionPrincipal = trim(fgets(STDIN));

    switch ($opcionPrincipal) {
        case 1: //CARGAR EMPRESA RECARGADA
            /*DATOS PRECARGADOS*/
            if ($objEmpresa->listar()){
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
                
                    $datosResponsable = ['documento' => '93284673','rnumeroEmpleado' => '7','rnumeroLicencia' => '1','nombre' => 'Homero','apellido' => 'Simpson','ptelefono' => '77'];
                    
                    $datosViaje = ['idViaje' => '2','destino' => 'Cordoba','cantidadMaximaPasajeros' => '100','idEmpresa' => '80','numeroEmpleado' => '7','coleccionPasajeros' => $datosPasajero];
                  
                    $objResponsable->cargar($datosResponsable);
                    $objResponsable->insertar();
            
                    $objViaje->cargar($datosViaje);
                    $objViaje->insertar();
                    
                    foreach ($datosPasajero as $pasajero) {
                        $objPasajero = new Pasajero();
                        $objPasajero->cargar($pasajero);
                        $objPasajero->insertar();
                    }
                    
                    if ($objEmpresa->listar()){
                        echo "Se cargó correctamente😎\n";
                        

                    } else {
                        echo "No se cargó😞\n";
                    }
            } else {
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
                
                    $datosResponsable = ['documento' => '93284673','rnumeroEmpleado' => '7','rnumeroLicencia' => '1','nombre' => 'Homero','apellido' => 'Simpson','ptelefono' => '77'];
                    
                    $datosViaje = ['idViaje' => '2','destino' => 'Cordoba','cantidadMaximaPasajeros' => '100','idEmpresa' => '2','numeroEmpleado' => '7','coleccionPasajeros' => $datosPasajero];
                    
                    $objEmpresa->cargar($datosEmpresa);
                    $objEmpresa->insertar();
            
                    $objResponsable->cargar($datosResponsable);
                    $objResponsable->insertar();
            
                    $objViaje->cargar($datosViaje);
                    $objViaje->insertar();
                    
                    foreach ($datosPasajero as $pasajero) {
                        $objPasajero = new Pasajero();
                        $objPasajero->cargar($pasajero);
                        $objPasajero->insertar();
                    }
                    
                    if ($objEmpresa->listar()){
                        echo "Se cargó correctamente😎\n";
                        

                    } else {
                        echo "No se cargó😞\n";
                    }
            }
            
            do {
                echo "*********************************\n";
                echo "La empresa que esta cargada es:\n". $objEmpresa->listar()[0];
                
                echo "Ingrese el ID del viaje para encontrar sus datos:(2)";
                $idViaje = trim(fgets(STDIN));
                
                menuDatos();
                $opcionDatos = trim(fgets(STDIN));
                switch ($opcionDatos) {

                    case 1: /*carga VIAJE*/
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
                        
                        if($opcionViaje == "1"){
                            echo "1) Eliminar viaje:\n";

                            echo "Para eliminar el viaje ,vamos a tener que borrar el responsable y los pasajeros\n";

                            $objPersona->buscar(93284673);
                            $objPersona->eliminar();

                            foreach ($datosPasajero as $pasajero) {
                                $objPasajero = new Pasajero();
                                $objPasajero->cargar($pasajero);
                                $objPasajero->eliminar();
                            }
                            //$objEmpresa->eliminar();
                            
                            if($objViaje->eliminar()){
                                echo "Se elimino el viaje y el responsable correctamente !!";
                            }else{
                                echo "No se pudo eliminar\n";
                            }
                            
                        }else if($opcionViaje == "2"){
                            echo "2) Modificar viaje:\n";
                            
                            echo "Ingrese el destino del viaje nuevo: ";
                            $destinoNuevo = trim(fgets(STDIN));
                            echo "Ingrese la cantidad maxima de pasajeros nuevo: ";
                            $cantidadMaximaPasajerosNueva = trim(fgets(STDIN));
                            
                            $datosNuevos = ['idViaje'=> $idViaje ,'destino'=>$destinoNuevo, 'cantidadMaximaPasajeros'=> $cantidadMaximaPasajerosNueva, 'idEmpresa' => null, 'numeroEmpleado' =>null, 'coleccionPasajeros' => []];
                            
                            $objViaje->cargar($datosNuevos);
                            $objViaje->modificar();
                        }

                        } while ($opcionViaje != 3);
                        break;

                    case 2: /*Cargar Pasajero*/

                        do {
                            
                            $texto = "-------------------\n";

                            $coleccionPasajeros = $objViaje->mostrarPasajeros();
                            foreach ($coleccionPasajeros as $pasajero) {
                                $texto .= $pasajero . "\n--------------------\n";
                            }
                            echo $texto;
                            
                            menuPasajero();
                            $opcionPasajero = trim(fgets(STDIN));
                            //A B M 

                            if($opcionPasajero == "1"){
                                $objViaje->Buscar($idViaje);
                                echo "1 - Agregar a un pasajero \n";
                                if ($objViaje->cantidadPasajerosActual() < $objViaje->getCantidadMaximaPasajeros()){
                                    echo "Ingrese el nombre del pasajero: ";
                                    $nombrePasajero = trim(fgets(STDIN));
                                    echo "Ingrese el apellido del pasajero: ";
                                    $apellidoPasajero = trim(fgets(STDIN));
                                    echo "Ingrese el documento del pasajero: ";
                                    $documentoPasajero = trim(fgets(STDIN));
                                    echo "Ingrese el telefono del pasajero: ";
                                    $telefonoPasajero = trim(fgets(STDIN));
                                    $datosPasajero = ['nombre' => $nombrePasajero, 'apellido' => $apellidoPasajero, 'documento' => $documentoPasajero, 'ptelefono' => $telefonoPasajero, 'idViaje' => $idViaje];
                                    $objViaje->crearPasajero($datosPasajero);
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
                                    echo "\033[41m No se encontró el DNI del pasajero \n \033[0m";
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
                                    echo "\033[41mNo se encontró el DNI del pasajero\n\033[0m";
                                }
                                echo "\n";  
                            }
                        } while ($opcionResponsable != 2);
                        break;
                }
            } while ($opcionDatos != 4);
            break;
            
///// 

        case 2: //crear viaje desde 0 
            
            /*elimina el viaje el precargado*/
            if ($objEmpresa->listar()){
                if($coleccionPersonas = $objPersona->listar()){
                    foreach ($coleccionPersonas as $persona) {
                        $objPersona->cargar(['nombre'=>'',
                        'apellido' => '',
                        'documento'=> "{$persona->getDocumento()}",
                        'ptelefono'=> "",
                        'idViaje'=> "1"]);
                        $objPersona->eliminar();
                    }
                }

                $objViaje->eliminarViajes();
                $objEmpresa->eliminarEmpresas();

                
                echo "\033[42mSe eliminaron los datos precargados\n\033[0m";
            }
            echo "\033[44m----| LA BASE DE DATOS ESTÁ EN VACÍA |----\033[0m\n";
            
            
            
            echo "CREAMOS LA BASE DE DATOS\n";
            echo "Ingrese el nombre de la empresa:";
            $nombreEmpresa = trim(fgets(STDIN));
            echo "Ingrese el ID de la empresa:";
            $idEmpresa = trim(fgets(STDIN));
            echo "Ingrese la direccion de la empresa:";
            $direccionEmpresa = trim(fgets(STDIN));

            echo "\033[44m----| CARGAMOS EL RESPONSABLE DEL VIAJE: |----\033[0m\n";


            echo "Ingrese su nombre:";
            $nombreResponsable = trim(fgets(STDIN));
            echo "Ingrese su apellido:";
            $apellidoResponsable = trim(fgets(STDIN));
            echo "Ingrese su telefono:";
            $numeroTelefonoResponsable = trim(fgets(STDIN));
            echo "Ingrese su numero documento:";
            $numeroDocumentoResponsable = trim(fgets(STDIN));
            echo "Ingrese su numero empleado:";
            $numeroEmpleadoResponsable = trim(fgets(STDIN));
            echo "Ingrese su numero de licencia:";
            $numeroLicenciaResponsable = trim(fgets(STDIN));

            
            echo "\033[44m----| CARGAMOS EL VIAJE |----\033[0m\n";
            echo "Ingrese su destino:";
            $destinoViaje = trim(fgets(STDIN));
            echo "Ingrese el ID del viaje:";
            $idViaje = trim(fgets(STDIN));
            echo "Ingrese la cantidad maxima de pasajeros:";
            $cantidadMaximaPasajerosViaje = trim(fgets(STDIN));
            echo "Ingrese el ID empresa:\n";
            
            echo "\033[44m----| CARGAMOS EL PASAJERO DEL VIAJE |----\033[0m\n";
            $coleccionPasajeros = [];


                echo "Cuantos pasajeros quiere ingresar ?";
                $cantPasajeros = trim(fgets(STDIN));

                while ($cantPasajeros < 0 || $cantPasajeros > $cantidadMaximaPasajerosViaje){
                    echo "Ingrese un numero valido\n";
                    $cantPasajeros = trim(fgets(STDIN));
                }

                for ($i=0; $i < $cantPasajeros; $i++) {
                    echo "Ingrese su nombre:";
                    $nombrePasajero = trim(fgets(STDIN));
                    echo "Ingrese su apellido:";
                    $apellidoPasajero = trim(fgets(STDIN));
                    echo "Ingrese su telefono:";
                    $numeroTelefonoPasajero = trim(fgets(STDIN));
                    echo "Ingrese su numero documento:";
                    $documentoPasajero = trim(fgets(STDIN));
                    
                    $datosPasajero = ['nombre'=>$nombrePasajero,'apellido'=>$apellidoPasajero,'documento'=>$documentoPasajero,'ptelefono'=>$numeroTelefonoPasajero,'idViaje'=>$idViaje];
                    array_push($coleccionPasajeros, $datosPasajero);
                }

            $datosEmpresa = ['idEmpresa' => $idEmpresa,'enombre' => $nombreEmpresa,'edireccion' => $direccionEmpresa, 'coleccionViajes' => []];
            $datosResponsable = ['documento' => $numeroDocumentoResponsable,'rnumeroEmpleado' => $numeroEmpleadoResponsable,'rnumeroLicencia' => $numeroLicenciaResponsable,'nombre' => $nombreResponsable,'apellido' => $apellidoResponsable,'ptelefono' => $numeroTelefonoResponsable];
            $datosViaje = ['idViaje' => $idViaje,'destino' => $destinoViaje,'cantidadMaximaPasajeros' => $cantidadMaximaPasajerosViaje,'idEmpresa' => $idEmpresa,'numeroEmpleado' => $numeroEmpleadoResponsable,'coleccionPasajeros' => $coleccionPasajeros];
            
            $objEmpresa->cargar($datosEmpresa);
            $objEmpresa->insertar();
            
            $objResponsable->cargar($datosResponsable);
            $objResponsable->insertar();
            
            $objViaje->cargar($datosViaje);
            $objViaje->insertar();
                    
            foreach ($coleccionPasajeros as $pasajero) {
                $objPasajero = new Pasajero();
                $objPasajero->cargar($pasajero);
                $objPasajero->insertar();
            }
                    
            if ($objEmpresa->listar()){
                echo "\033[42mSe cargó correctamente\033[0m\n";
                        

            } else {
                echo "\033[41mNo se cargó\033[0m\n";
            }



            do {
                echo "*********************************\n";
                echo "La empresa que esta cargada es:\n". $objEmpresa->listar()[0];
                
                echo "Ingrese el ID del viaje para encontrar sus datos:";
                $idViaje = trim(fgets(STDIN));
                
                menuDatos();
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
                        
                        if($opcionViaje == "1"){
                            echo "2) Eliminar el viaje:\n";

                            echo "Para eliminar el viaje ,vamos a tener que borrar el responsable y los pasajeros";

                            $objPersona->buscar($numeroDocumentoResponsable);
                            $objPersona->eliminar();

                            $coleccionPasajeros = $objPasajero->listar(" idviaje = '". $idViaje."'") ;

                            foreach ($coleccionPasajeros as $pasajeroUnico) {
                                $objPasajero = new Pasajero();
                                $objPasajero->Buscar($pasajeroUnico->getDocumento());
                                $objPasajero->eliminar();
                            }

                            
                            if($objViaje->eliminar()){
                                echo "\nSe elimino el viaje y el responsable correctamente !!";
                            }else{
                                echo "No se pudo eliminar\n";
                            }
                        }else if($opcionViaje == "2"){
                            echo "2) Modificar viaje:\n";
                            
                            echo "Ingrese el destino del viaje nuevo: ";
                            $destinoNuevo = trim(fgets(STDIN));
                            echo "Ingrese la cantidad maxima de pasajeros nuevo: ";
                            $cantidadMaximaPasajerosNueva = trim(fgets(STDIN));
                            
                            $datosNuevos = ['idViaje'=> $idViaje ,'destino'=>$destinoNuevo, 'cantidadMaximaPasajeros'=> $cantidadMaximaPasajerosNueva, 'idEmpresa' => null, 'numeroEmpleado' =>null, 'coleccionPasajeros' => []];
                            
                            $objViaje->cargar($datosNuevos);
                            $objViaje->modificar();
                        }

                        } while ($opcionViaje != 3);
                        break;

                    case 2: /*Cargar Pasajero*/

                        do {
                            
                            $texto = "-------------------\n";

                            $coleccionPasajeros = $objViaje->mostrarPasajeros();
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
                                    $datosPasajero = ['nombre' => $nombrePasajero, 'apellido' => $apellidoPasajero, 'documento' => $documentoPasajero, 'ptelefono' => $telefonoPasajero, 'idViaje' => $idViaje];
                                    $objViaje->crearPasajero($datosPasajero);
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
                                    echo "No se encontro el DNI del pasajero😪😢\n";
                                }
                                echo "\n";  
                            }
                        } while ($opcionResponsable != 2);
                        break;
                }
            } while ($opcionDatos != 4);
            break;
        case 3:
            echo "Gracias por usar nuestro servicio.\n";
            break;
    }
} while ($opcionPrincipal != 3);

} else {
    echo "Conexion fallida";
}