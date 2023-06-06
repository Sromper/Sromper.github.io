<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Content-Type");
require "../conexion.php";
$conn = conexion();

$id_receta = $_REQUEST['id_receta'];


$consulta = $conn->prepare("SELECT imagen FROM recetas WHERE id = :id_receta");
$consulta->bindParam(":id_receta", $id_receta);
$consulta->execute();
$imagen = $consulta->fetch();
echo $imagen["imagen"];


$consulta = $conn->prepare("DELETE FROM instrucciones WHERE id_receta = :id_receta");
$consulta->bindParam(":id_receta", $id_receta);
$consulta->execute();

$consulta = $conn->prepare("DELETE FROM imagenes WHERE id_receta = :id_receta");
$consulta->bindParam(":id_receta", $id_receta);
$consulta->execute();

$consulta = $conn->prepare("DELETE FROM recetas_ingredientes  WHERE id_receta = :id_receta");
$consulta->bindParam(":id_receta", $id_receta);
$consulta->execute();

$consulta = $conn->prepare("DELETE FROM comentarios  WHERE id_receta = :id_receta");
$consulta->bindParam(":id_receta", $id_receta);
$consulta->execute();

$consulta = $conn->prepare("DELETE FROM recetas_favoritas  WHERE id_receta = :id_receta");
$consulta->bindParam(":id_receta", $id_receta);
$consulta->execute();

$consulta = $conn->prepare("DELETE FROM recetas WHERE id= :id_receta");
$consulta->bindParam(":id_receta", $id_receta);
$resultado = $consulta->execute();


$imagenCarpeta = $_SERVER['DOCUMENT_ROOT'] . "/Backend/img/" . $imagen["imagen"];
echo $imagenCarpeta;
if (file_exists($imagenCarpeta)) {
    unlink($imagenCarpeta);
}

if ($resultado) {
    echo json_encode("Receta borrada correctamente");
} else {
    echo json_encode("Error al borrar la receta");
}
