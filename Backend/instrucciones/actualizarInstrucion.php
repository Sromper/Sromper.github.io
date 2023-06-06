<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: Content-Type");
require "../conexion.php";
$conn = conexion();

$id_receta = $_REQUEST['id_receta'];
$id_instruccion = $_REQUEST['id_instruccion'];
$instruccion=$_REQUEST['instruccion'];



$consulta = $conn->prepare("UPDATE instrucciones SET instruccion=:instruccion WHERE id_instruccion=:id_instruccion AND id_receta=:id_receta");
$consulta->bindParam(':id_receta', $id_receta);
$consulta->bindParam(':id_instruccion', $id_instruccion);
$consulta->bindParam(':instruccion', $instruccion);
$resultado = $consulta->execute();

if ($resultado) {
    echo json_encode("Instruccion actualizada");
} else {
    echo json_encode("Instruccion no actualizada");
}

?> 
