<?php
include 'bdViajeFeliz.php'; 
include 'Empresa.php';
include 'Viaje.php'; 
include 'Persona.php';
include 'ResponsableV.php';
include 'Pasajero.php';


    function menuModificarDatosEmpresa(){
    $array = [
        1 => "modificar el viaje",
        2 => "modificar el reponsable",
        3 => "modificar el pasajeros ",
        4 => "modificar la empresa"];
        
        $mostrar = "Elija una opcion: \n";
        
        foreach($array as $indexado => $opcion){
        $mostrar .= $indexado . ") " .$opcion . "\n";
    }
    return $mostrar;
    }

    function menuMostrarDatosEmpresa(){
        $array = [
            1 => "datos de el viaje",
            2 => "datos de el reponsable",
            3 => "datos de el pasajeros ",
            4 => "datos de la empresa"];
            
            $mostrar = "Elija una opcion: \n";
            
            foreach($array as $indexado => $opcion){
            $mostrar .= $indexado . ") " .$opcion . "\n";
        }
        return $mostrar;
    }

    function menuPrincipal(){
    
    $array = [
        1 => "crear una empresa desde O",
        2 => "ver datos actuales de la empresa",
        3 => "salir"];
    $mostrar = "Elija una opcion: \n";
    
    foreach($array as $indexado => $opcion){
        $mostrar .= $indexado . ") " .$opcion . "\n";
    }
    return $mostrar;
}

function menuPrincipalAvanzado(){
    
    $array = [
        1 => "crear una empresa desde O:",
        2 => "ver datos actuales de la empresa:",
        3 => "modificar datos de la empresa:",
        4 => "eliminar los datos de la empresa:",
        5 =>'salir:'];
    $mostrar = "Elija una opcion: \n";
    
    foreach($array as $indexado => $opcion){
        $mostrar .= $indexado . ") " .$opcion . "\n";
    }
    return $mostrar;
}

