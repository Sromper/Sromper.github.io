<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require '../conexion.php';
$conn = conexion();

$consulta = $conn->prepare("SELECT r.*, p.nombre AS nombre_pais, u.nombre_usuario FROM recetas r INNER JOIN paises p ON r.id_pais = p.id_pais INNER JOIN usuarios u ON r.id_usuario = u.id");

$consulta->execute();
$recetas=$consulta->fetchAll(PDO::FETCH_ASSOC);


echo json_encode($recetas);