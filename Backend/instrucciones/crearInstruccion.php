<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: Content-Type");

require "../conexion.php";
$conn = conexion();

$instruccion = $_REQUEST['instruccion'];
$id_receta = $_REQUEST['id_receta'];

$consulta = $conn->prepare("INSERT INTO instrucciones (instruccion,id_receta) VALUES (:instruccion,:id_receta)");
$consulta->bindParam(':instruccion', $instruccion);
$consulta->bindParam(':id_receta', $id_receta);
$resultado = $consulta->execute();

if ($resultado) {
    echo json_encode("Instruccion creada");
} else {
    echo json_encode("Instruccion no creada");
}
