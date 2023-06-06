<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require '../conexion.php';
$conn = conexion();

$nombre = $_REQUEST["nombre"];

$consulta = $conn->prepare("INSERT INTO categorias VALUES :nombre");
$consulta->bindParam(":nombre", $nombre);
$resultado = $consulta->execute();

if ($resultado) {
    $respuesta = array(
        'exito' => true,
        'mensaje' => 'Creado exitosamente'
    );
} else {
    $respuesta = array(
        'exito' => false,
        'mensaje' => 'Error al crear'
    );
}
echo json_encode($respuesta);
