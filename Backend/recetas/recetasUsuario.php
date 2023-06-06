<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require '../conexion.php';
$conn = conexion();

/* Para mostrar las recetas de cada usuario en el espacio personal */

$id_usuario = $_REQUEST["id_usuario"];

/* $consulta = $conn->prepare("
    SELECT 
        r.*, 
        (SELECT nombre FROM paises WHERE id_pais = r.id_pais) AS nombre_pais,
        (SELECT nombre_usuario FROM usuarios WHERE id = r.id_usuario) AS nombre_usuario
    FROM 
        recetas r
    WHERE 
        r.id = :id
"); */


$consulta = $conn->prepare("SELECT id,nombre, descripcion, imagen  FROM recetas WHERE  id_usuario=:id");
$consulta->bindParam(':id', $id_usuario);
$consulta->execute();
$recetas = $consulta->fetchAll(PDO::FETCH_ASSOC);


echo json_encode($recetas);
