<?php

include_once 'bdViajeFeliz.php';
include_once 'Viaje.php';
include_once 'persona.php';
include_once 'ResponsableV.php';
include_once 'Pasajero.php';
include_once 'Empresa.php';


/** Persona(nrodoc, apellido, nombre, telefono)  */
/*VIAJE(idviaje,vdestino,vcantmaxpasajeros,idempresa,rnumeroempleado,vimporte,)*/
$bd = new bdViajeFeliz();
$objPersona = new Persona();
//CREACION EMPRESA

$objEmpresa = new Empresa();
$datosEmpresa = [
    'idEmpresa'=>1,
    'enombre'=>'empresa1',
    'edireccion'=>'Lagos del Rios'
];
    
if($bd->iniciar()){
    $objEmpresa->cargar($datosEmpresa);
    $objEmpresa->insertar();
    $objEmpresa->listar();
} else {
    echo "Conexion fallida";
}


//CREACION RESPONSABLE

$objResponsable = new ResponsableV();
$datosResponsable = ['documento'=>'93284672',
                     'rnumeroEmpleado' => 3,
                     'rnumeroLicencia' =>1,
                     'nombre' => 'homero',
                     'apellido' => 'simpson',
                     'ptelefono' =>77];

if($bd->iniciar()){
    $objResponsable->cargar($datosResponsable);
    $objResponsable->insertar();
    $objResponsable->listar();
} else {
    echo "Conexion fallida";
}

//CREACION VIAJE
$objViaje = new Viaje();
$datosViaje = ['idViaje' => 1,
               'destino' => 'Cordoba',
               'cantidadMaximaPasajeros' => 10,
               'idEmpresa' => 1,
               'numeroEmpleado' => 3 ,
               'importe' => 100.34,
               'mensajeoperacion' => null];

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
    $objPasajero->modificar();
    $objPasajero->listar();
} else {
    echo "Conexion fallida";
}

echo 'ingrese 1 para eliminar todo';
$opcion = trim(fgets(STDIN));

if ($opcion == 1) {
    
    for ($i = 1; $i <= 10; $i++) {
        $objPersona->cargar(['nombre'=>'leonel',
        'apellido' => 'messi',
        'documento'=> "$i",
        'ptelefono'=> 1222,
        'idViaje'=> 1]);
        $objPasajero->cargar($datosPasajero);
        $objPersona->eliminar();
    }
    $objViaje->eliminar();
    $objEmpresa->eliminar();
    $objResponsable->eliminar();
}else{
    echo "todo piola";
}