<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Content-Type");
require "../conexion.php";
$conn = conexion();

$id_instruccion = $_REQUEST['id_instruccion'];


$consulta = $conn->prepare("DELETE FROM instrucciones WHERE id_instruccion = :id_instruccion");
$consulta->bindParam(':id_instruccion', $id_instruccion);
$resultado = $consulta->execute();

if ($resultado) {
    echo json_encode("Instruccion Borrada");
} else {
    echo json_encode("Instruccion no Borrada");
}



?> 

