<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require '../conexion.php';
$conn = conexion();
$id=$_REQUEST["id"];
$consulta = $conn->prepare("SELECT * FROM recetas_ingredientes WHERE id_receta LIKE :id");
$consulta->bindParam(":id",$id);
$consulta->execute();
$ingredientes=$consulta->fetchAll(PDO::FETCH_ASSOC);


echo json_encode($ingredientes);