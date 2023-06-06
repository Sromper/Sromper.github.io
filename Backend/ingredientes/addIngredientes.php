<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require '../conexion.php';
$conn = conexion();

$id_receta = $_REQUEST['id_receta'];
$id_ingrediente = $_REQUEST['id_ingrediente'];
$cantidad = $_REQUEST['cantidad'];

$consulta = $conn->prepare("INSERT INTO recetas_ingredientes (id_receta, id_ingrediente,cantidad) VALUES (:id_receta, :id_ingrediente, :cantidad)");
$consulta->bindParam(':id_receta', $id_receta);
$consulta->bindParam(':id_ingrediente', $id_ingrediente);
$consulta->bindParam(':cantidad', $cantidad);
$resultado = $consulta->execute();

if ($resultado) {
    echo "Ingrediente agregado";
} else {
    echo "Error al agregar ingrediente";
}





