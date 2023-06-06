<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require '../conexion.php';
$conn = conexion();

$consulta = $conn->prepare("SELECT * FROM paises");
$consulta->execute();
$paises=$consulta->fetchAll(PDO::FETCH_ASSOC);


echo json_encode($paises);
