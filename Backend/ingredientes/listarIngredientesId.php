<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require '../conexion.php';
$conn = conexion();

$id=$_REQUEST["id_receta"];

$consulta = $conn->prepare("SELECT ri.* , i.* FROM ingredientes i, recetas_ingredientes ri WHERE i.id_ingrediente=ri.id_ingrediente AND ri.id_receta=:id");
$consulta->bindParam(':id',$id);
$consulta->execute();
$ingredientes=$consulta->fetchAll(PDO::FETCH_ASSOC);


echo json_encode($ingredientes);