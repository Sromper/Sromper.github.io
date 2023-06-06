<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require '../conexion.php';
$conn = conexion();

$consulta = $conn->prepare("SELECT * FROM ingredientes");
$consulta->execute();
$ingredientes=$consulta->fetchAll(PDO::FETCH_ASSOC);


echo json_encode($ingredientes);