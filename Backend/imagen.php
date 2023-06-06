<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require "conexion.php";
$conn = conexion();

// Obtener la imagen subida
$imagen = file_get_contents($_FILES['imagen']['tmp_name']);

// Preparar la consulta
$consulta = $conn->prepare('INSERT INTO imagen VALUES (NULL,:imagen)');
$consulta->bindParam(':imagen', $imagen);

// Ejecutar la consulta
$consulta->execute();

echo $imagen;
// Verificar si la inserción fue exitosa
/* if ($consulta->rowCount() > 0) {
    echo 'La imagen se ha insertado correctamente en la base de datos.';
} else {
    echo 'Error al insertar la imagen en la base de datos.';
}
?> */