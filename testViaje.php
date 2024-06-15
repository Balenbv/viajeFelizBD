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
        echo "MENU PRINCIPAL\n";
        echo "1-Cargar empresa precargada.\n";
        echo "2-Crear una empresa desde 0 (borra viaje precargado).\n";
        echo "3-cerrar programa.\n";
    }
    


function menuDatos(){

        echo "\n************\n";
        echo "MENU DATOS\n";
        echo "1- DATOS VIAJE\n";
        echo "2- DATOS PASAJERO\n";
        echo "3- DATOS RESPONSABLE\n";
        echo "4- VOLVER\n";
}
function menuViaje(){
    echo "MENU VIAJE\n";
    echo "1-Agregar viaje:\n";
    echo "2-Eliminar viaje:\n";
    echo "3-Modificar viaje:\n";
    echo "4-volver\n";
}


function menuResponsable(){
    echo "MENU RESPONSABLE\n";
    echo "1 - Modificar Responsable\n";
    echo "2 - Volver\n";
}

function menuPasajero(){
    echo "MENU PASAJERO\n";
    echo "1 - Agregar pasajeros\n";
    echo "2 - eliminar\n";
    echo "3 - modificar\n";
    echo "4 - volver\n";
}

do {
    menuPrincipal();
    $opcionPrincipal = trim(fgets(STDIN));

    switch ($opcionPrincipal) {
        case 1: //CARGAR EMPRESA RECARGADA
            /*DATOS PRECARGADOS*/
            if ($objEmpresa->listar()){
                echo "ya esta creada la empresa\n";

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
                
                    $datosResonsable = ['documento' => '93284673','rnumeroEmpleado' => '7','rnumeroLicencia' => '1','nombre' => 'Homero','apellido' => 'Simpson','ptelefono' => '77'];
                    
                    $datosViaje = ['idViaje' => '2','destino' => 'Cordoba','cantidadMaximaPasajeros' => '100','idEmpresa' => '2','numeroEmpleado' => '7','coleccionPasajeros' => $datosPasajero];
                    
                    $objEmpresa->cargar($datosEmpresa);
                    $objEmpresa->insertar();
            
                    $objResponsable->cargar($datosResonsable);
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
                
                echo "ingrese el id del viaje para encontrar sus datos\n";
                $idViaje = trim(fgets(STDIN));
                
                menuDatos();
                $opcionDatos = trim(fgets(STDIN));
                switch ($opcionDatos) {

                    case 1: /*carga VIAJE*/
                        do {
                        if($objViaje->Buscar($idViaje)){
                            echo $objViaje->listar()[0];
                        } else{
                            echo "/////////////////////////";
                            echo "\nNo se encontro el viaje\n";
                            echo "/////////////////////////\n";
                        }

                        menuViaje();
                        $opcionViaje = trim(fgets(STDIN));
                        
                        if($opcionViaje = "1"){
                            echo "1-Agregar viaje:\n";

                            echo "Ingrese el destino del viaje: ";
                            $destino = trim(fgets(STDIN));
                            echo "Ingrese la cantidad maxima de pasajeros: ";
                            $cantidadMaximaPasajeros = trim(fgets(STDIN));
                            echo "Cuantos pasajeros va a tener el viaje:";
                            $cantidadPasajeros = trim(fgets(STDIN));
                            while ($cantidadPasajeros > $cantidadMaximaPasajeros){
                                echo "La cantidad de pasajeros que quiere crear excede la capacidad maxima que definio\n"; 
                                echo "Ingrese un valor menor de creacion:";
                                $cantidadPasajeros = trim(fgets(STDIN));
                            }
                            echo "\n";
                            
                        }else if($opcionViaje = "2"){
                            
                            echo "2-Eliminar viaje:\n";
                            echo "Para eliminar el viaje ,vamos a tener que borrar el responsable";
                            $objResponsable->eliminar();
                            if($objViaje->eliminar()){
                                echo "Se elimino el viaje y el responsable correctamente !!";
                            }else{
                                echo "No se pudo eliminar\n";
                            }
                            
                        }else if($opcionViaje = "3"){
                            echo "3-Modificar viaje:\n";
                            echo "Que viaje desea modificar? (ID)";
                            $idViaje = trim(fgets(STDIN));
                            $objViaje->modificar();
                        }

                        } while ($opcionViaje != 4);
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
                        } while ($opcionPasajero != 4);
                        break;
                        
                    case 3:/*Cargar Responsable*/
                        
                        do {
                            if($objViaje->Buscar($idViaje)){
                               echo $objViaje->mostrarResponsable();
                            }
                            $texto = "-------------------\n";
                            $opcionPasajero = trim(fgets(STDIN));
                        } while ($opcionResponsable != 4);
                        break;
                }
            } while ($opcionDatos != 4);
            break;
            
























        case 2: //crear viaje desde 0
            if ($objEmpresa->listar()){
                $coleccionPersonas = $objPersona->listar();

                foreach ($coleccionPersonas as $persona) {
                    $objPersona->cargar(['nombre'=>'leonel',
                    'apellido' => 'messi',
                    'documento'=> "{$persona->getDocumento()}",
                    'ptelefono'=> "1222",
                    'idViaje'=> "1"]);
                    $objPersona->eliminar();
                }
                $objViaje->eliminar();
                $objEmpresa->eliminar();
                echo "Se eliminaron los datos precargados\n";
            } else {

            }

            do {
                menuDatos();
                $opcionDatos = trim(fgets(STDIN));
                switch ($opcionDatos) {
                    case 1: //DATOS VIAJES
                        do {
                            menuViaje();
                            $opcionViaje = trim(fgets(STDIN));
                        } while ($opcionViaje != 4);
                        break;
                    case 2:
                        do {
                            menuPasajero();
                            $opcionPasajero = trim(fgets(STDIN));
                            
                            if($opcionPasajero = "1"){
                                echo "Agregar pasajero:";
                            }else if($opcionPasajero = "2"){
                                echo 'entramos a eliminar';
                            }else{
                                echo 'entramos a modificar23423';
                            }
                            
                            // Aqui se manejarian las acciones para agregar, eliminar o modificar pasajeros
                        } while ($opcionPasajero != 4);
                        break;
                    case 3:
                        
                        do {

                            menuResponsable();
                            $opcionResponsable = trim(fgets(STDIN));
                            // Aqui se manejaria la accion para modificar el responsable
                        } while ($opcionResponsable != 2);
                        break;
                }
            } while ($opcionDatos != 4);
            break;
            
        case 3:
            echo "Cerrando programa...\n";
            break;
    }
} while ($opcionPrincipal != 3);

 /*
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

                

            } else{
                echo "No se pudo iniciar la base de datos\n";
            }
            
  */


  /*
  $opcionMenu = trim(fgets(STDIN));
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
                    break;}*/
} else {
    echo "Conexion fallida";
}