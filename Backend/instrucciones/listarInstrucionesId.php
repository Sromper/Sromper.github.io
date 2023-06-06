<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require "../conexion.php";
$conn = conexion();

$id_receta=$_REQUEST['id_receta'];

$consulta = $conn->prepare("SELECT * FROM instrucciones WHERE id_receta=:id_receta");
$consulta->bindParam(':id_receta', $id_receta);
$consulta->execute();
$resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($resultado);
