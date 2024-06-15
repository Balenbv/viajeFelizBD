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
    echo "1-Eliminar viaje:\n";
    echo "2-Modificar viaje:\n";
    echo "3-volver\n";
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
                
                echo "ingrese el id del viaje para encontrar sus datos:";
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
                        
                        if($opcionViaje == "1"){
                            echo "2-Eliminar viaje:\n";

                            echo "Para eliminar el viaje ,vamos a tener que borrar el responsable";
                            $objResponsable->eliminar();
                            if($objViaje->eliminar()){
                                echo "Se elimino el viaje y el responsable correctamente !!";
                            }else{
                                echo "No se pudo eliminar\n";
                            }
                            
                        }else if($opcionViaje == "2"){
                            echo "2-Modificar viaje:\n";
                            
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
                                echo "2- eliminar pasajero\n";
                                echo "Ingrese el DNI del pasajero que quiere eliminar\n";
                                $dniPasajero = trim(fgets(STDIN));
                                $objPasajero->Buscar($dniPasajero);
                                $objPasajero->eliminar();
                                
                            }else if($opcionPasajero == "3"){
                                echo "3- modificar pasajero:\n";
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
                                    echo "No se encontro el DNI del pasajero😪\n";
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
                if ($objViaje->listar()){
                    $objViaje->eliminar();
                }

                $objEmpresa->eliminar();
                echo "Se eliminaron los datos precargados\n";
            } else {
                echo "Conexion invalida";
            }
            echo "----| LA BASE DE DATOS ESTA EN VACIA |----\n";
            
            echo "CREAMOS LA BASE DE DATOS\n";
            echo "Ingrese el nombre de la empresa \n";
            $nombreEmpresa = trim(fgets(STDIN));
            echo "Ingrese el id de la empresa \n";
            $idEmpresa = trim(fgets(STDIN));
            echo "Ingrese la direccion de la empresa \n";
            $direccionEmpresa = trim(fgets(STDIN));

            
            
            echo "-------| CARGAMOS EL RESPONSABLE DEL VIAJE: |-------\n";
            echo "Ingrese su nombre\n";
            $nombreResponsable = trim(fgets(STDIN));
            echo "Ingrese su apellido\n";
            $apellidoResponsable = trim(fgets(STDIN));
            echo "Ingrese su telefono\n";
            $numeroTelefonoResponsable = trim(fgets(STDIN));
            echo "Ingrese su numero documento\n";
            $numeroDocumentoResponsable = trim(fgets(STDIN));
            echo "Ingrese su numero empleado\n";
            $numeroEmpleadoResponsable = trim(fgets(STDIN));
            echo "Ingrese su numero de licencia\n";
            $numeroLicenciaResponsable = trim(fgets(STDIN));

            
            echo "----- CARGAMOS EL VIAJE -----\n";
            echo "Ingrese su destino \n";
            $destinoViaje = trim(fgets(STDIN));
            echo "Ingrese su ID \n";
            $idViaje = trim(fgets(STDIN));
            echo "Ingrese su cantidad maxima de pasajeros \n";
            $cantidadMaximaPasajerosViaje = trim(fgets(STDIN));
            echo "Ingrese su id empresa \n";
            $idEmpresaViaje = trim(fgets(STDIN));
            
            
            echo " CARGAMOS EL PASAJERO DEL VIAJE:\n";
            $coleccionPasajeros = [];
            
            for ($i=0; $i < $cantidadMaximaPasajerosViaje; $i++) {
                echo "Ingrese su nombre\n";
                $nombrePasajero = trim(fgets(STDIN));
                echo "Ingrese su apellido\n";
                $apellidoPasajero = trim(fgets(STDIN));
                echo "Ingrese su telefono\n";
                $numeroTelefonoPasajero = trim(fgets(STDIN));
                echo "Ingrese su numero documento\n";
                $documentoPasajero = trim(fgets(STDIN));
                
                $datosPasajero = ['nombre'=>$nombrePasajero,'apellido'=>$apellidoPasajero,'documento'=>$documentoPasajero,'ptelefono'=>$numeroTelefonoPasajero,'idViaje'=>$idViaje];
                array_push($coleccionPasajeros, $datosPasajero);
            }
            
            $datosEmpresa = ['idEmpresa' => $idEmpresa,'enombre' => $nombreEmpresa,'edireccion' => $direccionEmpresa, 'coleccionViajes' => []];
            $datosResponsable = ['documento' => $numeroDocumentoResponsable,'rnumeroEmpleado' => $numeroEmpleadoResponsable,'rnumeroLicencia' => $numeroLicenciaResponsable,'nombre' => $nombreResponsable,'apellido' => $apellidoResponsable,'ptelefono' => $numeroTelefonoResponsable];
            $datosViaje = ['idViaje' => $idViaje,'destino' => $destinoViaje,'cantidadMaximaPasajeros' => $cantidadMaximaPasajerosViaje,'idEmpresa' => $idEmpresaViaje,'numeroEmpleado' => $numeroEmpleadoResponsable,'coleccionPasajeros' => $coleccionPasajeros];
            
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
                echo "Se cargó correctamente😎\n";
                        

            } else {
                echo "No se cargó😞\n";
            }



            // do {
            //     echo "*********************************\n";
            //     echo "La empresa que esta cargada es:\n". $objEmpresa->listar()[0];
                
            //     echo "ingrese el id del viaje para encontrar sus datos:";
            //     $idViaje = trim(fgets(STDIN));
                
            //     menuDatos();
            //     $opcionDatos = trim(fgets(STDIN));
            //     switch ($opcionDatos) {

            //         case 1: /*carga VIAJE*/
            //             do {
            //             if($objViaje->Buscar($idViaje)){
            //                 echo $objViaje->listar()[0];
            //             } else{
            //                 echo "/////////////////////////";
            //                 echo "\nNo se encontro el viaje\n";
            //                 echo "/////////////////////////\n";
            //             }

            //             menuViaje();
            //             $opcionViaje = trim(fgets(STDIN));
                        
            //             if($opcionViaje == "1"){
            //                 echo "2-Eliminar viaje:\n";

            //                 echo "Para eliminar el viaje ,vamos a tener que borrar el responsable";
            //                 $objResponsable->eliminar();
            //                 if($objViaje->eliminar()){
            //                     echo "Se elimino el viaje y el responsable correctamente !!";
            //                 }else{
            //                     echo "No se pudo eliminar\n";
            //                 }
                            
            //             }else if($opcionViaje == "2"){
            //                 echo "2-Modificar viaje:\n";
                            
            //                 echo "Ingrese el destino del viaje nuevo: ";
            //                 $destinoNuevo = trim(fgets(STDIN));
            //                 echo "Ingrese la cantidad maxima de pasajeros nuevo: ";
            //                 $cantidadMaximaPasajerosNueva = trim(fgets(STDIN));
                            
            //                 $datosNuevos = ['idViaje'=> $idViaje ,'destino'=>$destinoNuevo, 'cantidadMaximaPasajeros'=> $cantidadMaximaPasajerosNueva, 'idEmpresa' => null, 'numeroEmpleado' =>null, 'coleccionPasajeros' => []];
                            
            //                 $objViaje->cargar($datosNuevos);
            //                 $objViaje->modificar();
            //             }

            //             } while ($opcionViaje != 3);
            //             break;

            //         case 2: /*Cargar Pasajero*/

            //             do {
                            
            //                 $texto = "-------------------\n";

            //                 $coleccionPasajeros = $objViaje->mostrarPasajeros();
            //                 foreach ($coleccionPasajeros as $pasajero) {
            //                     $texto .= $pasajero . "\n--------------------\n";
            //                 }
            //                 echo $texto;
                            
            //                 menuPasajero();
            //                 $opcionPasajero = trim(fgets(STDIN));
            //                 //A B M 

            //                 if($opcionPasajero == "1"){
            //                     $objViaje->Buscar($idViaje);
            //                     echo "1 - Agregar a un pasajero \n";
            //                     if ($objViaje->cantidadPasajerosActual() < $objViaje->getCantidadMaximaPasajeros()){
            //                         echo "Ingrese el nombre del pasajero: ";
            //                         $nombrePasajero = trim(fgets(STDIN));
            //                         echo "Ingrese el apellido del pasajero: ";
            //                         $apellidoPasajero = trim(fgets(STDIN));
            //                         echo "Ingrese el documento del pasajero: ";
            //                         $documentoPasajero = trim(fgets(STDIN));
            //                         echo "Ingrese el telefono del pasajero: ";
            //                         $telefonoPasajero = trim(fgets(STDIN));
            //                         $datosPasajero = ['nombre' => $nombrePasajero, 'apellido' => $apellidoPasajero, 'documento' => $documentoPasajero, 'ptelefono' => $telefonoPasajero, 'idViaje' => $idViaje];
            //                         $objViaje->crearPasajero($datosPasajero);
            //                     } else {
            //                         echo "No se pueden agregar mas pasajeros\n";
            //                     }
                                
            //                 }else if($opcionPasajero == "2"){
            //                     echo "2- eliminar pasajero\n";
            //                     echo "Ingrese el DNI del pasajero que quiere eliminar\n";
            //                     $dniPasajero = trim(fgets(STDIN));
            //                     $objPasajero->Buscar($dniPasajero);
            //                     $objPasajero->eliminar();
                                
            //                 }else if($opcionPasajero == "3"){
            //                     echo "3- modificar pasajero:\n";
            //                     echo "Ingrese el DNI del pasajero que quiera modificar:";
            //                     $dniPasajero = trim(fgets(STDIN));

            //                     if($objPersona->buscar($dniPasajero)){
            //                         echo "Ingrese el nuevo nombre:";
            //                         $nuevoNombre = trim(fgets(STDIN));
            //                         echo "Ingrese el nuevo apellido:";
            //                         $nuevoApellido = trim(fgets(STDIN));
            //                         echo "Ingrese el nuevo numero de telefono:";
            //                         $nuevoNumTelefono = trim(fgets(STDIN));
            //                         $datosPersona = ['nombre' => $nuevoNombre, 'apellido' => $nuevoApellido, 'documento' => $dniPasajero, 'ptelefono' => $nuevoNumTelefono, 'idViaje' => $idViaje];
                                    
            //                         $objPersona->cargar($datosPersona);
            //                         $objPersona->modificar();
            //                     }else{
            //                         echo "No se encontro el DNI del pasajero😪\n";
            //                     }
            //                 }

            //             } while ($opcionPasajero != 4);
            //             break;
                        
            //         case 3:/*Cargar Responsable*/
            //             do {
                            
            //                 if($objViaje->Buscar($idViaje)){
            //                     echo $objViaje->mostrarResponsable();
            //                 }
            //                 echo "\n-------------------\n";

            //                 menuResponsable();
            //                 $opcionResponsable = trim(fgets(STDIN));      
                    
            //                 if($opcionResponsable == 1){
            //                     echo "Modificar Responsable\n";
            //                     echo "Ingrese el DNI del responsable que quiere modificar:";
            //                     $dniPersona = trim(fgets(STDIN));
                                
            //                     if($objPersona->buscar($dniPersona)){
                                    
            //                         echo "Ingrese el nuevo nombre:";
            //                         $nuevoNombre = trim(fgets(STDIN));
            //                         echo "Ingrese el nuevo apellido:";
            //                         $nuevoApellido = trim(fgets(STDIN));
            //                         echo "Ingrese el nuevo numero de telefono:";
            //                         $nuevoNumTelefono = trim(fgets(STDIN));
            //                         echo "Ingrese el numero de licencia nuevo:";
            //                         $nuevaLicencia = trim(fgets(STDIN));
                                    
            //                         $datosPersona = ['nombre' => $nuevoNombre, 'apellido' => $nuevoApellido, 'documento' => $dniPersona, 'ptelefono' => $nuevoNumTelefono, 'rnumeroLicencia' => $nuevaLicencia, 'rnumeroEmpleado' => null];
                                    
            //                         $objResponsable->cargar($datosPersona);
            //                         $objResponsable->modificar();
            //                     }else{
            //                         echo "No se encontro el DNI del pasajero😪😢\n";
            //                     }
            //                     echo "\n";  
            //                 }
            //             } while ($opcionResponsable != 2);
            //             break;
            //     }
            // } while ($opcionDatos != 4);
            // break;
                    







































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

} else {
    echo "Conexion fallida";
}