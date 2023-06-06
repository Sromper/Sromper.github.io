<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require "conexion.php";
$conn = conexion();

$consulta = $conn->prepare('SELECT * FROM imagen');
// Ejecutar la consulta
$consulta->execute();
$imagenes = $consulta->fetchAll(PDO::FETCH_ASSOC);

// Convertir los datos binarios de las imágenes a base64

$imagenes[0]['imgs'] = base64_encode($imagenes[0]['imgs']);


echo json_encode($imagenes);
