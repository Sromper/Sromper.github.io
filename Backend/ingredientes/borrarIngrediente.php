<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require '../conexion.php';
$conn = conexion();

$id_receta = $_REQUEST['id_receta'];
$id_ingrediente = $_REQUEST['id_ingrediente'];


$consulta = $conn->prepare("DELETE FROM recetas_ingredientes WHERE id_receta = :id_receta AND id_ingrediente = :id_ingrediente");
$consulta->bindParam(':id_receta', $id_receta);
$consulta->bindParam(':id_ingrediente', $id_ingrediente);
$resultado=$consulta->execute();

if ($resultado) {
    header("Location: http://localhost:5173/crear-imagenes/".$id_receta);
}
