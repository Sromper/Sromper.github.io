<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require '../conexion.php';
$conn = conexion();

$id_receta = $_REQUEST["id_receta"];

$consulta = $conn->prepare("UPDATE recetas SET publicada = 1 WHERE id = :id");
$consulta->bindParam(":id", $id_receta);
$resultado = $consulta->execute();
if ($resultado) {
    echo "Receta publicada";
}
