<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require '../conexion.php';
$conn = conexion();

$nombre = $_REQUEST['nombre'];


$consulta_existencia = $conn->prepare("SELECT COUNT(*) FROM paises WHERE nombre = :nombre");
$consulta_existencia->bindParam(':nombre', $nombre);
$consulta_existencia->execute();

if ($consulta_existencia->fetchColumn() > 0) {
   
    $respuesta = array(
        'exito' => false,
        'mensaje' => 'El país ya se encuentra registrado'
    );
} else {

    $consulta = $conn->prepare("INSERT INTO paises (nombre) VALUES (:nombre)");
    $consulta->bindParam(':nombre', $nombre);

    $exito = $consulta->execute();

    if ($exito) {
        $respuesta = array(
            'exito' => true,
            'mensaje' => 'País agregado exitosamente'
        );
    } else {
        $respuesta = array(
            'exito' => false,
            'mensaje' => 'Error al agregar el país. Inténtalo de nuevo más tarde.'
        );
    }
}

echo json_encode($respuesta);
