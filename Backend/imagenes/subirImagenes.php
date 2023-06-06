<?php
header('Access-Control-Allow-Origin: *');
require '../conexion.php';
$conn = conexion();

$nombreOriginal = $_FILES['imagen']['name'];
$nombreImagen = uniqid() . '_' . $nombreOriginal; // Nombre único para la imagen
$id_receta=$_REQUEST["id_receta"];

/* Ruta carpeta servidor */
$carpetaDestino = $_SERVER['DOCUMENT_ROOT'] . "/Backend/img/";

/* Moverla a la carpeta */
move_uploaded_file($_FILES['imagen']['tmp_name'], $carpetaDestino . $nombreImagen);

// Insertar en la base de datos
$consulta = $conn->prepare("INSERT INTO imagenes (url_Imagen,id_receta) VALUES (:url_Imagen, :id_receta)");
$consulta->bindParam(":url_Imagen", $nombreImagen);
$consulta->bindParam(":id_receta", $id_receta);
$consulta->execute();

echo "Subida exitosa";