do{
    echo menuPrincipal();
    $opcion = trim(fgets(STDIN));
    /*1 => "crear una empresa desde O",
      2 => "ver datos actuales de la empresa",
      3 => "salir
    */
    switch ($opcion) {
        /*1 => "crear una empresa desde O*/
        case 1:

            echo "Vamos a crear una empresa con todos sus datos desde 0\n";
            $bd = new bdViajeFeliz();
            $objEmpresa = new Empresa();
            $objPasajero = new Pasajero();
            $objResponsable = new ResponsableV();
            $objViaje = new Viaje();
            if ($bd->iniciar()){
                
                echo "CREACION DE LOS DATOS DE LA EMPRESA :\n";
                
                echo "Ingrese el nombre de la empresa: ";
                $nombreEmpresa = trim(fgets(STDIN));
                echo "Ingrese la direccion de la empresa: ";
                $direccionEmpresa = trim(fgets(STDIN));
                echo "Ingrese el id de la empresa: ";
                $idEmpresa = trim(fgets(STDIN));

                echo "\n";

                echo "CREACION DE LOS DATOS DE RESPONSABLE\n";
                echo "ingrese el nombre del responsable:";
                $nombreResponsable = trim(fgets(STDIN));
                echo "ingrese el apellido del responsable:";
                $apellidoResponsable = trim(fgets(STDIN));
                echo "ingrese el numero de telefono del responsable:";
                $ptelefonoResponsable = trim(fgets(STDIN));
                echo "ingrese el numero de documento del responsable:";
                $documentoResponsable = trim(fgets(STDIN));
                echo "Ingrese el numero de empleado: ";
                $numeroEmpleadoResponsable = trim(fgets(STDIN));
                echo "Ingrese el numero de licencia: ";
                $numeroLicenciaResponsable = trim(fgets(STDIN));

                echo "\n";

                echo "CREACION DE LOS DATOS DE VIAJE:\n";
                echo "Ingrese el destino del viaje: ";
                $destino = trim(fgets(STDIN));
                echo "Ingrese la cantidad maxima de pasajeros: ";
                $cantidadMaximaPasajeros = trim(fgets(STDIN));
                echo "Cuantos pasajeros va a tener el viaje:";
                $cantidadPasajeros = trim(fgets(STDIN));
                while ($cantidadPasajeros > $cantidadMaximaPasajeros) {
                    echo "La cantidad de pasajeros que quiere crear excede la capacidad maxima que definio\n"; 
                    echo "Ingrese un valor menor de creacion:";
                    $cantidadPasajeros = trim(fgets(STDIN));
                }
                echo "Ingrese el id del viaje:";
                $idViajeP = trim(fgets(STDIN));

                echo "\n";

                echo "CREACION DE LOS DATOS DE LOS PASAJEROS:\n";
                $coleccionPasajeros = [];
                for ($i=0; $i < $cantidadPasajeros; $i++) {
                    echo "Ingrese el nombre del pasajero: ";
                    $nombrePasajero = trim(fgets(STDIN));
                    echo "Ingrese el apellido del pasajero: ";
                    $apellidoPasajero = trim(fgets(STDIN));
                    echo "Ingrese el documento del pasajero: ";
                    $documentoPasajero = trim(fgets(STDIN));
                    echo "Ingrese el telefono del pasajero: ";
                    $telefonoPasajero = trim(fgets(STDIN));
                    $datos = ['documento' => $documentoPasajero, 'nombre' => $nombrePasajero, 'apellido' => $apellidoPasajero, 'ptelefono' => $telefonoPasajero, 'idViaje' => $idViajeP];
                    array_push($coleccionPasajeros, $datos);
                }
                
                $datosResponsable = ['nombre' => $nombreResponsable, 'apellido' => $apellidoResponsable, 'documento' => $documentoResponsable, 'ptelefono' => $ptelefonoResponsable, 'rnumeroEmpleado' => $numeroEmpleadoResponsable, 'rnumeroLicencia' => $numeroLicenciaResponsable];
                $datosViaje = ['idViaje' => $idViajeP, 'destino' => $destino, 'cantidadMaximaPasajeros' => $cantidadMaximaPasajeros, 'idEmpresa' => 1,'numeroEmpleado' => $numeroEmpleadoResponsable, 'coleccionPasajeros' => $coleccionPasajeros, 'coleccionViajes' => [] ];
                $datosEmpresa = ['enombre' => $nombreEmpresa, 'edireccion' => $direccionEmpresa, 'idEmpresa' => $idEmpresa, 'coleccionViajes' => []];
                $objResponsable->cargar($datosResponsable);
                $objResponsable->insertar();
                $objEmpresa->cargar($datosEmpresa);
                $objEmpresa->insertar();
                $objEmpresa->crearViaje($datosViaje);
                foreach ($coleccionPasajeros as $pasajero) {
                    $objViaje->crearPasajero($pasajero);
                }
                echo $objEmpresa;
               

            } else{
                echo "No se pudo iniciar la base de datos\n";
            }
            
            break;

        case 2:

            echo menuMostrarDatosEmpresa();
            $opcionMostrar = trim(fgets(STDIN));
            $objViaje = new Viaje ();
            
            switch ($opcionMostrar) {
                case 1:
                    $bd = new bdViajeFeliz();
                    if ($bd->iniciar()){
                        $lista_viajes = $objViaje->listar();
                    
                    if ($lista_viajes > 0) { 
                        foreach ($lista_viajes as $viaje) {      
                            echo $viaje . "\n";
                        }
                    } else {
                        echo 'ERROR';
                    }
                    }
                        
                    break;
                case 2:
                    $bd = new bdViajeFeliz();
                    echo "Los datos del responsable son:\n";
                    if ($bd->iniciar()){
                        $objViaje = new Viaje();
                        $objViaje->cargar($datos);
                        $objResponsable = $objViaje->mostrarResponsable();

                    } else {
                        echo 'ERROR';
                    }
                    break;
                case 3:
                    echo "Los datos de los pasajero son: \n";
                    $pasajeros = $objViaje->mostrarPasajeros();
                    if ($pasajeros > 0){
                        foreach ($pasajeros as $p){
                            echo $p ."\n";
                        }
                    }
                    break;
                case 4:
                    $bd = new bdViajeFeliz();
                    if ($bd->iniciar()){
                        $objEmpresa = new Empresa();
                        echo 'Que viaje quieres ver?(ID)';
                        $idViaje = trim(fgets(STDIN));
                        
                       if($objEmpresa->getColeccionViajes()[0]->buscar($idViaje)){
                        $objViaje = new Viaje();
                        $objEmpresa->getColeccionViajes()[0]->mostrarResponsable();
                       }
                           
                        
                            
                        
                        echo "Los datos de la empresa son:\n";
                       
                        $colEmpresas = $objEmpresa->listar(); 
                        if ($colEmpresas > 0){
                            foreach ($colEmpresas as $e){
                                echo $e . "\n";
                            }
                        }
                    } else {
                        echo 'ERROR';
                    }
                    break;
            }
            break;

        case 3:
            echo menuModificarDatosEmpresa();
            /*
                    1 => "modificar el viaje",
                    2 => "modificar el reponsable",
                    3 => "modificar el pasajeros ",
                    4 => "modificar la empresa"];
            */
            $opcionMod = trim(fgets(STDIN));
            switch ($opcionMod) {
                case 1:
                    echo "Modificar el viaje:\n";
                    $idViajeM = trim(fgets(STDIN)); 
                    echo "Ingrese el nombre nuevo:\n";
                    $nombreM = trim(fgets(STDIN)); 
                    echo "ingrese el id del viaje:\n";
                    $idViajeM = trim(fgets(STDIN)); 
                    echo "ingrese el nuevo destino:\n";
                    $destinoM = trim(fgets(STDIN)); 
                    echo "ingrese la nueva capacidad maxima del pasajero:\n";
                    echo "ingrese el id de la empresa:\n";
                    echo "ingrese el numero empleado:\n";
                    echo "ingrese el pasajero que que quiera modificar:\n";
                    break;
                case 2:
                    $nombrePMod = trim(fgets(STDIN)); 
                    echo "Ingrese el apellido nuevo:\n";
                    $apellidoPMod = trim(fgets(STDIN)); 
                    echo "Ingrese el documento nuevo:\n";
                    $documentoPMod = trim(fgets(STDIN)); 
                    echo "Ingrese el telefono nuevo:\n";
                    $telefonoPMod = trim(fgets(STDIN)); 

                    $objViaje->modificarResponsable($datos);
                    break;
                case 3:
                    echo "Ingrese el nombre nuevo:\n";
                    $nombrePMod = trim(fgets(STDIN)); 
                    echo "Ingrese el apellido nuevo:\n";
                    $apellidoPMod = trim(fgets(STDIN)); 
                    echo "Ingrese el documento nuevo:\n";
                    $documentoPMod = trim(fgets(STDIN)); 
                    echo "Ingrese el telefono nuevo:\n";
                    $telefonoPMod = trim(fgets(STDIN)); 

                    $objViaje->modificarPasajero($datos);
                    break;
                case 4:
                    echo "Modificar la empresa:\n";
                    
                    echo "Ingrese el nuevo nombre:\n";
                    $nombrePMod = trim(fgets(STDIN)); 
                    echo "Ingrese la nueva direccion:\n";
                    $apellidoPMod = trim(fgets(STDIN)); 
                    echo "Ingrese el ID de el/los viajes:\n";
                    $documentoPMod = trim(fgets(STDIN)); 

                    $objEmpresa->modificar();
                    break;
            }
            break;
    }
    
 } while ($opcion != 5);