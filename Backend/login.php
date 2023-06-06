<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require "conexion.php";
$conn = conexion();
// Obtener los datos del formulario de inicio de sesión
$nombre = $_REQUEST['nombre'];
$pass = $_REQUEST['pass'];

// Buscar un usuario en la tabla de usuarios que coincida con el correo electrónico y la contraseña proporcionados
/* $sql = "SELECT * FROM usuarios WHERE id = ";
$stmt = $conn->query($sql);
$usuario = $stmt->fetch(); */

$consulta = $conn->prepare("SELECT * FROM usuarios WHERE nombre_usuario = :nombre AND pass = :pass ");
$consulta->bindParam(":nombre",$nombre);
$consulta->bindParam(":pass",$pass);


$consulta->execute();
$resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);

// Si se encuentra un usuario, iniciar sesión y redirigir a la página principal

echo json_encode($resultado);

