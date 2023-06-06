<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require '../conexion.php';
$conn = conexion();

$id = $_REQUEST["id"];

$consulta = $conn->prepare("SELECT * FROM paises WHERE id_pais LIKE :id");
$consulta->bindParam(":id", $id);
$consulta->execute();
$paises = $consulta->fetchAll(PDO::FETCH_ASSOC);


echo json_encode($paises);
