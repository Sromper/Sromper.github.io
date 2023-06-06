<?php
header('Access-Control-Allow-Origin: *');
require '../conexion.php';
$conn = conexion();


$id=$_REQUEST['id_receta'];

$consulta = $conn->prepare("SELECT * FROM imagenes WHERE id_receta = :id");
$consulta->bindParam(':id', $id);
$resultado = $consulta->execute();

$resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);

if ($resultado) {
    echo json_encode($resultado);
}
