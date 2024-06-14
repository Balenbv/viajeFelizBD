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
        1 => "crear una empresa desde O",
        2 => "ver datos actuales de la empresa",
        3 => "modificar datos de la empresa",
        4 => 'salir'];
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
                $nombre = trim(fgets(STDIN));
                echo "Ingrese la direccion de la empresa: ";
                $direccion = trim(fgets(STDIN));
                $objEmpresa->cargar(['enombre' => $nombre, 'edireccion' => $direccion, 'idEmpresa' => 1]);
                $objEmpresa->insertar();
                
                echo "\n";
                echo "CREACION DE LOS DATOS DE RESPONSABLE\n";
                echo "ingrese el nombre del responsable:";
                $nombreR = trim(fgets(STDIN));
                echo "ingrese el apellido del responsable:";
                $apellidoR = trim(fgets(STDIN));
                echo "ingrese el numero de telefono del responsable:";
                $ptelefonoR = trim(fgets(STDIN));
                echo "ingrese el numero de documento del responsable:";
                $documentoR = trim(fgets(STDIN));
                echo "Ingrese el numero de empleado: ";
                $numeroEmpleadoR = trim(fgets(STDIN));
                echo "Ingrese el numero de licencia: ";
                $numeroLicenciaR = trim(fgets(STDIN));

                $datos=['rnumeroEmpleado' => $numeroEmpleadoR, 'rnumeroLicencia' => $numeroLicenciaR, 'documento' => $documentoR, 'nombre' => $nombreR, 'apellido' => $apellidoR, 'ptelefono' => $ptelefonoR];
                
                $objViaje->crearResponsableV($datos);

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
                echo "CREACION DE LOS DATOS DE VIAJE:\n";

                $objEmpresa->crearViaje(['idViaje' => $idViajeP, 'destino' => $destino, 'cantidadMaximaPasajeros' => $cantidadMaximaPasajeros, 'idEmpresa' => 1, 'numeroEmpleado' => $numeroEmpleadoR, 'coleccionPasajeros' => []]);
                
                for ($i=0; $i < $cantidadPasajeros; $i++) {
                    echo "Ingrese el nombre del pasajero: ";
                    $nombreP = trim(fgets(STDIN));
                    echo "Ingrese el apellido del pasajero: ";
                    $apellidoP = trim(fgets(STDIN));
                    echo "Ingrese el documento del pasajero: ";
                    $documentoP = trim(fgets(STDIN));
                    echo "Ingrese el telefono del pasajero: ";
                    $telefonoP = trim(fgets(STDIN));

                    $datos = ['documento' => $documentoP, 'nombre' => $nombreP, 'apellido' => $apellidoP, 'ptelefono' => $telefonoP, 'idViaje' => $idViajeP];
                    $objViaje->crearPasajero($datos);
                }

                echo $objEmpresa;

            } else{
                echo "No se pudo iniciar la base de datos\n";
            }
            
            break;

        case 2:

            echo menuMostrarDatosEmpresa();
            $opcionMostrar = trim(fgets(STDIN));
            switch ($opcionMostrar) {
                case 1:
                    echo "Los datos de viaje son:";
                    $objViaje->listar();
                    break;
                case 2:
                    echo "Los datos del responsable son :";
                    $objViaje-mostrarResponsable();
                    break;
                case 3:
                    echo "Los datos de los pasajero son: ";
                    $objViaje->mostrarPasajero();
                    break;
                case 4:
                    echo "Los datos de la empresa son :";
                    $objEmpresa->listar();
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
                    echo "Modificar el viaje:";
                    $objViaje->modificar();
                    break;
                case 2:
                    echo "Modificar el responsable:\n";
                    echo "Ingrese el nombre nuevo:\n";
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
                    echo "Modificar la empresa:";
                    $objEmpresa->modificar();
                    break;
            }
            break;
    }
    
} while ($opcion != 4);